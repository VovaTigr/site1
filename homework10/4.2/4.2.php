<?php
    $default_base_power = 16;
    $default_coin_power = 4;
    $default_coin_count = 3;
    $default_sp = 0;
    $coin_type = 'regular';
    $skill_type_your = 'skill-1';
    $skill_affinity_your = 'wrath';
    $skill_border_your = '';
    $skill_icon_your = '';
    $showSkillsYour = false;
    
    $skill_type_opp = 'skill-1';
    $skill_affinity_opp = 'wrath';
    $skill_border_opp = '';
    $skill_icon_opp = '';
    $showSkillsOpp = false;
    
    $coins = array();
    $initial_coin_image = 'images/coin-regular.png';
    
    function findSkillBorder($skillType, $skillAffinity) {
        $imagesDir = 'images/';
        $number = str_replace('skill-', '', $skillType);
        $affinityLower = strtolower($skillAffinity);
        
        $possiblePaths = array(
            $imagesDir . 'skill-' . $number . '-' . $affinityLower . '.png',
            $imagesDir . 'skill-' . $number . '-' . $affinityLower . '.webp',
            $imagesDir . 'skill-' . $affinityLower . '-' . $number . '.png',
            $imagesDir . 'skill-' . $affinityLower . '-' . $number . '.webp',
        );
        
        foreach ($possiblePaths as $path) {
            if (file_exists($path)) {
                return $path;
            }
        }
        return '';
    }
    
    if (isset($_POST['submit_skill'])) {
        $coin_type = isset($_POST['coin_type']) ? $_POST['coin_type'] : 'regular';
        
        // Your skill
        $skill_type_your = isset($_POST['skill_type_your']) ? $_POST['skill_type_your'] : 'skill-1';
        $skill_affinity_your = isset($_POST['skill_affinity_your']) ? $_POST['skill_affinity_your'] : 'wrath';
        $skill_border_your = findSkillBorder($skill_type_your, $skill_affinity_your);
        
        if (isset($_FILES['skill_icon_your']) && $_FILES['skill_icon_your']['error'] == 0) {
            $uploadedFile = $_FILES['skill_icon_your']['tmp_name'];
            if (is_uploaded_file($uploadedFile)) {
                $imageData = file_get_contents($uploadedFile);
                $imageType = $_FILES['skill_icon_your']['type'];
                $skill_icon_your = 'data:' . $imageType . ';base64,' . base64_encode($imageData);
            }
        }
        
        // Opponent skill
        $skill_type_opp = isset($_POST['skill_type_opp']) ? $_POST['skill_type_opp'] : 'skill-1';
        $skill_affinity_opp = isset($_POST['skill_affinity_opp']) ? $_POST['skill_affinity_opp'] : 'wrath';
        $skill_border_opp = findSkillBorder($skill_type_opp, $skill_affinity_opp);
        
        if (isset($_FILES['skill_icon_opp']) && $_FILES['skill_icon_opp']['error'] == 0) {
            $uploadedFile = $_FILES['skill_icon_opp']['tmp_name'];
            if (is_uploaded_file($uploadedFile)) {
                $imageData = file_get_contents($uploadedFile);
                $imageType = $_FILES['skill_icon_opp']['type'];
                $skill_icon_opp = 'data:' . $imageType . ';base64,' . base64_encode($imageData);
            }
        }
        
        if (!isset($_POST['base_power']) || $_POST['base_power'] === '' || 
            !isset($_POST['coin_power']) || $_POST['coin_power'] === '' || 
            !isset($_POST['coin_count']) || $_POST['coin_count'] === '' || 
            !isset($_POST['sp']) || $_POST['sp'] === '') {
            echo "<h2>Enter a value and submit it into all inputs</h2>";
        } elseif (!is_numeric($_POST['base_power']) || !is_numeric($_POST['coin_power']) || !is_numeric($_POST['coin_count']) || !is_numeric($_POST['sp'])) {
            echo "<h2>All parameters must be numbers</h2>";
        } else {
            $showSkillsYour = true;
            $showSkillsOpp = true;
            $base_power = $_POST['base_power'];
            $coin_power = $_POST['coin_power'];
            $coin_count = $_POST['coin_count'];
            $sp = $_POST['sp'];
            $chance = null;
            $final_coin_power = null;
            $coins = array();
            
            if ($sp < -45 || $sp > 45) {
                echo "<h2>You've read the requirements, didn'cha</h2>";
            } else {
                $chance = $sp + 50;
            }
            
            switch($coin_type) {
                case "unbreakable": 
                    $initial_coin_image = 'images/unbreakable-coin-regular.png'; 
                    break;
                case "excision": 
                    $initial_coin_image = 'images/excision-coin-regular.png'; 
                    break;
                case "erase": 
                    $initial_coin_image = 'images/erase-coin-regular.png'; 
                    break;
                default: 
                    $initial_coin_image = 'images/coin-regular.png';
            }
            
            $final_power = $base_power + $final_coin_power;
        }
    } elseif (isset($_POST['reset'])) {
        unset($_POST);
        header("Location:" . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $skill_border_your = findSkillBorder($skill_type_your, $skill_affinity_your);
        $skill_border_opp = findSkillBorder($skill_type_opp, $skill_affinity_opp);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Limbus Coin Fight</title>
    <style>
        .container {
            display: flex;
            justify-content: space-between;
        }
        .side {
            width: 45%;
        }
        .coin {
            width: 50px;
            height: 50px;
        } 
        .coin.toss {
            animation: coin-toss 0.7s linear 1;
        }

        @keyframes coin-toss {
            50% {
                transform: rotateY(360deg);
            }
            100% {
                transform: rotateY(0deg);
            }
        }
    </style>
</head>
<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <div class="container">
            <div class="side">
                <h3>Your Skill</h3>
                <div class="form-group">
                    <label>Set your skill type</label><br>
                    <select name="skill_type_your">
                        <option value="skill-1" <?php echo ($skill_type_your == 'skill-1') ? 'selected' : ''; ?>>Skill 1</option>
                        <option value="skill-2" <?php echo ($skill_type_your == 'skill-2') ? 'selected' : ''; ?>>Skill 2</option>
                        <option value="skill-3" <?php echo ($skill_type_your == 'skill-3') ? 'selected' : ''; ?>>Skill 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Set your skill affinity</label><br>
                    <select name="skill_affinity_your">
                        <option value="wrath" <?php echo ($skill_affinity_your == 'wrath') ? 'selected' : ''; ?>>Wrath</option>
                        <option value="lust" <?php echo ($skill_affinity_your == 'lust') ? 'selected' : ''; ?>>Lust</option>
                        <option value="sloth" <?php echo ($skill_affinity_your == 'sloth') ? 'selected' : ''; ?>>Sloth</option>
                        <option value="gluttony" <?php echo ($skill_affinity_your == 'gluttony') ? 'selected' : ''; ?>>Gluttony</option>
                        <option value="pride" <?php echo ($skill_affinity_your == 'pride') ? 'selected' : ''; ?>>Pride</option>
                        <option value="gloom" <?php echo ($skill_affinity_your == 'gloom') ? 'selected' : ''; ?>>Gloom</option>
                        <option value="envy" <?php echo ($skill_affinity_your == 'envy') ? 'selected' : ''; ?>>Envy</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Insert an icon of your skill</label><br>
                    <input type="file" name="skill_icon_your">
                </div>
                <div class="form-group">
                    <label>Set your skill's base power</label><br>
                    <input type="number" name="base_power" value="<?php echo $default_base_power ?>"><br>
                </div>
                <div class="form-group">
                    <label>Set your skill's coin power</label><br>
                    <input type="number" name="coin_power" value="<?php echo $default_coin_power ?>">
                </div>
                <div class="form-group">
                    <label>Set your skill's coin count</label><br>
                    <input type="number" name="coin_count" value="<?php echo $default_coin_count ?>">
                </div>
                <div class="form-group">
                    <label>Set your character's SP (from -45 to 45)</label><br>
                    <input type="text" name="sp" value="<?php echo $default_sp ?>">
                </div>
                <?php if ($showSkillsYour && $skill_border_your != ''): ?>
                    <div class="skill-display" style="position: relative; width: 50px; height: 50px; display: inline-block; margin-top: 10px;">
                        <?php if ($skill_icon_your != ''): ?>
                            <img src="<?= $skill_icon_your ?>" alt="skill icon" style="width: 26px; height: 26px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); object-fit: contain; z-index: 0;">
                        <?php endif; ?>
                        <img src="<?= $skill_border_your ?>" alt="skill border" style="width: 50px; height: 50px; position: absolute; top: 0; left: 0; z-index: 1;">
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="side">
                <h3>Opponent's Skill</h3>
                <div class="form-group">
                    <label>Set opponent's skill type</label><br>
                    <select name="skill_type_opp">
                        <option value="skill-1" <?php echo ($skill_type_opp == 'skill-1') ? 'selected' : ''; ?>>Skill 1</option>
                        <option value="skill-2" <?php echo ($skill_type_opp == 'skill-2') ? 'selected' : ''; ?>>Skill 2</option>
                        <option value="skill-3" <?php echo ($skill_type_opp == 'skill-3') ? 'selected' : ''; ?>>Skill 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Set opponent's skill affinity</label><br>
                    <select name="skill_affinity_opp">
                        <option value="wrath" <?php echo ($skill_affinity_opp == 'wrath') ? 'selected' : ''; ?>>Wrath</option>
                        <option value="lust" <?php echo ($skill_affinity_opp == 'lust') ? 'selected' : ''; ?>>Lust</option>
                        <option value="sloth" <?php echo ($skill_affinity_opp == 'sloth') ? 'selected' : ''; ?>>Sloth</option>
                        <option value="gluttony" <?php echo ($skill_affinity_opp == 'gluttony') ? 'selected' : ''; ?>>Gluttony</option>
                        <option value="pride" <?php echo ($skill_affinity_opp == 'pride') ? 'selected' : ''; ?>>Pride</option>
                        <option value="gloom" <?php echo ($skill_affinity_opp == 'gloom') ? 'selected' : ''; ?>>Gloom</option>
                        <option value="envy" <?php echo ($skill_affinity_opp == 'envy') ? 'selected' : ''; ?>>Envy</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Insert an icon of opponent's skill</label><br>
                    <input type="file" name="skill_icon_opp">
                </div>
                <div class="form-group">
                    <label>Set opponent's base power</label><br>
                    <input type="text" name="opp_base_power" value="<?php echo $default_base_power ?>"><br>
                </div>
                <div class="form-group">
                    <label>Set opponent's coin power</label><br>
                    <input type="text" name="opp_coin_power" value="<?php echo $default_coin_power ?>">
                </div>
                <div class="form-group">
                    <label>Set opponent's coin count</label><br>
                    <input type="text" name="opp_coin_count" value="<?php echo $default_coin_count ?>">
                </div>
                <div class="form-group">
                    <label>Set opponent's SP (from -45 to 45)</label><br>
                    <input type="text" name="opp_sp" value="<?php echo $default_sp ?>">
                </div>
                <?php if ($showSkillsOpp && $skill_border_opp != ''): ?>
                    <div class="skill-display" style="position: relative; width: 50px; height: 50px; display: inline-block; margin-top: 10px;">
                        <?php if ($skill_icon_opp != ''): ?>
                            <img src="<?= $skill_icon_opp ?>" alt="skill icon" style="width: 26px; height: 26px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); object-fit: contain; z-index: 0;">
                        <?php endif; ?>
                        <img src="<?= $skill_border_opp ?>" alt="skill border" style="width: 50px; height: 50px; position: absolute; top: 0; left: 0; z-index: 1;">
                    </div>
                <?php endif; ?>
                <?php
                    for ($i = 0; $i < $coin_count; $i++) {
                        $roll = rand(1, 100);
                        if ($chance !== null && $roll <= $chance) {
                            $coins[$i] = "heads";
                            $final_coin_power += $coin_power;
                        } else {
                            $coins[$i] = "tails";
                        }
                        $image = "<img src='" . $initial_coin_image . "' alt='" . $coins[$i] . "' class='coin' id='$i'>";
                        echo $image;
                    }
                ?>
            </div>
        </div>
        <div class="form-group" style="margin-top: 10px;">
            <label>Choose a Coin Type</label><br>
            <select name="coin_type">
                <option value="regular" <?php echo ($coin_type == 'regular') ? 'selected' : ''; ?>>Regular</option>
                <option value="unbreakable" <?php echo ($coin_type == 'unbreakable') ? 'selected' : ''; ?>>Unbreakable</option>
                <option value="excision" <?php echo ($coin_type == 'excision') ? 'selected' : ''; ?>>Excision</option>
                <option value="erase" <?php echo ($coin_type == 'erase') ? 'selected' : ''; ?>>Erase</option>
            </select>
        </div>
        <input type="submit" value="Submit" name="submit_skill">
        <input type="submit" value="Reset" name="reset">
    </form>
    
    <script>
        const coinType = '<?php echo $coin_type; ?>';
        const coins = document.querySelectorAll(".coin");
        let headsTails = [
            "images/coin-heads.png",
            "images/coin-tails.png"
        ];
        if (coinType !== 'regular') {
            if (coinType == 'unbreakable') {
                headsTails = [
                    "images/excision-coin-heads.png",
                    "images/coin-tails.png"
                ];
            } else if (coinType == 'excision') {
                headsTails = [
                    "images/excision-coin-heads.png",
                    "images/coin-tails.png"
                ];
            } else if (coinType == 'erase') {
                headsTails = [
                    "images/coin-heads.png",
                    "images/coin-broken.png"
                ];
            }
        }
        let currentIndex = 0;
        let isHeads = <?php echo json_encode($coins); ?>;
        coins.forEach((img, index) => {
            img.addEventListener('animationend', () => {
                if (isHeads && isHeads[currentIndex] == "heads") {
                    img.src = headsTails[0];
                    img.alt = "heads";
                } else if (isHeads && isHeads[currentIndex] == "tails") {
                    img.src = headsTails[1];
                    img.alt = "tails";
                }
                currentIndex = (currentIndex + 1) % (isHeads.length || 1);
            });

            setInterval(() => {
                img.classList.add('toss');
            }, 500 + index * 600);
        });
    </script>
</body>
</html>

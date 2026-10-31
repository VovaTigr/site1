<?php
    $default_base_power = 16;
    $default_coin_power = 4;
    $default_coin_count = 3;
    $default_sp = 0;
    $your_coin_count = $default_coin_count;
    $opp_coin_count = $default_coin_count;
    $your_base_power = $default_base_power;
    $opp_base_power = $default_base_power;
    $your_coin_power = $default_coin_power;
    $opp_coin_power = $default_coin_power;
    $your_sp = $default_sp;
    $opp_sp = $default_sp;
    $your_chance = null;
    $opp_chance = null;
    $your_final_coin_power = 0;
    $opp_final_coin_power = 0;
    $your_final_power = $default_base_power;
    $opp_final_power = $default_base_power;
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
        $imagesDir = 'images/skill-borders/';
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
        
        if (!isset($_POST['your_base_power']) || $_POST['your_base_power'] === '' || !isset($_POST['opp_base_power']) || $_POST['opp_base_power'] === '' || 
            !isset($_POST['your_coin_power']) || $_POST['your_coin_power'] === '' || !isset($_POST['opp_coin_power']) || $_POST['opp_coin_power'] === '' || 
            !isset($_POST['your_coin_count']) || $_POST['your_coin_count'] === '' || !isset($_POST['opp_coin_count']) || $_POST['opp_coin_count'] === '' || 
            !isset($_POST['your_sp']) || $_POST['your_sp'] === '' || !isset($_POST['opp_sp']) || $_POST['opp_sp'] === '') {
            echo "<h2>Enter a value and submit it into all inputs</h2>";
        } elseif (!is_numeric($_POST['your_base_power']) || !is_numeric($_POST['opp_base_power']) ||
                  !is_numeric($_POST['your_coin_power']) || !is_numeric($_POST['opp_coin_power']) ||
                  !is_numeric($_POST['your_coin_count']) || !is_numeric($_POST['opp_coin_count']) ||
                  !is_numeric($_POST['your_sp']) || !is_numeric($_POST['opp_sp'])) {
            echo "<h2>All parameters must be numbers</h2>";
        } else {
            $showSkillsYour = true;
            $showSkillsOpp = true;
            $your_base_power = $_POST['your_base_power'];
            $your_coin_power = $_POST['your_coin_power'];
            $your_coin_count = $_POST['your_coin_count'];
            $your_sp = $_POST['your_sp'];
            $your_chance = null;
            $your_final_coin_power = 0;
            $your_coins = array();

            $opp_base_power = $_POST['opp_base_power'];
            $opp_coin_power = $_POST['opp_coin_power'];
            $opp_coin_count = $_POST['opp_coin_count'];
            $opp_sp = $_POST['opp_sp'];
            $opp_chance = null;
            $opp_final_coin_power = 0;
            $opp_coins = array();
            
            if (($your_sp < -45 || $your_sp > 45) || ($opp_sp < -45 || $opp_sp > 45)) {
                echo "<h2>You've read the requirements, didn'cha</h2>";
            } else {
                $your_chance = $your_sp + 50;
                $opp_chance = $opp_sp + 50;
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
            
            $your_final_power = $your_base_power + $your_final_coin_power;
            $opp_final_power = $opp_base_power + $opp_final_coin_power;
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
        @font-face {
            font-family: 'Mikodacs';
            src: url('fonts/Mikodacs.otf') format('otf');
        }
        @font-face {
            font-family: 'Excelsior Sans';
            src: url('fonts/ExcelsiorSans.ttf') format('ttf');
        }
        .container {
            display: flex;
            justify-content: space-between;
        }
        h2 {
            font-family: 'Mikodacs';
            font-size: 40px;
            letter-spacing: 2px;
            display: block;
        }
        .display {
            display: flex;
            align-items: center;
        }
        .side {
            width: 45%;
        }
        h3 {
            position: absolute;
            font-family: 'Excelsior Sans';
            font-size: 60px;
            transform: translate(-50%)
        }
        .coin {
            width: 25px;
            height: 25px;
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
                <h2>Your Skill</h2>
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
                    <input type="number" name="your_base_power" value="<?php echo $default_base_power ?>"><br>
                </div>
                <div class="form-group">
                    <label>Set your skill's coin power</label><br>
                    <input type="number" name="your_coin_power" value="<?php echo $default_coin_power ?>">
                </div>
                <div class="form-group">
                    <label>Set your skill's coin count</label><br>
                    <input type="number" name="your_coin_count" value="<?php echo $default_coin_count ?>">
                </div>
                <div class="form-group">
                    <label>Set your character's SP (from -45 to 45)</label><br>
                    <input type="text" name="your_sp" value="<?php echo $default_sp ?>">
                </div>
                <div class="display">
                    <?php if ($showSkillsYour && $skill_border_your != ''): ?>
                        <div class="skill-display" style="position: relative; width: 100px; height: 100px; display: inline-block; margin-top: 10px;">
                            <?php if ($skill_icon_your != ''): ?>
                                <img src="<?= $skill_icon_your ?>" alt="skill icon" style="width: 65px; height: 65px; position: absolute; top: 55%; left: 50%; transform: translate(-50%, -50%); object-fit: contain; z-index: 0; border-radius: 50%">
                            <?php endif; ?>
                            <img src="<?= $skill_border_your ?>" alt="skill border" style="width: 100px; height: 100px; position: absolute; top: 0; left: 0; z-index: 1;">
                        </div>
                        <div class="coin-group">
                            <?php
                                for ($i = 0; $i < $your_coin_count; $i++) {
                                    $roll = rand(1, 100);
                                    if ($roll <= $your_chance) {
                                        $your_coins[$i] = "heads";
                                        $your_final_coin_power += $your_coin_power;
                                    } else {
                                        $your_coins[$i] = "tails";
                                    }
                                    $image = "<img src='" . $initial_coin_image . "' alt='" . $your_coins[$i] . "' class='coin' id='$i' data-result='" . $your_coins[$i] . "'>";
                                    echo isset($your_sp) ? $image : "";
                                }
                            ?>
                        </div>
                    <?php endif; ?>
                </div>  
            </div>
            <div class="side">
                <h2>Opponent's Skill</h2>
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
                <div class="display">
                    <?php if ($showSkillsOpp && $skill_border_opp != ''): ?>
                        <div class="skill-display" style="position: relative; width: 100px; height: 100px; display: inline-block; margin-top: 10px;">
                            <?php if ($skill_icon_opp != ''): ?>
                                <img src="<?= $skill_icon_opp ?>" alt="skill icon" style="width: 65px; height: 65px; position: absolute; top: 55%; left: 50%; transform: translate(-50%, -50%); object-fit: contain; z-index: 0; border-radius: 50%">
                            <?php endif; ?>
                            <img src="<?= $skill_border_opp ?>" alt="skill border" style="width: 100px; height: 100px; position: absolute; top: 0; left: 0; z-index: 1;">
                        </div>
                        <div class="coin-group">
                            <?php
                                for ($i = 0; $i < $opp_coin_count; $i++) {
                                    $roll = rand(1, 100);
                                    if ($roll <= $opp_chance) {
                                        $opp_coins[$i] = "heads";
                                        $opp_final_coin_power += $opp_coin_power;
                                    } else {
                                        $opp_coins[$i] = "tails";
                                    }
                                    $image = "<img src='" . $initial_coin_image . "' alt='" . $opp_coins[$i] . "' class='coin' id='$i' data-result='" . $opp_coins[$i] . "'>";
                                    echo isset($opp_sp) ? $image : "";
                                }
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Choose a Coin Type</label><br>
            <select name="coin_type">
                <option value="regular" <?php echo ($coin_type == 'regular') ? 'selected' : ''; ?>>Regular</option>
                <option value="unbreakable" <?php echo ($coin_type == 'unbreakable') ? 'selected' : ''; ?>>Unbreakable</option>
                <option value="excision" <?php echo ($coin_type == 'excision') ? 'selected' : ''; ?>>Excision</option>
                <option value="erase" <?php echo ($coin_type == 'erase') ? 'selected' : ''; ?>>Erase</option>
            </select>
        </div>
        <div class="button-group">
            <input type="submit" value="Submit" name="submit_skill">
            <input type="submit" value="Reset" name="reset">
        </div>
        
    </form>
    <script>
        const coinType = '<?php echo $coin_type; ?>';
        const coin = document.querySelectorAll(".coin");
        let headsTails = [
            "images/coin-heads.png",
            "images/coin-tails.png"
        ];
        switch(coinType) {
            case "unbreakable": headsTails = [
                    "images/unbreakable-coin-heads.png",
                    "images/unbreakable-coin-tails.png"
                ]; break
            case 'excision': headsTails = [
                    "images/excision-coin-heads.png",
                    "images/excision-coin-tails.png"
                ]; break
            case 'erase': headsTails = [
                    "images/erase-coin-heads.png",
                    "images/erase-coin-tails.png"
                ]; break
            default: headsTails = [
                "images/coin-heads.png",
                "images/coin-tails.png"
            ];
        }
        coin.forEach((img, index) => {
            img.addEventListener('animationend', () => {
                const result = img.dataset.result;
                if (result === "heads") {
                    img.src = headsTails[0];
                    img.alt = "heads";
                } else if (result === "tails") {
                    img.src = headsTails[1];
                    img.alt = "tails";
                }
            });

            setInterval(() => {
                img.classList.add('toss');    
            }, 500 + index * 600);
        });
    </script>
</body>
</html>

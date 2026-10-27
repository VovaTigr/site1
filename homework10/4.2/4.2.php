<?php
    $default_base_power = 16;
    $default_coin_power = 4;
    $default_coin_count = 3;
    $default_sp = 0;
    $coin_type = 'regular';
    $skill_type = 'skill-1';
    $skill_affinity = 'wrath';
    $skill_border = '';
    $skill_icon = '';
    $showSkills = false;
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
        $skill_type = isset($_POST['skill_type']) ? $_POST['skill_type'] : 'skill-1';
        $skill_affinity = isset($_POST['skill_affinity']) ? $_POST['skill_affinity'] : 'wrath';
        $skill_border = findSkillBorder($skill_type, $skill_affinity);
        
        if (isset($_FILES['skill_icon']) && $_FILES['skill_icon']['error'] == 0) {
            $uploadedFile = $_FILES['skill_icon']['tmp_name'];
            if (is_uploaded_file($uploadedFile)) {
                $imageData = file_get_contents($uploadedFile);
                $imageType = $_FILES['skill_icon']['type'];
                $skill_icon = 'data:' . $imageType . ';base64,' . base64_encode($imageData);
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
            $showSkills = true;
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
            $final_power = $base_power + $final_coin_power;
        }
    } elseif (isset($_POST['reset'])) {
        unset($_POST);
        header("Location:" . $_SERVER['PHP_SELF']);
        exit;
    } else {
        // On initial load, try to find border for defaults
        $skill_border = findSkillBorder($skill_type, $skill_affinity);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Limbus Coin Fight</title>
    <style>
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
        <div class="group">
            <div class="form-group">
                <label>Choose the base power of your skill</label><br>
                <input type="text" name="base_power" value="<?php echo $default_base_power ?>"><br>
            </div>
            <div class="form-group">
                <label>Choose the coin power of your skill</label><br>
                <input type="text" name="coin_power" value="<?php echo $default_coin_power ?>">
            </div>
            <div class="form-group">
                <label>Choose the coin count</label><br>
                <input type="text" name="coin_count" value="<?php echo $default_coin_count ?>">
            </div>
            <div class="form-group">
                <label>Choose SP of your character (from -45 to 45)</label><br>
                <input type="text" name="sp" value="<?php echo $default_sp ?>">
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
        <div class="form-group">
                <label>Choose your skill type</label><br>
                <select name="skill_type">
                    <option value="skill-1" <?php echo ($skill_type == 'skill-1') ? 'selected' : ''; ?>>Skill 1</option>
                    <option value="skill-2" <?php echo ($skill_type == 'skill-2') ? 'selected' : ''; ?>>Skill 2</option>
                    <option value="skill-3" <?php echo ($skill_type == 'skill-3') ? 'selected' : ''; ?>>Skill 3</option>
                </select>
            </div>
            <div class="form-group">
                <label>Choose an affinity (sin) for your skill</label><br>
                <select name="skill_affinity">
                    <option value="wrath" <?php echo ($skill_affinity == 'wrath') ? 'selected' : ''; ?>>Wrath</option>
                    <option value="lust" <?php echo ($skill_affinity == 'lust') ? 'selected' : ''; ?>>Lust</option>
                    <option value="sloth" <?php echo ($skill_affinity == 'sloth') ? 'selected' : ''; ?>>Sloth</option>
                    <option value="gluttony" <?php echo ($skill_affinity == 'gluttony') ? 'selected' : ''; ?>>Gluttony</option>
                    <option value="pride" <?php echo ($skill_affinity == 'pride') ? 'selected' : ''; ?>>Pride</option>
                    <option value="gloom" <?php echo ($skill_affinity == 'gloom') ? 'selected' : ''; ?>>Gloom</option>
                    <option value="envy" <?php echo ($skill_affinity == 'envy') ? 'selected' : ''; ?>>Envy</option>
                </select>
            </div>
            <div class="form-group">
                <label>Insert an icon of your skill</label><br>
                <input type="file" name="skill_icon">
            </div>
        <input type="submit" value="Submit" name="submit_skill">
        <input type="submit" value="Reset" name="reset">
    </form>
    
    <?php if ($showSkills && $skill_border != ''): ?>
        <div class="skill-display" style="position: relative; width: 100px; height: 100px; display: inline-block; margin-top: 10px;">
            <?php if ($skill_icon != ''): ?>
                <img src="<?= $skill_icon ?>" alt="skill icon" style="width: 60px; height: 60px; position: absolute; top: 55%; left: 50%; transform: translate(-50%, -50%); object-fit: contain; z-index: 0;">
            <?php endif; ?>
            <img src="<?= $skill_border ?>" alt="skill border" style="width: 100px; height: 100px; position: absolute; top: 0; left: 0; z-index: 1;">
        </div>
    <?php endif; ?>
        </div>
    <script>
        const coinType = '<?php echo $coin_type; ?>';
        const coins = document.querySelectorAll(".coin");
        let headsTails = [
            "images/coin-heads.png",
            "images/coin-tails.png"
        ];
        switch(coinType) {
            case 'unbreakable': headsTails = [
                    "images/unbreakable-coin-heads.png",
                    "images/unbreakable-coin-tails.png"
                ]; break;
            case 'excision': headsTails = [
                    "images/excision-coin-heads.png",
                    "images/excision-coin-tails.png"
                ]; break;
            case 'erase': headsTails = [
                    "images/erase-coin-heads.png",
                    "images/erase-coin-broken.png"
                ]; break;
            default: headsTails = [
            "images/coin-heads.png",
            "images/coin-tails.png"
            ];
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

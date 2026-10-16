<?php
    if (isset($_POST['create_skill'])) {
        $roll = rand(1, 100);
        if (!isset($_POST['base_power']) || $_POST['base_power'] === '' || 
            !isset($_POST['coin_power']) || $_POST['coin_power'] === '' || 
            !isset($_POST['coin_count']) || $_POST['coin_count'] === '' || 
            !isset($_POST['sp']) || $_POST['sp'] === '') {
            echo "<h2>Enter a value and submit it into all inputs</h2>";
        } elseif (!is_numeric($_POST['base_power']) || !is_numeric($_POST['coin_power']) || !is_numeric($_POST['coin_count']) || !is_numeric($_POST['sp'])) {
            echo "<h2>All parameters must be numbers</h2>";
        } else {
            $base_power = $_POST['base_power'];
            $coin_power = $_POST['coin_power'];
            $coin_count = $_POST['coin_count'];
            $sp = $_POST['sp'];
            $chance = null;
            $final_coin_power = null;
            if ($sp < -46 || $sp > 46) {
                echo "<h2>You've read the requirements, didn'cha</h2>";
            } elseif ($sp == 46) {
                $chance = 0;
            } elseif ($sp == -46) {
                $chance = 100;
            } elseif ($sp == 0) {
                $chance = 50;
            } else {
                $chance = $sp + 50;
            }
            for ($i = 0; $i < $coin_count; $i++) {
                if ($roll <= $chance) {
                    $final_coin_power += $coin_power;
                } else {
                    continue;
                }
            }
            $final_power = $base_power + $final_coin_power;
        }
        
    }
    elseif (isset($_POST['reset'])) {
        unset($_POST);
        unset($roll);
        header("Location:" . $_SERVER['PHP_SELF']);
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Limbus Coin Fight</title>
</head>
<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" style="display: grid; grid-template: 1fr 1fr;">
        <div class="group">
            <div class="form-group">
                <label>Choose the base power of your skill</label><br>
                <input type="text" name="base_power"><br>
            </div>
            <div class="form-group">
                <label>Choose the coin power of your skill</label><br>
                <input type="text" name="coin_power">
            </div>
            <div class="form-group">
                <label>Choose the coin count</label><br>
                <input type="text" name="coin_count">
            </div>
            <div class="form-group">
                <label>Choose SP of your character (from -45 to 45)</label><br>
                <input type="text" name="sp">
            </div>
        </div>
        <input type="submit" value="Submit" name="create_skill">
        <input type="submit" value="Reset" name="reset">
    </form>
    
</body>
</html>
<?php
    $default_base_power = 16;
    $default_coin_power = 4;
    $default_coin_count = 3;
    if (isset($_POST['submit_skill'])) {
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
            $coins = [];
            if ($sp < -45 || $sp > 45) {
                echo "<h2>You've read the requirements, didn'cha</h2>";
            } else {
                $chance = $sp + 50;
            }
            for ($i = 0; $i < $coin_count; $i++) {
                $roll = rand(1, 100);
                if ($roll <= $chance) {
                    $coins[$i] = "heads";
                    $final_coin_power += $coin_power;
                } else {
                    $coins[$i] = "tails";
                }
                $image = "<img src='images/coin-regular.png' alt='' class='coin' id='$i'>";
                echo $image;
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
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
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
                <input type="text" name="sp">
            </div>
        </div>
        <div class="form-group">
            <label>Choose a Coin Type</label><br>
            <select name="coin_type">
                <option value="regular" selected>Regular</option>
                <option value="unbreakable">Unbreakable</option>
                <option value="excision">Excision</option>
                <option value="erase">Erase</option>
            </select>
        </div>
        <input type="submit" value="Submit" name="submit_skill">
        <input type="submit" value="Reset" name="reset">
    </form>
    <script>
        const coins = document.querySelectorAll(".coin")
        const headsTails = [
            "images/coin-heads.png",
            "images/coin-tails.png"
        ]
        let currentIndex = 0;
        let isHeads = <?php echo json_encode($coins); ?>;
        coins.forEach((img, index) => {
            img.addEventListener('animationend', () => {
            if (isHeads[currentIndex] == "heads") {
                img.src = headsTails[0]
            } else {
                img.src = headsTails[1]
            }
            currentIndex = (currentIndex + 1) % isHeads.length
        });

            setInterval(() => {
                img.classList.add('toss');
                }, 500 + index * 600);
            });
    </script>
</body>
</html>
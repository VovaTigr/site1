<?php
    session_start();
    if (!isset($_SESSION['random_number'])) {
        $_SESSION['random_number'] = rand(1, 10);
    } 
    
    $number = $_SESSION['random_number'];
    $count = 1;
    $tries = 5;
    $name_error = "";
    $is_guessed = false;
    if (isset($_POST['submit-guess'])) {
        if ($count == $tries) {
            echo "<h2>You lost. The number guessed was $number</h2>";
        } else {
            $count = $_POST['count'] + 1;
        }
        $button_display = "";
        $user_number = $_POST['user_number'];
        $_SESSION['pipes'] = (isset($_SESSION['pipes']) ? $_SESSION['pipes'] : '') . '|';
        if (empty($_POST['user_number'])) {
            $name_error = "<p>Enter a number</p>";
            $count = $_POST['count'] - 1;
        } elseif (!is_numeric($_POST['user_number'])) {
            $name_error = "<p>Your input must be a number</p>";
            $count = $_POST['count'] - 1;
        } else {
            if ($number < $user_number) {
                $name_error = "<p>Your number is greater than the chosen number</p>";
            } elseif ($number > $user_number) {
                $name_error = "<p>Your number is less than the chosen number</p>";
            } else {
                $final_count = $count - 1;
                $name_error = "<p>Yaaaay, you guessed it. You required $final_count attempts to guess it</p>";
                $button_display = "<input type='submit' name='clear' value='Restart the game'>";
                $is_guessed = true;
            }
        }
    } elseif (isset($_POST['clear'])) {
        unset($_POST);
        $count = 1;
        unset($_SESSION['random_number']);
        unset($_SESSION['pipes']);
        header("Location:" . $_SERVER['PHP_SELF']);
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guess a number</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="form-group">
            <label for="text" style="font-size: 35px; font-family: Arial;";>Enter a number from 1 to 10</label><br>
            <input type="text" name="user_number" style="display: inline-block;"><?php echo "<p>$name_error</p>" ?>
            <input type="hidden" name="count" value="<?= $count ?>">
            <?php echo $name_error != "Enter a number" || "Your input must be a number" ? "Attempt $count" : "" ?><br>
            <?php echo isset($_SESSION['pipes']) ? "<p>{$_SESSION['pipes']}</p>" : ""; ?><br>
            <?php echo isset($_POST['submit-guess']) && $is_guessed  ? $button_display : "";?>
            <input type="submit" value="Submit your guess" name="submit-guess">
            <input name="clear" type="submit" value="Reset">
        </div>
    </form>
    <script>

    </script>
</body>
</html>
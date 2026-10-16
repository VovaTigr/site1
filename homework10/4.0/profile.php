<?php
    if (isset($_POST)) {
        $username = $_POST['username'] ?? "";
        $email = $_POST['email'] ?? "";
        $password = $_POST['password'] ?? "";
        if (isset($_POST['Submit'])) {
            if (!empty($_POST['username']) || !empty($_POST['email']) || !empty($_POST['password'])) {
                echo "<h1>Hello, $username</h1>";
                echo "<h2>Your data:</h2>";

                echo "<a href='index.php'>Return to main page</a><br>";
            } 
        } 
    } elseif (isset($_GET)) {
        $username = $_GET['username'] ?? "";
        $email = $_GET['email'] ?? "";
        $password = "You better not use 'Get' for passwords";
        if (isset($_GET['Submit'])) {
            if (!empty($_GET['username']) || !empty($_GET['email'])) {
                echo "Hello $username";
                echo "<a href='index.php' style='display: block;';>Return to main page</a><br>";
            } 
        }
    } elseif (isset($_POST['clear'])) {
        unset($_POST);
        $count = 1;
        unset($_SESSION['random_number']);
        unset($_SESSION['pipes']);
        header("Location:" . $_SERVER['PHP_SELF']);
        exit;
    } else {
        header("Location: index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <script>
        var button = document.getElementById("profile-button");
        button.addEventListener("click", function () => {
        
        });
    </script>
</body>
</html>
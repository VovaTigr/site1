<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <h1>Form on "Post" method.</h1>
    <div class="container">
        <form action="profile.php" method="GET">
            <div class="form-group">
                <label for="text">Enter your username</label><br>
                <input type="text" name="username">
            </div>
            <div class="form-group">
                <label for="email">Enter your email</label><br>
                <input type="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Enter your password</label><br>
                <input type="password" name="password">
            </div>
            <input name="clear" type="submit" value="Reset">
            <input type="submit" name="Submit" value="Submit your data">
        </form>
    </div>
</body>
</html>


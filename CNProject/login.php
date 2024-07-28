<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styleLogin.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <div id="error-message">
        <?php
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo "Incorrect Registration No. or Password";
        }
        ?>
    </div>
        <form action="check.php" method="POST">
            <label id="user" for="username">Registration No.:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label id="pass" for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button id="login" type="submit">Login</button><span>
        </form>
        <button id="home" onclick="window.location.href='home.html'">Home</button>
    </div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User Page</title>
    <link rel="stylesheet" href="styleSignin.css">
</head>
<body>
    <div class="container">
        <h1>New User</h1>
        <div id="error-message">
        <?php
        // Connect to your MySQL databases (replace with your credentials)
        $loginServername = "localhost";
        $loginUsername = "root";
        $loginPassword = "";
        $loginDatabase = "login";
        
        $testdbServername = "localhost";
        $testdbUsername = "root";
        $testdbPassword = "";
        $testdbDatabase = "testdb";
        
        $loginConn = new mysqli($loginServername, $loginUsername, $loginPassword, $loginDatabase);
        $testdbConn = new mysqli($testdbServername, $testdbUsername, $testdbPassword, $testdbDatabase);
        
        // Check connections
        if ($loginConn->connect_error) {
            die("Login DB Connection failed: " . $loginConn->connect_error);
        }
        if ($testdbConn->connect_error) {
            die("Test DB Connection failed: " . $testdbConn->connect_error);
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $newUsername = $_POST['username'];
            $newPassword = $_POST['password'];
        
            // Check if the registration number already exists
            $checkExistenceSql = "SELECT * FROM students WHERE username = '$newUsername'";
            $result = $loginConn->query($checkExistenceSql);
            
            if ($result->num_rows > 0) {
                echo '<p style="margin-left: 24px; font-family: \'Lucida Sans\', \'Lucida Sans Regular\', \'Lucida Grande\', \'Lucida Sans Unicode\', Geneva, Verdana, sans-serif;">Account already exists for Registration No. ' . $newUsername . '.</p>';

            } else {
                // Registration number doesn't exist, proceed to insert the new user
                $loginSql = "INSERT INTO students (username, password) VALUES ('$newUsername', '$newPassword')";
        
                if ($loginConn->query($loginSql) === TRUE) {
                    echo "Registration successful!";
                } else {
                    echo "Error: " . $loginSql . "<br>" . $loginConn->error;
                }
        
                // Create a new table for answers in the "testdb" database
                $answersTable = "answers_submitted" . $newUsername;
                $createAnswersTableSQL = "CREATE TABLE $answersTable (
                    question_id INT(9),
                    answer VARCHAR(500)
                )";
        
                if ($testdbConn->query($createAnswersTableSQL) === TRUE) {
                } else {
                    echo "Error creating answers table: " . $testdbConn->error;
                }
                $loginConn->close();
                $testdbConn->close();
            }
        }
        ?>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label id="user" for="username">Registration No.:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label id="pass" for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button id="enter" type="submit">Create Account</button>

            <button id="login" onclick="window.location.href='login.php'">Back to Login</button>
        </form>
    </div>
</body>
</html>
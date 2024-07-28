<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="styledev.css">
</head>
<body>
    <div class = "main">
        <h1>Developers Page</h1>
        <?php
        // Database connection parameters
        $servername = "localhost"; // Replace with your MySQL server name
        $username = "root"; // Replace with your MySQL username
        $password = ""; // Replace with your MySQL password
        $dbname = "login"; // Replace with your MySQL database name    

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $query = "SELECT COUNT(*) AS count FROM users WHERE module!=0";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $count = $row['count'];
        echo '<p style="font-family: italic; font-size: 20px; font-weight: bold; text-align: center;">Number of successful quizzes attempted : ' . $count . '</p>';
        $conn->close();
        ?>
    <div class="container">
        <img id="male" src="photo_male.jpg" >
    <div class="text">
            <h2>Ridam Mishra</h2>
            <p>Email: ridam.mishra2022@vitstudent.ac.in</p>
    </div>
    </div>
    <div class="container">
        <img id="female" src="photo_female.jpg">
    <div class="text">
            <h2>Tanushree Sogali</h2>
            <p>Email: tanushree.sogali2022@vitstudent.ac.in</p>
    </div>
    </div>
    <div class="container">
        <img id="male" src="photo_male.jpg" >
    <div class="text">
            <h2>Amitej Singh</h2>
            <p>Email: amitejsingh.datta2022@vitstudent.ac.in</p>
    </div>
    </div>
    <div class="container">
        <img id="male" src="photo_male.jpg">
    <div class="text">
            <h2>Shaunak Whaval</h2>
            <p>Email: shaunaksujit.whaval.2022@vitstudent.ac.in</p>
    </div>
    </div>
    <button id="home" onclick="window.location.href='home.html'">Home</button>
    


</div>
</body>
</html>
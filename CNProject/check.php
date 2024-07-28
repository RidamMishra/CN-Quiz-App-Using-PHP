<?php
// Replace these values with your actual database credentials.
$host = "localhost";
$username = "root";
$password = "";
$database = "login";

// Establish a database connection.
$conn = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful.
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve user input.
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Query to check if the username and password match in your database table.
$query = "SELECT * FROM students WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);

// Check if there is a matching row.
if (mysqli_num_rows($result) == 1) {
    // Successful login, redirect to a welcome page.
    header("Location: mod_select.php");

    // Insert the username into the "users" table.
    $insertQuery = "INSERT INTO users (reg_no) VALUES ('$username')";
    mysqli_query($conn, $insertQuery);
} else {
    // Invalid login, redirect back to the login page with an error message.
    header("Location: Login.php?error=1");
}

// Close the database connection.
mysqli_close($conn);
?>

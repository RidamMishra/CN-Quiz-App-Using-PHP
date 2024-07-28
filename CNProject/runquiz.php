<!DOCTYPE html>
<html>
<head>
    <title>CN MCQs</title>
</head>
<link rel="stylesheet" href="styleQuiz.css">
<body>
<div class="main">
    <div class="head">
    <h1>MCQ Questions</h1>
    </div>
    
    <img  id="vitlogo" src="img1.png">
    
    <form method="post" action="resultpage.php">
    <?php
        // Database connection parameters
        $servername = "localhost"; // Replace with your MySQL server name
        $username = "root"; // Replace with your MySQL username
        $password = ""; // Replace with your MySQL password
        $dbname = "testdb"; // Replace with your MySQL database name

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $mod = $_POST['mod_no'];

        // SQL query to select all columns from your table (replace 'your_table' with your table name)
        $TableName="questionbank".$mod;
        $sql = "SELECT ID,questions, A, B, C, D FROM $TableName";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Fetch all questions into an array
            $questions = [];
            while ($row = $result->fetch_assoc()) {
                $questions[] = $row;
            }

            // Shuffle the questions array to randomize the order
            shuffle($questions);

            // Select the first 5 questions
            $selectedQuestions = array_slice($questions, 0, 10);

            foreach ($selectedQuestions as $key => $question) {
                echo "<div>";
                echo "<strong>Question:</strong> " . $question["questions"] . "<br>";
                echo "<strong>(A):</strong> " . $question["A"] . "<br>";
                echo "<strong>(B):</strong> " . $question["B"] . "<br>";
                echo "<strong>(C):</strong> " . $question["C"] . "<br>";
                echo "<strong>(D):</strong> " . $question["D"] . "<br>";
                
                // Add input fields for selecting options A, B, C, or D
                echo "Select Option: ";
                echo "<select name='answer[]'>";
                echo "<option value='A'>A</option>";
                echo "<option value='B'>B</option>";
                echo "<option value='C'>C</option>";
                echo "<option value='D'>D</option>";
                echo "</select>";
                echo "<input type='hidden' name='question_id[]' value='" . $question["ID"] . "'>";
                echo "<input type='hidden' name='mod_no' value=$mod>";
                
                echo "</div>";
                echo "<hr>"; // Add a horizontal line to separate questions
            }
        } else {
            echo "No records found.";
        }

        // Close the connection
        $conn->close();
        ?>

        <input id="go" type="submit" value="Submit Answers">
        </div>

    </form>
    </img>
    </body>
</html>
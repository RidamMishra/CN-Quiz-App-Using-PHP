<!DOCTYPE html>
<html>
<head>
    <title>CN MCQs</title>
</head>
<link rel="stylesheet" href="styleResult.css">
<body>
<div class="main">
    <div class="head">
    <h1>Results</h1>
    </div>
    
    <img  id="vitlogo" src="img1.png">

    <?php
    // Database connection parameters
    $servername = "localhost"; // Replace with your MySQL server name
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $dbname = "testdb"; // Replace with your MySQL database name
    $dbname1 = "login"; // Replace with your MySQL database name    

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn1 = new mysqli($servername, $username, $password, $dbname1);

    // Check connection
    if ($conn->connect_error || $conn1->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $mod=$_POST['mod_no'];

    $sql_query = "SELECT id,reg_no FROM users ORDER BY id DESC LIMIT 1";
    $run = mysqli_query($conn1, $sql_query);
    $row = mysqli_fetch_assoc($run);
    $userValue = $row["reg_no"];
    $idValue = $row["id"];

    // Create a new table for storing answers
    $newTableName = "Answers_Submitted".$userValue;
    $QuestionBank="questionbank".$mod;
    $sqlClearTable = "DELETE FROM $newTableName";

    if ($conn->query($sqlClearTable) === TRUE) {
        
        // Process the submitted answers
        if (isset($_POST['answer']) && isset($_POST['question_id']) ) {
            $answers = $_POST['answer'];
            $questionId=$_POST['question_id'];
            // Insert answers into the new table
            // Start with the first question ID
            $i=0;
            foreach ($answers as $answer) {
                $id=$questionId[$i];
                $sqlInsert = "INSERT INTO $newTableName (question_id, answer) VALUES ('$id', '$answer')";
                $sqlShow=" SELECT Questions,A,B,C,D,CORRECT FROM $QuestionBank WHERE ID='$id'";
                $result = $conn->query($sqlShow);
                $row = $result->fetch_assoc();
                $correct = $row["CORRECT"];
                $question=$row["Questions"];
                $a=$row["A"];
                $b=$row["B"];
                $c=$row["C"];
                $d=$row["D"];
                
                if ($conn->query($sqlInsert) === TRUE) {
                    echo "<div>";
                    echo "<strong>Question:</strong> " . $question . "<br>";
                    echo "<strong>(A):</strong> " . $a . "<br>";
                    echo "<strong>(B):</strong> " . $b . "<br>";
                    echo "<strong>(C):</strong> " . $c . "<br>";
                    echo "<strong>(D):</strong> " . $d . "<br>";
                    echo "<strong>Your Answer:</strong> " . $answer . "<br>";
                    echo "<strong>Correct Answer:</strong> " . $correct . "<br>";

                    echo"</div>";
                    echo"<hr>";
                } else {
                    echo "Error inserting answer: " . $conn->error . "<br>";
                }
                $i++;
                
            }
            $sql1="SELECT COUNT(*) AS score FROM $QuestionBank , $newTableName  WHERE $QuestionBank.ID=$newTableName.QUESTION_ID AND $QuestionBank.CORRECT=$newTableName.ANSWER";
            $result = $conn->query($sql1);

            if ($result) {
                $row = $result->fetch_assoc();
                $score = $row["score"];
                echo '<div style="font-family: italic; font-size: 30px; font-weight: bold; text-align: center; color: blue;">Your Score is ' . $score . '/10</div>';
            } else {
            echo "Error in query: " . $conn->error;
            }

        } else {
            echo "No answers submitted.";
        }
    } else {
        echo "Error creating table: " . $conn->error;
    }

    $sql2="UPDATE users SET module = $mod, score = $score WHERE id = $idValue";
    $result1 = $conn1->query($sql2);
    // Close the connection
    $conn->close();
    $conn1->close();
    ?>
    <br>
    <button id="home" onclick="window.location.href='home.html'">Home</button>
    <button id="dev" onclick="window.location.href='dev_page.php'">Developers Page</button>
    </div>

</img>
</body>
</html>
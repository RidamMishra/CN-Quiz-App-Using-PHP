<!DOCTYPE html>
<html?>
<head>
    <title>Select Module</title>
    <link rel="stylesheet" href="styleMod.css">
</head>
<body>
<div class="main">
    <h1>Select Module:</h1>
    <form method="post" action="runquiz.php">
        <?php
        ?>
        <div>
            <label id="mod">Select Module:</label>
            <select id="op" name='mod_no'>
                <option value='1'>Module 1</option>
                <option value='2'>Module 2</option>
                <option value='3'>Module 3</option>
                <option value='4'>Module 4</option>
                <option value='5'>Module 5</option>
                <option value='6'>Module 6</option>
                <option value='7'>Module 7</option>
            </select>
        </div>
        <hr>
        <input id="go" type="submit" value="Start Quiz"><span>
    </form>
</div>
</body>
</html>
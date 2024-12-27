<?php
$script = $_SERVER["PHP_SELF"];
if (!isset($_POST["submit"])) {
    displayForm();
} else {
    deleteRecord();
}

function displayForm() {
print <<<FORM
    <html>
    <head>
    <title> Web Interface </title>
    <link rel = "stylesheet" href = "hw14.css">
    </head>

    <body>
    <div class = "container">
    <h2 style = "text-align: center;"> <u> Actions </u> </h2>
    <h3 style = "text-align: center;"> Delete Student Record </h3>

    <table>
        <form method = "post" action = $script>
            <tr> <td> ID </td> <td> <input type = "text" name = "id" autofocus required> </td> </tr>
    </table>
            <input type = "submit" name = "submit" value = "Submit">
        </form>

    <a href = "action.php">Back to home</a>
    </div>
    </body>
    </html>
FORM;

}

function deleteRecord() {
    $server = "spring-2024.cs.utexas.edu";
    $user = "cs329e_bulko_yuperior";
    $database = "cs329e_bulko_yuperior";
    $password = "wrong3Love&edible";
    $id = $_POST["id"];
    
    $mysqli = new mysqli($server, $user, $password, $database);
    if ($mysqli->connect_errno) {
        die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
    }
    $query = "DELETE FROM students WHERE id = '$id'";
    $result = $mysqli->query($query);

    if (!$result) {
        die("Query failed: " . $mysqli -> error);
    } else {
        echo "<script>alert('Record deleted successfully!')</script>";
        displayForm();
    }
}

?>
<?php
$script = $_SERVER["PHP_SELF"];
if (!isset($_POST["id"])) {
    displayForm();
} else {
    updateRecord();
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
    <h3 style = "text-align: center;"> Update Student Record </h3>
 
    <table>
        <form method = "post" action = $script>
            <tr> <td> ID </td> <td> <input type = "text" name = "id" autofocus required> </td> </tr>
            <tr> <td> LAST NAME </td> <td> <input type = "text" name = "last"> </td> </tr>
            <tr> <td> FIRST NAME </td> <td> <input type = "text" name = "first"> </td> </tr>
            <tr> <td> MAJOR </td> <td> <input type = "text" name = "major"> </td> </tr>
            <tr> <td> GPA </td> <td> <input type = "text" name = "gpa"> </td> </tr>
            <tr> <td colspan = "2"> <input type = "submit" name = "submit" value = "Submit"> </td> </tr>
        </form>
    </table>
    <a href="action.php">Back to home</a>
    </div>
    </body>
    </html>
FORM;

}

function updateRecord() {
    $server = "spring-2024.cs.utexas.edu";
    $user = "cs329e_bulko_yuperior";
    $database = "cs329e_bulko_yuperior";
    $password = "wrong3Love&edible";
    $id = $_POST["id"];
    $last = $_POST["last"];
    $first = $_POST["first"];
    $major = $_POST["major"];
    $gpa = $_POST["gpa"];

    $query = "UPDATE students SET ";
    $updates = array();
    if (!empty($last)) {
        $updates[] = "last = '$last'";
    }
    if (!empty($first)) {
        $updates[] = "first = '$first'";
    }
    if (!empty($major)) {
        $updates[] = "major = '$major'";
    }
    if (!empty($gpa)) {
        $updates[] = "gpa = '$gpa'";
    }

    if (!empty($updates)) {
        $mysqli = new mysqli($server, $user, $password, $database);
        if ($mysqli->connect_errno) {
            die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
        } 
        $query .= implode(", ", $updates);
        $query .= " WHERE id = '$id'";

        $result = $mysqli->query($query);

        if (!$result) {
            die("Query failed: No matches");
        } else {
            echo "<script>alert('Record successfully updated!')</script>";
            displayForm();
        }
    } else {
        echo "<script>alert('No fields other than ID provided for update.')</script>";
        displayForm();
    }
}

?>
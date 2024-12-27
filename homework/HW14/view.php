<?php
$script = $_SERVER["PHP_SELF"];
if (!isset($_POST["id"])) {
    displayForm();
} else if (isset($_POST["view"])) {
    displayAllRecords();
} else {
    viewRecord();
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
    <h3 style = "text-align: center;"> View Student Record </h3>

    <table>
        <form method = "post" action = $script>
            <tr> <td> ID </td> <td> <input type = "text" name = "id" autofocus> </td> </tr>
            <tr> <td> LAST NAME </td> <td> <input type = "text" name = "last"> </td> </tr>
            <tr> <td> FIRST NAME </td> <td> <input type = "text" name = "first"> </td> </tr>
            <tr> <td colspan = "2"> <input type = "submit" name = "submit" value = "Submit"> </td> </tr>
    </table>
            <input type = "submit" name = "view" value = "View All Student Records.">
        </form>
    <a href = "action.php">Back to home</a>
    </div>
    </body>
    </html>
FORM;

}

function viewRecord() {
    $server = "spring-2024.cs.utexas.edu";
    $user = "cs329e_bulko_yuperior";
    $database = "cs329e_bulko_yuperior";
    $password = "wrong3Love&edible";
    $id = $_POST["id"];
    $last = $_POST["last"];
    $first = $_POST["first"];

    $mysqli = new mysqli($server, $user, $password, $database);
    if ($mysqli->connect_errno) {
        die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
    }
    switch (true) {
        case !empty($id) && !empty($last) && !empty($first):
            $query = "SELECT * FROM students WHERE id = '$id' AND last = '$last' AND first = '$first'";
            break;
        case !empty($id) && !empty($last):
            $query = "SELECT * FROM students WHERE id = '$id' AND last = '$last'";
            break;
        case !empty($id) && !empty($first):
            $query = "SELECT * FROM students WHERE id = '$id' AND first = '$first'";
            break;
        case !empty($last) && !empty($first):
            $query = "SELECT * FROM students WHERE last = '$last' AND first = '$first'";
            break;
        case !empty($id):
            $query = "SELECT * FROM students WHERE id = '$id'";
            break;
        case !empty($last):
            $query = "SELECT * FROM students WHERE last = '$last'";
            break;
        case !empty($first):
            $query = "SELECT * FROM students WHERE first = '$first'";
            break;
        default:
            echo "<script>alert('No data entered!')</script>";
            displayForm();
    }

    $result = $mysqli->query($query);

    if ($result->num_rows == 0) {
        echo "<script>alert('No matches.')</script>";
        displayForm();
    } else {
        echo "<html><head><link rel = 'stylesheet' href = 'hw14.css'>";

        echo "<table border = '1' style = 'background-color:white;'> <tr> <th>ID</th><th>Last Name</th><th>First Name</th><th>Major</th><th>GPA</th></tr>";

        while ($row = $result->fetch_row()) {
            echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
        }

        echo "</table>";
        echo "<a href = $script> Back to home </a>";
    }
}

function displayAllRecords() {
    $server = "spring-2024.cs.utexas.edu";
    $user = "cs329e_bulko_yuperior";
    $database = "cs329e_bulko_yuperior";
    $password = "wrong3Love&edible";

    $mysqli = new mysqli($server, $user, $password, $database);
    if ($mysqli->connect_errno) {
        die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
    }
    $query = "SELECT * FROM students ORDER BY last, first";
    $result = $mysqli->query($query);

    if (!$result) {
        die("Query failed: " . $mysqli -> error);
    }
    
    echo "<html><head><link rel = 'stylesheet' href = 'hw14.css'>";

    echo "<table border = '1' style = 'background-color:white;'> <tr> <th>ID</th><th>Last Name</th><th>First Name</th><th>Major</th><th>GPA</th></tr>";

    while ($row = $result->fetch_row()) {
        echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
    }

    echo "</table>";
    echo "<a href = $script> Back to home </a>";
}

?>
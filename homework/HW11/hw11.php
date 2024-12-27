<?php
$script = $_SERVER['PHP_SELF'];

function writeNames($timeslots) {
    $file = fopen("signup.txt", "w");
    foreach ($timeslots as $time => $name) {
        fwrite($file, "$time: $name\n");
    }
    fclose($file);
}

function readText() {
    $file = fopen("signup.txt", "r");
    $signupData = array();

    while (($line = fgets($file)) != false) {
        $dataLine = explode(': ', $line, 2);
        $time = trim($dataLine[0]);
        $name = trim($dataLine[1]);

        $signupData[$time] = $name;
    }

    fclose($file);
    return $signupData;
}

$signupData = readText();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $timeslots = $_POST["slot"];
    foreach ($timeslots as $time => $name) {
        $timeslots[$time] = $name;
    }
    writeNames($timeslots);
    header("Location: $script");
}

if (empty($signupData)) {
    $signupData = array(
        "8:00 am" => "",
        "9:00 am" => "",
        "10:00 am" => "",
        "11:00 am" => "",
        "12:00 pm" => "",
        "1:00 pm" => "",
        "2:00 pm" => "",
        "3:00 pm" => "",
        "4:00 pm" => "",
        "5:00 pm" => "",
    );
}

print <<<TOP
<!DOCTYPE html>

<html lang = "en">

<head>
  <title>Signup Form</title>
  <meta charset = "UTF-8">
  <meta name = "description" content = "Signup form">
  <meta name = "author" content = "Primo Marquez">
  <link rel = "stylesheet" href = "hw11.css">
</head>

<body>

<h2>Signup Sheet</h2>
<form action = "$script" method = "post">
    <table border = "1">
        <tr>
            <th>Time</th>
            <th>Name</th>
        </tr>
TOP;

foreach ($signupData as $time => $name) {
    echo "<tr><td>$time</td>";
    if ($name != "") {
        echo "<td><input type = 'hidden' name = 'slot[$time]' value = '$name'>$name</td>"; 
    } else {
        echo "<td><input type = 'text' name = 'slot[$time]'></td>";
    }
    echo "</tr>";
}

print <<<BOTTOM
</table>
<input type = "submit" value = "Submit">
</form>

</body>
</html>
BOTTOM;
?>
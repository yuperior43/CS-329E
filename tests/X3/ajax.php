<?php

	$server = "spring-2024.cs.utexas.edu";
	$dbName = "cs329e_bulko_yuperior";
	$name = $_GET["name"];
	$item = $_GET["item"];
	$username = "cs329e_bulko_yuperior";
	$password = "wrong3Love&edible";
	// decode the urlencoded password
	$name = urldecode($name);

	$mysqli = new mysqli($server, $username, $password, $dbName);
        if ($mysqli->connect_errno) {
            die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
        }
	$name = $mysqli->real_escape_string($name);
	$item = $mysqli->real_escape_string($item);

	function executeQuery($mysqli, $query) {
		$result = $mysqli->query($query);
		if (!$result) {
			die('Query failed: ' . $mysqli->errno . ': ' . $mysqli->error);
		}
		return $result;
	}

	$insertQuery = "INSERT INTO dinner (name, items) VALUES ('$name', '$item')";
	$insertResult = executeQuery($mysqli, $insertQuery);

        if ($insertResult) {
	    echo "<html><table border = '1' style = 'background-color:white;'> <tr> <th>Name</th><th>Item</th>";

            $selectQuery = "SELECT * FROM dinner";
            $selectResult = executeQuery($mysqli, $selectQuery);

            while ($row = $selectResult->fetch_row()) {
                echo "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
            }

            echo "</table></html>";
        }
?>

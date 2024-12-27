<?php

	$server = "spring-2024.cs.utexas.edu";
	$dbName = "cs329e_bulko_yuperior";
	$user = $_GET["user"];
	$pwd = $_GET["password"];
	$username = "cs329e_bulko_yuperior";
	$password = "wrong3Love&edible";
	// decode the urlencoded password
	$pwd = urldecode($pwd);

	$mysqli = new mysqli($server, $username, $password, $dbName);
        if ($mysqli->connect_errno) {
            die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
        }

	function executeQuery($mysqli, $query) {
		$result = $mysqli->query($query);
		if (!$result) {
			die('Query failed: ' . $mysqli->errno . ': ' . $mysqli->error);
		}
		return $result;
	}

	$selectQuery = "SELECT password FROM users WHERE id = '$user'";
	$selectResult = executeQuery($mysqli, $selectQuery);

	if ($selectResult->num_rows == 0) {
		$insertQuery = "INSERT INTO users (id, password) VALUES ('$user', '$pwd')";
		executeQuery($mysqli, $insertQuery);
		echo 'New user registered.';
	} else {
		while ($row = $selectResult->fetch_row()) {
			if ($row[0] != $pwd) {
				$updateQuery = "UPDATE users SET password = '$pwd' WHERE id = '$user'";
				executeQuery($mysqli, $updateQuery);
				echo 'Password changed.';
			} else if ($row[0] == $pwd) {
				echo 'User and password confirmed.';
			}
		}
	}

?>
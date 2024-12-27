<?php
	$email = $_POST["email"];
	$regex1 = "/@/";

	if (preg_match($regex1, $email)) {
		echo "Valid email address<br>";
	}
	else {
		echo "Invalid email address<br>";
	}

	$password = $_POST["password"];
	$regex2 = "/^[A=Z]+[a-z0-9]*/";

	if (preg_match($regex2, $password)) {
		echo "Valid password<br>";
	}
	else {
		echo "Invalid password<br>";
	}
?>

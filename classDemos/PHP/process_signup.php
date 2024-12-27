error_reporting(E_ALL);

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];

    // Validate data (you can add more validation as needed)
    if (empty($name) || empty($email)) {
        echo "Name and email are required!";
    } else {
        // Save signup data to a text file
        $signup_data = "Name: $name, Email: $email\n";
        $file = 'signups.txt';

        // Open the file to append
        $fp = fopen($file, 'a');
        if ($fp) {
            fwrite($fp, $signup_data);
            fclose($fp);
            echo "Signup successful!";
        } else {
            echo "Failed to open file!";
        }
    }
}
?>

<?php

$name = $_POST["name"];
$email = $_POST["email"];

echo "Hello" . "<br>";
echo $name . "<br>";
echo $email . "<br>";

$checkboxes = $_POST["attraction"];
if (!isset($checkboxes)) {
  echo "None selected" . "<br>";
} else {
    foreach ($checkboxes as $box) {
      echo $box . "<br>";
  }
}

$radio = $_POST["connection"];
echo $radio . "<br>";

?>
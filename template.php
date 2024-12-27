<!DOCTYPE html>

<html lang = "en">

<head>
  <title>PHP Click Demo</title>
  <meta charset = "UTF-8">
  <meta name = "description" content = "More PHP stuff">
  <meta name = "author" content = "Primo Marquez">
</head>

<body style="text-align:center;">

<h1 style="color:green;">
  Pick it and click it
</h1>

<h4> and a PHP function will be called </h4>

<?php
  if(isset($_POST['button1'])) {
    echo "Button 1 was selected";
  }
  
  if(isset($_POST['button2'])) {
    echo "Button 2 was selected";
  }
?>

<form method="post">
  <input type="submit" name="button1" value="Button1"></input>
  <input type="submit" name="button2" value="Button2"></input>
</form>

</body>
</html>
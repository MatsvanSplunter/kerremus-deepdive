<?php 

include_once("connect.php");
    $dbhost = "localhost";
    $dbname = "backend__eindproject";
    $dbuser = "bit_academy";
    $dbpass = "bit_academy";
    
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  session_start();
  error_reporting(0);
  $_SESSION['userid'] = '1';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="title">
<div class="zoom-flash">
  <h1>Game of Live</h1>
  <div class="buttons-container">
    <?php 
    
    if ($_SESSION['userid'] != null) {
      
    ?>
      <button class="neon-btn">new game</button>
      <button class="neon-btn">load game</button>
    <?php } ?>
    <button class="neon-btn">login</button>
</div>
</body>

</html>
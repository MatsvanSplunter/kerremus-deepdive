<?php 

include_once("connect.php");
    $dbhost = "localhost";
    $dbname = "kerremus_deepdive";
    $dbuser = "bit_academy";
    $dbpass = "bit_academy";
    
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  session_start();
  error_reporting(0);

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
  <h1 id="name">kerremus of live</h1>
  <div class="buttons-container" id="mainMenu">
    <?php if ($_SESSION['userid'] != null) { ?>
      <button class="neon-btn" id="newGameBtn">new game</button>
      <button class="neon-btn" id="loadGameBtn">load game</button>
    <?php } ?>
    <button class="neon-btn" id="login" <?php if ($_SESSION['userid'] != null) { echo 'style="display:none;"'; } ?>>Login/register</button>
    <button class="neon-btn" id="logout" <?php if ($_SESSION['userid'] == null) { echo 'style="display:none;"'; } ?>>logout</button>
  </div>

  <h1 id="name2" style="display:none;">choose grid size</h1>
  <div class="buttons-container" id="newGameMenu" style="display:none;">
    <form method="post" action="game.php" class="buttons-container">    
      <button class="neon-btn" id="backBtn">Back</button>
      <button class="neon-btn" name="gridsize" value="small" id="small">small</button>
      <button class="neon-btn" name="gridsize" value="medium" id="medium">medium</button>
      <button class="neon-btn" name="gridsize" value="large" id="large">large</button>
    </form>
  </div>

  <h1 id="name3" style="display:none;">load game</h1>
  <div class="buttons-container" id="loadGameMenu" style="display:none;">
    <button class="neon-btn" id="backBtn2">Back</button>
    <button class="neon-btn">save 1</button>
    <button class="neon-btn">save 2</button>
    <button class="neon-btn">save 3</button>
  </div>
</div>

</div>
<script src="index.js"></script>
</body>

</html>
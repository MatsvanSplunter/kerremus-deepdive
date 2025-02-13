<?php 

include_once("connect.php");
  
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
  <h1 id="name">kerremus of life</h1>
  <div class="buttons-container" id="mainMenu">
    <?php if ($_SESSION['userid'] != null) { ?>
      <button class="neon-btn" id="newGameBtn">new game</button>
      <button class="neon-btn" id="shop">shop</button>
    <?php } ?>
    <button class="neon-btn" id="login" <?php if ($_SESSION['userid'] != null) { echo 'style="display:none;"'; } ?>>Login/register</button>
    <button class="neon-btn" id="logout" <?php if ($_SESSION['userid'] == null) { echo 'style="display:none;"'; } ?>>logout</button>
  </div>

  <h1 id="name2" style="display:none;">choose grid size</h1>
  <div class="buttons-container" id="newGameMenu" style="display:none;">
    <form method="post" action="game.php" class="buttons-container-grid">    
      <button class="neon-btn" name="gridsize" value="back" id="backBtn">Back</button>
      <button class="neon-btn" name="gridsize" value="small" id="small">small</button>
      <button class="neon-btn" name="gridsize" value="medium" id="medium">medium</button>
      <button class="neon-btn" name="gridsize" value="large" id="large">large</button>
      <button class="neon-btn" name="gridsize" value="XL" id="XL">XL</button>
      <button class="neon-btn" name="gridsize" value="XXL" id="XXL">XXL</button>
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
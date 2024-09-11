<?php

$width = 100;
$height = 50;
if($_POST) {
    switch ($_POST['gridsize']):
        case 'small':
            $width = 100;
            $height = 50;
            break;
        case 'medium':
            $width = 500;
            $height = 250;
            break;
        case 'large':
            $width = 1000;
            $height = 500;
            break;
        default:
            break;

}

$celsize = 25;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="game.css">
    <title>Document</title>
</head>

<body>
    <div class="top-bar">
        <button onclick="simulatebutton()">Simulate</button>
        <input type="range" min="1" max="100" id="speed">
        <input type="range" min="1" max="100" id="size" value="<?=$celsize?>">
    </div>
    <table class="grid">
        <?php
        for ($row = 0; $row < $height; $row++) {
            ?>
            <tr>
                <?php
                for ($col = 0; $col < $width; $col++) {
                    ?>
                    <td class="false" id="<?=$row?>, <?=$col?>"></td>
                    <?php
                }
                ?>
            </tr>
            <?php
        }
        ?>
    </table>
</body>
<script src="game.js"></script>
</html>
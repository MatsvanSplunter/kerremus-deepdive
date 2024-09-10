<?php
$width = 100;
$height = 50;
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
    <div>
        <button onclick="simulatebutton()">Simulate</button>
        <input type="range" min="1" max="100" id="speed">
        <input type="range" min="1" max="100" id="size" value="<?=$celsize?>">
    </div>
    <table>
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
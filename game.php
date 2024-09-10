<?php
$size = 100;
$celsize = 25;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .true {
            background-color: yellow;
        }
        .false {
            background-color: grey;
        }
        td {
            width: <?=$celsize?>px;
            height: <?=$celsize?>px;
        }
        body {
            width: max-content;
        }
        button, input {
            display: flex;
            position: relative;
        }
        div {
            display: flex;
            position: absolute;
        }
    </style>
</head>
<body>
    <div>
        <button onclick="simulatebutton()">Simulate</button>
        <input type="range" min="1" max="100" id="speed">
        <input type="range" min="1" max="100" id="size" value="<?=$celsize?>">
    </div>
    <table>
        <?php
        for ($row = 0; $row < $size; $row++) {
            ?>
            <tr>
                <?php
                for ($col = 0; $col < $size; $col++) {
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
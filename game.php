<?php
$size = 100;
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
            width: 45px;
            height: 45px;
        }
        body {
            width: max-content;
        }
        button {
            display: flex;
            position: absolute;
        }
    </style>
</head>
<body>
    <button onclick="simulatebutton()">Simulate</button>
    <table>
        <?php
        for ($row = 0; $row < $size; $row++) {
            ?>
            <tr>
                <?php
                for ($col = 0; $col < $size; $col++) {
                    ?>
                    <td class="false" id="<?=$row?>, <?=$col?>"><?=$row?>, <?=$col?></td>
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
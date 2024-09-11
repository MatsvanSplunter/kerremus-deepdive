<?php
$width = 320;
$height = 150;
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
        <input type="range" min="1" max="100" id="size" value="<?= $celsize ?>">
    </div>
<<<<<<< HEAD

    <div>
        <div>
            <table class="grid">
                <?php
                for ($row = 0; $row < $height; $row++) {
                ?>
                    <tr>
                        <?php
                        for ($col = 0; $col < $width; $col++) {
                        ?>
                            <td class="false" id="<?= $row ?>, <?= $col ?>"></td>
                        <?php
                        }
                        ?>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
=======
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
>>>>>>> fee99df86ad3964688a06a7ac5b5a4c2cc518ce0
</body>
<script src="game.js"></script>

</html>
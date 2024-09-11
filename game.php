<?php

$width = 0;
$height = 0;
if ($_POST['gridsize']) {
    switch ($_POST['gridsize']) {
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
        case 'XL':
            $width = 1500;
            $height = 750;
            break;
        case 'XXL':
            $width = 2000;
            $height = 1000;
            break;
        case 'back':
            header("location: index.php");
            break;
        default:
            break;
    }
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
        <button onclick="simulate()">Step</button>
        <input type="range" min="1" max="100" id="speed">
        <input type="range" min="1" max="100" id="size" value="<?= $celsize ?>">
        <a href="index.php"><button>Back</button></a>
    </div>
    <script>
        const width = <?= $width ?>;
        const height = <?= $height ?>;
        table = document.createElement('table');
        table.classList.add('grid');
        let tableHTML = '';
        for (let row = 0; row < height; row++) {
            tableHTML += "<tr>";
            for (let col = 0; col < width; col++) {
                tableHTML += `<td class='false' id='${row},${col}'></td>`;
            }
            tableHTML += "</tr>";
        }
        document.body.appendChild(table);
        table.innerHTML = tableHTML;

        document.documentElement.style.setProperty('--cell-size', '25px');
    </script>
    <div class="bottom-bar">
        <h3>no patterns saved</h3>
    </div>
</body>
<script src="game.js"></script>

</html>
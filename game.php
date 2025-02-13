<?php

session_start();

$patterns = [];

if(!empty($_SESSION['selected'])) {
    [$cell_glow, $cell_color , $background_color] = $_SESSION['selected'];
} else {
    $cell_glow = "yellow";
    $cell_color = "grey";
    $background_color = "black";
}

$width = 0;
$height = 0;

if(!empty($_SESSION['points'])) {
    $points = $_SESSION['points'];
} else {
    $points = 0;
}

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

function parsebool($int) {
    if($int == 1) {
        return true;
    } else if($int == 0) {
        return false;
    } else {
        return "not a bool number";
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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Game of Life</title>
</head>

<body>
    <div class="top-bar">
        <button class="neon-btn" onclick="simulatebutton()">Simulate</button>
        <button class="neon-btn" onclick="simulate()">Step</button>
        <div class="range-container">
        <i class='bx bx-timer bx-md'></i>
        <input type="range" min="1" max="100" id="speed">
        </div>
        <div class="range-container">
        <i class='bx bx-expand bx-md'></i>
        <input type="range" min="1" max="100" id="size" value="<?= $celsize ?>">
        </div>
        <a href="index.php"><button class="neon-btn">Back</button></a>
        <div class="top-bar-coins"><p><?=$points?></p><p>ferris-wheels</p></div>
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

        document.documentElement.style.setProperty('--cell-glow', "<?=$cell_glow?>");
        document.documentElement.style.setProperty('--cell-color', "<?=$cell_color?>");
        document.documentElement.style.setProperty('--background-color', "<?=$background_color?>");
        document.documentElement.style.setProperty('--cell-size', '25px');
    </script>
    <div class="bottom-bar">
        <?php
        if($patterns == []) {
            ?>
            <h3>no patterns saved</h3>
        </div>
        <?php
    } else {
        ?>
        <script>
            let bottombar = document.getElementsByClassName("bottom-bar");
        </script>
        <?php
        foreach($patterns as $pattern) {
            $patternbord = [];
            foreach (explode(".", $pattern['pattern']) as $index => $patter){
                $patternbord[$index] = explode("", $patter);
            }
            ?>
            <div>
                <script>
                    const [width, height] = [<?=explode(", ", $pattern['gamesize'])?>];
                    let patternbord = <?=$patternbord?>;
                    table = document.createElement('table');
                    table.classList.add('grid');
                    tableHTML = '';
                    for (let row = 0; row < height; row++) {
                        tableHTML += "<tr>";
                        for (let col = 0; col < width; col++) {
                            tableHTML += `<td class='pattern <?=parsebool($patternbord[$row][$col])?>' id='${row},${col}'></td>`;
                        }
                        tableHTML += "</tr>";
                    }
                    bottombar.appendChild(table);
                    table.innerHTML = tableHTML;
                </script>
            </div>
            <?php
        }
    }
    ?>
</body>
<script src="game.js"></script>

</html>
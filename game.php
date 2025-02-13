<?php

include("connect.php");
session_start();
$patterns = [];

try {
    $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->execute([$_SESSION['userid']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = $pdo->prepare("SELECT * FROM patternsaves WHERE userid = ?");
    $stmt->execute([$_SESSION['userid']]);
    $patterns = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

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
        <button class="neon-btn" onclick="reset()">reset</button>
        <button class="neon-btn" onclick="randomize()">randomize</button>
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
        const mapwidth = <?= $width ?>;
        const mapheight = <?= $height ?>;
        table = document.createElement('table');
        table.classList.add('grid');
        let tableHTML = '';
        for (let row = 0; row < mapheight; row++) {
            tableHTML += "<tr>";
            for (let col = 0; col < mapwidth; col++) {
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
    <div class="bottom-bar" id="bottom-bar">
        <?php
        if($patterns == []) {
            ?>
            <h3>no patterns saved</h3>
        </div>
        <?php
    } else {
        ?>
        <script>
            let bottombar = document.getElementById("bottom-bar");
            let [breedte, hoogte] = [];
            let patternbord = [];
            let pattern;
        </script>
        <?php
        foreach($patterns as $pattern) {
            $patternsize = explode('x', $pattern['gamesize']);
            ?>
                <script>
                    function parsebool(value) {
                        if (value == "1" || value == 1) {
                            return true;
                        } else if (value == "0" || value == 0) {
                            return false;
                        } else {
                            return "not a bool number";
                        }
                    }

                    [breedte, hoogte] = [<?=$patternsize[0]?>, <?=$patternsize[1]?>];
                    pattern = "<?=$pattern['pattern']?>";
                    pattern = pattern.split("");
                    for(let i = 0; i < hoogte; i += 1) {
                        let y = [];
                        for(let j = 0; j < breedte; j += 1) {
                            y[j] = pattern[j + i * <?=$patternsize[0]?>];
                        }
                        patternbord[i] = y;
                    }
                    card = document.createElement('div');
                    card.classList = "card";
                    table = document.createElement('table');
                    table.classList.add('grid');
                    tableHTML = '';
                    for (let row = 0; row < hoogte; row += 1) {
                        tableHTML += "<tr>";
                        for (let col = 0; col < breedte; col += 1) {
                            tableHTML += `<td class='${parsebool(patternbord[row][col])} patterncel' id='${row}x${col}'></td>`;
                        }
                        tableHTML += "</tr>";
                    }
                    card.appendChild(table);
                    bottombar.appendChild(card);
                    table.innerHTML = tableHTML;
                </script>
            <?php
        }
    }
    ?>
</body>
<script src="game.js"></script>

</html>
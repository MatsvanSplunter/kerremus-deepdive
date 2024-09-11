<?php

$width = 100;
$height = 50;
if($_POST['gridsize']) {
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
        <input type="range" min="1" max="100" id="speed">
        <input type="range" min="1" max="100" id="size" value="<?= $celsize ?>">
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
        table.innerHTML = tableHTML;
        document.body.appendChild(table);

        document.documentElement.style.setProperty('--cell-size', '25px');
    </script>
</body>
<script>
    let size;
    let mousedown;
    let DoSimulate = false;
    let simulation;
    let simbutton = document.querySelector("button");
    let eb;
    let firstcel;
    let lastcel;
    let speed;
    let celsize;

    const bord = [];
    document.querySelectorAll('tr').forEach((tableRow, index) => {
        const cellenInRow = tableRow.querySelectorAll('td');
        bord[index] = Array.from(cellenInRow);
    });

    console.log(bord);

    addEventListener("mouseup", (e) => {
        mousedown = false;
        firstcel = undefined;
        console.debug("mouseup");
    });
    addEventListener("mousedown", (e) => { 
        mousedown = true;
        eb = e.button;
        if (e.target.tagName === "TD") {
            let cell = e.target;
            let [x, y] = cell.id.split(",").map(Number);
            if(e.button == 0 || e.button == 2) {
                toggleCellState(cell);
            }
            console.debug("mousedown");
            if (firstcel) {
                return;
            }
            if (!firstcel && e.target.tagName === "TD") {
                console.debug("setting first cell");
                firstcel = [x, y, bord[x][y].classList];
            }
        }
    });

    document.querySelector("table").addEventListener("mouseover", (event) => {
        if (event.target.tagName === "TD") {
            if(firstcel) {
                let cell = event.target;
                let [x, y] = cell.id.split(",").map(Number);
                lastcel = [x, y];
                let cel2 = [0, 0];
                let cel1 = [0, 0];
                if (firstcel && lastcel) {
                    if (firstcel[0] > lastcel[0]) {
                        cel1[0] = lastcel[0];
                        cel2[0] = firstcel[0];
                    } else {
                        cel2[0] = lastcel[0];
                        cel1[0] = firstcel[0];
                    }
                    if (firstcel[1] > lastcel[1]) {
                        cel1[1] = lastcel[1];
                        cel2[1] = firstcel[1];
                    } else {
                        cel2[1] = lastcel[1];
                        cel1[1] = firstcel[1];
                    }
                }
                if (mousedown && eb == 2) {
                    for (let celx = cel1[0]; celx <= cel2[0]; celx += 1) {
                        for (let cely = cel1[1]; cely <= cel2[1]; cely += 1) {
                            if (firstcel[2] == "false") {
                                bord[celx][cely].classList = "false";
                            } else {
                                bord[celx][cely].classList = "true";
                            }
                        }
                    }
                }
                if (mousedown && eb == 0) {
                    toggleCellState(bord[x][y]);
                }
            }
        }
    });

    function simulate() {
        let celstrue = [];
        let celsfalse = [];

        for (let x = 0; x < width; x++) {
            for (let y = 0; y < height; y++) {
                let omringt = countNeighbors(x, y);
                let cel = bord[x][y];

                if (cel.classList.contains("false")) {
                    if (omringt == 3) {
                        celstrue.push(cel);
                    }
                } else {
                    if (omringt != 2 && omringt != 3) {
                        celsfalse.push(cel);
                    }
                }
            }
        }

        requestAnimationFrame(() => {
            celstrue.forEach(cel => {
                cel.classList.replace("false", "true");
            });
            celsfalse.forEach(cel => {
                cel.classList.replace("true", "false");
            });
        });
    }

    function countNeighbors(x, y) {
        let omringt = 0;
        for (let dx = -1; dx <= 1; dx++) {
            for (let dy = -1; dy <= 1; dy++) {
                if (dx === 0 && dy === 0) continue;
                let nx = x + dx;
                let ny = y + dy;
                if (nx >= 0 && ny >= 0 && nx < width && ny < height) {
                    if (bord[nx][ny].classList.contains("true")) {
                        omringt++;
                    }
                }
            }
        }
        return omringt;
    }

    function checkcel(classList, omringt) {
        if (classList == "true") {
            omringt = omringt + 1;
        }
        return omringt;
    }

    function toggleCellState(cell) {
        if(cell.classList == "true") {
            cell.classList = "false";
        } else {
            cell.classList = "true";
        }
    }

    function simulatebutton() {
        if (simbutton.innerHTML === "Simulate") {
            DoSimulate = true;
            simbutton.innerHTML = "Pause";
            runSimulation();
        } else {
            DoSimulate = false;
            simbutton.innerHTML = "Simulate";
        }
    }

    function runSimulation() {
        if (DoSimulate) {
            simulate();
            requestAnimationFrame(runSimulation);
        }
    }

    document.body.onkeydown = function(e) {
        if (e.key == " ") {
            simulatebutton();
        }
    }

    window.onkeydown = function(e) {
        return !(e.keyCode == 32 && e.target == document.body);
    };
    document.addEventListener('contextmenu', event => {
        event.preventDefault();
    });
    let table = document.querySelector("table");
    table.addEventListener('mousedown', event => {
        event.preventDefault();
    });

    let speedslider = document.getElementById("speed");
    let sizeslider = document.getElementById("size");
    let cels = document.querySelectorAll("td");

    speedslider.addEventListener("mousemove", (e) => {
        speed = (speedslider.value - 100) * -1;
        if (simbutton.innerHTML == "Pause") {
            clearInterval(simulation);
            simulation = setInterval(simulate, speed * 2);
        }
    });

    sizeslider.addEventListener("mousemove", () => {
        document.documentElement.style.setProperty('--cell-size', sizeslider.value + 'px');
    });
</script>

</html>
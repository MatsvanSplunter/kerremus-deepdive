let size;
let mousedown;
let DoSimulate = false;
let simulation;
let simbutton = document.querySelector("button");
let ev;
let firstcel;
let lastcel;
let speed;
let celsize;

const bord = [];
document.querySelectorAll('tr').forEach((tableRow, index) => {
    const cellenInRow = tableRow.querySelectorAll('td');
    bord[index] = Array.from(cellenInRow);
});

document.querySelector("table").addEventListener("mouseover", (event) => {
    if (event.target.tagName === "TD") {
        let cell = event.target;
        let [x, y] = cell.id.split(",").map(Number);
        addEventListener("mousedown", (e) => {
            mousedown = true;
            firstcel = [x, y, bord[x][y].classList];
        });
        addEventListener("mouseup", (e) => {
            mousedown = false;
        });
        lastcel = [x, y];
        let cel2 = [0, 0];
        let cel1 = [0, 0];
        if(firstcel != undefined && lastcel != undefined) {
            if(firstcel[0] > lastcel[0]) {
                cel1[0] = lastcel[0];
                cel2[0] = firstcel[0];
            } else {
                cel2[0] = lastcel[0];
                cel1[0] = firstcel[0];
            }
            if(firstcel[1] > lastcel[1]) {
                cel1[1] = lastcel[1];
                cel2[1] = firstcel[1];
            } else {
                cel2[1] = lastcel[1];
                cel1[1] = firstcel[1];
            }
        }
        if(mousedown && eb == 0) {
            if(bord[x][y].classList == "true") {
                bord[x][y].classList = "false";
            } else {
                bord[x][y].classList = "true";
            }
        } else if(mousedown && eb == 2) {
            for(let celx = cel1[0]; celx <= cel2[0]; celx += 1) {
                for(let cely = cel1[1]; cely <= cel2[1]; cely += 1) {
                    bord[celx][cely].classList = firstcel[2];
                }
            }
        }
    }
});

for (let x = 0; x < width; x += 1) {
    for (let y = 0; y < height; y += 1) {
        bord[x][y].addEventListener("mouseover", (e) => {
            addEventListener("mousedown", (e) => {
                mousedown = true;
                firstcel = [x, y, bord[x][y].classList];
            });
            addEventListener("mouseup", (e) => {
                mousedown = false;
            });
            lastcel = [x, y];
            let cel2 = [0, 0];
            let cel1 = [0, 0];
            if(firstcel != undefined && lastcel != undefined) {
                if(firstcel[0] > lastcel[0]) {
                    cel1[0] = lastcel[0];
                    cel2[0] = firstcel[0];
                } else {
                    cel2[0] = lastcel[0];
                    cel1[0] = firstcel[0];
                }
                if(firstcel[1] > lastcel[1]) {
                    cel1[1] = lastcel[1];
                    cel2[1] = firstcel[1];
                } else {
                    cel2[1] = lastcel[1];
                    cel1[1] = firstcel[1];
                }
            }
            if(mousedown && eb == 0) {
                if(bord[x][y].classList == "true") {
                    bord[x][y].classList = "false";
                } else {
                    bord[x][y].classList = "true";
                }
            } else if(mousedown && eb == 2) {
                for(let celx = cel1[0]; celx <= cel2[0]; celx += 1) {
                    for(let cely = cel1[1]; cely <= cel2[1]; cely += 1) {
                        bord[celx][cely].classList = firstcel[2];
                    }
                }
            }
        });
        bord[x][y].addEventListener("mousedown", (e) => {
            eb = e.button;
            if(e.button == 0 || e.button == 2) {
                if(bord[x][y].classList == "true") {
                    bord[x][y].classList = "false";
                } else {
                    bord[x][y].classList = "true";
                }
            }
        });
    }
}

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

function checkcel(classList, omringt)
{
    if (classList == "true") {
        omringt = omringt + 1;
    }
    return omringt;
}

function toggleCellState(cell) 
{
    cell.classList.toggle("true");
    cell.classList.toggle("false");
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
    if(simbutton.innerHTML == "Pause") {
        clearInterval(simulation);
        simulation = setInterval(simulate, speed * 2);
    }
});

sizeslider.addEventListener("mousemove", () => {
    document.documentElement.style.setProperty('--cell-size', sizeslider.value + 'px');
});
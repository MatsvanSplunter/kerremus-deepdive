let size;
let mousedown;
let DoSimulate = false;
let simulation;
let simbutton = document.querySelector("button");
let pointtext = document.querySelector("p");
let points = parseInt(pointtext.innerHTML);
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
        if (e.button == 0 || e.button == 2) {
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
        if (firstcel) {
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
    let celchange = [];

    for (let x = 0; x < bord.length; x += 1) {
        for (let y = 0; y < bord[0].length; y += 1) {
            let omringt = countNeighbors(x, y);
            let cel = bord[x][y];
            if (cel.classList == "false") {
                console.log(omringt);
                if (omringt == 3) {
                    celchange.push(cel);
                }
            } else {
                if (omringt != 2 && omringt != 3) {
                    celchange.push(cel);
                }
            }
        }
    }
    celchange.forEach(cel => {
        toggleCellState(cel);
    });
}

function countNeighbors(x, y) {
let omringt = 0;
for (let dx = -1; dx <= 1; dx += 1) {
    for (let dy = -1; dy <= 1; dy += 1) {
        if (dx != 0 || dy != 0) {
            let nx = x + dx;
            let ny = y + dy;
            if (nx >= 0 && ny >= 0 && nx < bord.length && ny < bord[0].length) {
                if (bord[nx][ny].classList == "true") {
                    omringt += 1;
                }
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
    if (cell.classList == "true") {
        cell.classList = "false";
    } else {
        cell.classList = "true";
    }
    points += 1;
    pointtext.innerHTML = points;
}

function simulatebutton() {
    if (simbutton.innerHTML === "Simulate") {
        DoSimulate = true;
        simbutton.innerHTML = "Pause";
        simulation = setInterval(simulate, speed * 2);
    } else {
        DoSimulate = false;
        simbutton.innerHTML = "Simulate";
        clearInterval(simulation);
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

sizeslider.addEventListener("change", () => {
    document.documentElement.style.setProperty('--cell-size', sizeslider.value + 'px');
});
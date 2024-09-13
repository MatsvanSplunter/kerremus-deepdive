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
let savepattern;
let patternsize;
let Shiftkeydown;
let selectedpattern;

const bord = [];
let tabel = document.querySelector("table");
tabel.querySelectorAll('tr').forEach((tableRow, index) => {
    const cellenInRow = tableRow.querySelectorAll('td');
    bord[index] = Array.from(cellenInRow);
});

addEventListener("mouseup", (e) => {
    mousedown = false;
    firstcel = undefined;
    $.ajax({
        type: "POST",
        url: "data.php",
        data: { function: "points", points: parseInt(points) },
        success: function(response) {
            //console.log(response);
        }
    });
    if(savepattern){
        $.ajax({
            type: "POST",
            url: "data.php",
            data: { function: "savepattern", pattern: savepattern, size: patternsize },
            success: function(response) {
                console.log(response);
            }
        });
    }
    savepattern = [];
    patternsize = "0.0";
});
addEventListener("mousedown", (e) => {
    mousedown = true;
    eb = e.button;
    points += 1;
    pointtext.innerHTML = points;
    if (e.target.tagName === "TD" && e.target.classList.value.includes("patterncel") == false) {
        let cell = e.target;
        let [x, y] = cell.id.split(",").map(Number);
        if (selectedpattern) {
            console.log(selectedpattern);
            selectedpattern.style.backgroundColor = "transparent";
            let pattern = selectedpattern.children[0];
            pattern = pattern.children[0];
            for (let i = 0; i < pattern.children.length; i += 1) {
                let tr = pattern.children[i];
                for (let j = 0; j < tr.children.length; j += 1) {
                    let td = tr.children[j];
                    bord[x + i][y + j].classList = td.classList.value.split(" ")[0];
                    console.log(td.classList.value);
                }
            }
        }
        if ((e.button == 0 || e.button == 2) && !Shiftkeydown && !selectedpattern) {
            toggleCellState(cell);
        }
        if (firstcel && !selectedpattern) {
            return;
        }
        if (!firstcel && e.target.tagName === "TD" && !selectedpattern) {
            firstcel = [x, y, bord[x][y].classList];
        }
        if (selectedpattern) {
            selectedpattern = undefined;
        }
    } else if (
        e.target.tagName === "TD" ||
        e.target.tagName === "TBODY" ||
        e.target.classList.contains("card")
      ) {
        let element = e.target;
        
        while (element && !element.classList.contains("card")) {
            element = element.parentElement;
          
          if (!element || element.tagName === "BODY") {
            console.log("this is not a saved pattern");
            break;
          } else if (element.classList.contains("card")) {
            let cards = Array.from(document.getElementsByClassName("card"));
            cards.forEach((card) => {
                card.style.backgroundColor = "transparent";
            });
            element.style.backgroundColor = "yellow";
            selectedpattern = element;
            break;
          }
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
                if(!Shiftkeydown) {
                    points += 1;
                    pointtext.innerHTML = points;
                    toggleCellState(bord[x][y]);
                } else {
                    savepattern = [];
                    patternsize = "0,0";
                    for (let celx = cel1[0]; celx <= cel2[0]; celx += 1) {
                        for (let cely = cel1[1]; cely <= cel2[1]; cely += 1) {
                            savepattern.push(bord[celx][cely].classList.value);
                        }
                    }
                    console.log(savepattern);
                    patternsize = `${(cel2[1] - cel1[1])+1}.${(cel2[0] - cel1[0])+1}`;
                }
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
    if (e.key = "Shift") {
        Shiftkeydown = true;
    }
}

document.body.onkeyup = function(e) {
    if (e.key == "Shift") {
        Shiftkeydown = false;
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


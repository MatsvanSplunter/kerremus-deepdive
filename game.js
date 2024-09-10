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
    bord[index] = cellenInRow;
    width = index;
    height = cellenInRow.length;
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

function simulate () {
    let celstrue = [];
    let celsfalse = [];
    for (let x = 0; x < width; x = x + 1) {
        for (let y = 0; y < height; y = y + 1) {
            omringt = 0;
            let cel;
            if (x != 0) {
                if (y != 0) {
                    cel = bord[x-1][y-1];
                    omringt = checkcel(cel.classList, omringt);
                }
                cel = bord[x-1][y];
                omringt = checkcel(cel.classList, omringt);
                if (y != height - 1) {
                    cel = bord[x-1][y+1];
                    omringt = checkcel(cel.classList, omringt);
                }
            }
            if (y != 0) {
                cel = bord[x][y-1];
                omringt = checkcel(cel.classList, omringt);
            }
            if (y != height - 1) {
                cel = bord[x][y+1];
                omringt = checkcel(cel.classList, omringt);
            }
            if (x != width - 1) {
                if (y != 0) {
                    cel = bord[x+1][y-1];
                    omringt = checkcel(cel.classList, omringt);
                }
                cel = bord[x+1][y];
                omringt = checkcel(cel.classList, omringt);
                if (y != height - 1) {
                    cel = bord[x+1][y+1];
                    omringt = checkcel(cel.classList, omringt);
                }
            }
            cel = document.getElementById(`${x}, ${y}`);
            if (cel.classList == "false"){
                if (omringt == 3){
                    celstrue.push(cel);
                }
            } else {
                if (omringt != 2 && omringt != 3){
                    celsfalse.push(cel);
                }
            }
        }
    }
    celstrue.forEach((cel) => {
        cel.classList.remove("false");
        cel.classList.add("true");
    });
    celsfalse.forEach((cel) => {
        cel.classList.remove("true");
        cel.classList.add("false");
    });
}

function checkcel(classList, omringt)
{
    if (classList == "true") {
        omringt = omringt + 1;
    }
    return omringt;
}

function simulatebutton()
{
    if(simbutton.innerHTML == "Simulate") {
        simulation = setInterval(simulate, speed * 2);
        DoSimulate = true;
        simbutton.innerHTML = "Pause";
    } else {
        clearInterval(simulation);
        DoSimulate = false;
        simbutton.innerHTML = "Simulate";
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

sizeslider.addEventListener("mousemove", (e) => {
    cels.forEach((cel) => {
        cel.style.width = `${sizeslider.value}px`;
        cel.style.height = `${sizeslider.value}px`;
    })
});
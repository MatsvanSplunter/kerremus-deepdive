let size;

const bord = [];
document.querySelectorAll('tr').forEach((tableRow, index) => {
    const cellenInRow = tableRow.querySelectorAll('td');
    bord[index] = cellenInRow;
    size = index;
})

for (let x = 0; x < size; x += 1) {
    for (let y = 0; y < size; y += 1) {
        bord[x][y].addEventListener("click", function () {
            if(bord[x][y].classList == "true") {
                bord[x][y].classList = "false";
            } else {
                bord[x][y].classList = "true"
            }
        });
    }
}

let simulation;
function simulate () {
    let celstrue = [];
    let celsfalse = [];
    for (let x = 0; x < size; x = x + 1) {
        for (let y = 0; y < size; y = y + 1) {
            omringt = 0;
            let cel;
            if (x != 0) {
                if (y != 0) {
                    cel = bord[x-1][y-1];
                    omringt = checkcel(cel.classList, omringt);
                }
                cel = bord[x-1][y];
                omringt = checkcel(cel.classList, omringt);
                if (y != size - 1) {
                    cel = bord[x-1][y+1];
                    omringt = checkcel(cel.classList, omringt);
                }
            }
            if (y != 0) {
                cel = bord[x][y-1];
                omringt = checkcel(cel.classList, omringt);
            }
            if (y != size - 1) {
                cel = bord[x][y+1];
                omringt = checkcel(cel.classList, omringt);
            }
            if (x != size - 1) {
                if (y != 0) {
                    cel = bord[x+1][y-1];
                    omringt = checkcel(cel.classList, omringt);
                }
                cel = bord[x+1][y];
                omringt = checkcel(cel.classList, omringt);
                if (y != size - 1) {
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
    if(simulation == true) {
        clearInterval(simulation);
    } else {
        simulation = setInterval(simulate, 0);
    }
}

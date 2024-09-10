for (let x = 0; x < 100; x = x + 1) {
    for (let y = 0; y < 100; y = y + 1) {
        let cel = document.getElementById(`${x}, ${y}`);
        cel.addEventListener("click", function () {
            if(cel.classList == "true") {
                cel.classList = "false";
            } else {
                cel.classList = "true"
            }
        });
    }
}

const bord = [];
document.querySelectorAll('tr').forEach((tableRow, index) => {
    const cellenInRow = tableRow.querySelectorAll('td');
    bord[index] = cellenInRow
})
console.log(bord);

let simulation;
function simulate () {
    let celstrue = [];
    let celsfalse = [];
    for (let x = 0; x < 500; x = x + 1) {
        for (let y = 0; y < 500; y = y + 1) {
            omringt = 0;
            let cel;
            if (x != 0) {
                if (y != 0) {
                    cel = bord[x-1][y-1]
                    // cel = document.getElementById(`${x-1}, ${y-1}`);
                    omringt = checkcel(cel.classList, omringt);
                }
                cel = document.getElementById(`${x-1}, ${y}`);
                omringt = checkcel(cel.classList, omringt);
                if (y != 199) {
                    cel = document.getElementById(`${x-1}, ${y+1}`);
                    omringt = checkcel(cel.classList, omringt);
                }
            }
            if (y != 0) {
                cel = document.getElementById(`${x}, ${y-1}`);
                omringt = checkcel(cel.classList, omringt);
            }
            if (y != 199) {
                cel = document.getElementById(`${x}, ${y+1}`);
                omringt = checkcel(cel.classList, omringt);
            }
            if (x != 199) {
                if (y != 0) {
                    cel = document.getElementById(`${x+1}, ${y-1}`);
                    omringt = checkcel(cel.classList, omringt);
                }
                cel = document.getElementById(`${x+1}, ${y}`);
                omringt = checkcel(cel.classList, omringt);
                if (y != 199) {
                    cel = document.getElementById(`${x+1}, ${y+1}`);
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
        simulation = setInterval(simulate, 10);
    }
}

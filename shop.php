<?php

include_once("connect.php");

session_start();
$stmt = $pdo->query("SELECT * FROM users WHERE id = ?");
$user = $stmt->fetch($_SESSION['userid']);

$points = 20000000;
$selected = ["yellow", "grey", "black"];
if(!empty($_SESSION['selected'])) {
    $selected = $_SESSION['selected'];
}
if(!empty($_SESSION['points'])) {
    $points = $_SESSION['points'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="shop.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <a href="index.php"><button class="neon-btn">back</button></a>
    <h1 class="title">Shop</h1>
    <h1>glowing colors</h1>
    <div class="cardrowcolors">
        <div class="cards">
            <h1>yellow</h1>
            <img src="yellow.png" alt="yellow">
            <p id="glow-yellow">free</p>
            <?php
            if($selected[0] = "yellow") {
                ?>
                <button class="neon-btn" id="glow-yellow" value="selected">selected</button>
                <?php
            }
            ?>
        </div>
        <div class="cards">
            <h1>red</h1>
            <img src="red.png" alt="red">
            <p id="glow-red">price: 200</p>
            <?php
            if($selected[0] = "red") {
            ?>
            <button class="neon-btn" id="glow-red" value="selected">selected</button>
            <?php
            }
            ?>
        </div>
        <div class="cards">
            <h1>pink</h1>
            <img src="pink.png" alt="red">
            <p id="glow-pink">price: 600</p>
            <?php
            if($selected[0] = "pink") {
            ?>
            <button class="neon-btn" id="glow-pink" value="selected">selected</button>
            <?php
            }
            ?>
        </div>
        <div class="cards">
            <h1>blue</h1>
            <img src="blue.png" alt="red">
            <p id="glow-blue">price: 800</p>
            <?php
            if($selected[0] = "blue") {
            ?>
            <button class="neon-btn" id="glow-blue" value="selected">selected</button>
            <?php
            }
            ?>
        </div>
        <div class="cards">
            <h1>orange</h1>
            <img src="orange.png" alt="red">
            <p id="glow-orange">price: 1k</p>
            <?php
            if($selected[0] = "orange") {
            ?>
            <button class="neon-btn" id="glow-orange" value="selected">selected</button>
            <?php
            }
            ?>
        </div>
    </div>
    <h1>cell color</h1>
    <div class="cardrowcolors">
        <div class="cards">
            <h1>grey</h1>
            <p id="cell-grey">free</p>
            <?php
            if($selected[1] = "grey") {
            ?>
            <button class="neon-btn" id="cell-grey" value="selected">selected</button>
            <?php
            }
            ?>
        </div>
        <div class="cards">
            <h1>red</h1>
            <p id="cell-red">price: 400</p>
            <?php
            if($selected[1] = "red") {
            ?>
            <button class="neon-btn" id="cell-red" value="selected">selected</button>
            <?php
            }
            ?>
        </div>
        <div class="cards">
            <h1>pink</h1>
            <p id="cell-pink">price: 600</p>
            <?php
            if($selected[1] = "pink") {
            ?>
            <button class="neon-btn" id="cell-pink" value="selected">selected</button>
            <?php
            }
            ?>
        </div>
        <div class="cards">
            <h1>transparent</h1>
            <p id="cell-transparent">price: 2k</p>
            <?php
            if($selected[1] = "transparent") {
            ?>
            <button class="neon-btn" id="cell-transparent" value="selected">selected</button>
            <?php
            }
            ?>
        </div>
        <div class="cards">
            <h1>black</h1>
            <p id="cell-black">price: 10k</p>
            <?php
            if($selected[1] = "black") {
            ?>
             <button class="neon-btn" id="cell-black" value="selected">selected</button>
            <?php
            }
            ?>
        </div>
    </div>
    <h1>background colors</h1>
    <div class="cardrowcolors">
        <div class="cards">
            <h1>black</h1>
            <p id="background-black">free</p>
            <?php
            if($selected[2] = "black") {
            ?>
            <button class="neon-btn" id="background-black" value="selected">selected</button>
            <?php
            }
            ?>
        </div>
        <div class="cards">
            <h1>yellow</h1>
            <p id="background-yellow">price: 400</p>
            <?php
            if($selected[2] = "yellow") {
            ?>
            <button class="neon-btn" id="background-yellow" value="selected">selected</button>
            <?php
            }
            ?>
        </div>
        <div class="cards">
            <h1>blue</h1>
            <p id="background-blue">price: 600</p>
            <?php
            if($selected[2] = "blue") {
            ?>
            <button class="neon-btn" id="background-blue" value="selected">selected</button>
            <?php
            }
            ?>
        </div>
        <div class="cards">
            <h1>red</h1>
            <p id="background-red">price: 800</p>
            <?php
            if($selected[2] = "red") {
            ?>
            <button class="neon-btn" id="background-red" value="selected">selected</button>
            <?php
            }
            ?>
        </div>
        <div class="cards">
            <h1>white</h1>
            <p id="background-white">price: 1k</p>
            <?php
            if($selected[2] = "white") {
            ?>
            <button class="neon-btn" id="background-white" value="selected">selected</button>
            <?php
            } else if($user[''])
            ?>
        </div>
    </div>
</body>
<script>
let points = <?=$points?>;
let notbought = [];
let selected = [];
let select = [];
let prices = document.querySelectorAll("p");

function refresh() {
    [notbought, selected, select] = [[], [], []];
    console.log("refresh");
    document.querySelectorAll("button").forEach((button) => {
        if(button.value == "buy") {
            notbought.push(button);
        } else if(button.value == "selected") {
            selected.push(button);
        } else if(button.value == "select") {
            select.push(button);
        }
    });
}

window.addEventListener("click", (event) => {
    if (event.target.tagName === "BUTTON") {
        let button = event.target;
        if(button.value == "buy") {
            let priceElement = Array.from(prices).find((price) => price.id == button.id);
            let price = priceElement ? priceElement.innerHTML.substr(7) : null;

            if (price) {
                if (price.slice(-1) == "k") {
                    price = parseInt(price.slice(0, -1)) * 1000;
                } else {
                    price = parseInt(price);
                }

                if(points >= price) {
                    points -= price;
                    $.ajax({
                        method: "POST",
                        url: "data.php",
                        data: { function: "buy", buying: button.id, points: price }
                    })
                    .done(function(response) {
                        $("p.broken").html(response);
                    });
                    button.value = "select";
                    button.innerHTML = "select";
                    console.log("bought");
                } else {
                    console.log("You don't have enough points. Click more in the game to get more points.");
                }
            } else {
                console.log("Price not found for this item.");
            }
        } else if (button.value == "select") {
            let button = event.target;
            let [type, color] = button.id.split("-");
            button.value = "selected";
            button.innerHTML = "selected";
            selected.forEach((button2) => {
                if(button2.id.split("-")[0] == type) {
                    button2.value = "select";
                    button2.innerHTML = "select";
                }
            });
            $.ajax({
                method: "POST",
                url: "data.php",
                data: { function: "select", selected: type, color: color }
            })
            .done(function(response) {
                $("p.broken").html(response);
            });
        }
        refresh();
    }
});
refresh();
</script>
</html>
<?php


include_once("connect.php");

session_start();

$points = 0;
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
            <button class="neon-btn" id="glow-yellow" value="selected">selected</button>
        </div>
        <div class="cards">
            <h1>red</h1>
            <img src="red.png" alt="red">
            <p id="glow-red">price: 200</p>
            <button class="neon-btn" id="glow-red" value="buy">buy</button>
        </div>
        <div class="cards">
            <h1>pink</h1>
            <img src="pink.png" alt="red">
            <p id="glow-pink">price: 600</p>
            <button class="neon-btn" id="glow-pink" value="buy">buy</button>
        </div>
        <div class="cards">
            <h1>blue</h1>
            <img src="blue.png" alt="red">
            <p id="glow-blue">price: 800</p>
            <button class="neon-btn" id="glow-blue" value="buy">buy</button>
        </div>
        <div class="cards">
            <h1>orange</h1>
            <img src="orange.png" alt="red">
            <p id="glow-orange">price: 1k</p>
            <button class="neon-btn" id="glow-orange" value="buy">buy</button>
        </div>
    </div>
    <h1>cell color</h1>
    <div class="cardrowcolors">
        <div class="cards">
            <h1>grey</h1>
            <p id="cell-grey">free</p>
            <button class="neon-btn" id="cell-grey" value="selected">selected</button>
        </div>
        <div class="cards">
            <h1>red</h1>
            <p id="cell-red">price: 400</p>
            <button class="neon-btn" id="cell-red" value="buy">buy</button>
        </div>
        <div class="cards">
            <h1>pink</h1>
            <p id="cell-pink">price: 600</p>
            <button class="neon-btn" id="cell-pink" value="buy">buy</button>
        </div>
        <div class="cards">
            <h1>transparent</h1>
            <p id="cell-transparent">price: 2k</p>
            <button class="neon-btn" id="cell-transparent" value="buy">buy</button>
        </div>
        <div class="cards">
            <h1>black</h1>
            <p id="cell-black">price: 10k</p>
             <button class="neon-btn" id="cell-black" value="buy">buy</button>
        </div>
    </div>
    <h1>background colors</h1>
    <div class="cardrowcolors">
        <div class="cards">
            <h1>black</h1>
            <p id="background-black">free</p>
            <button class="neon-btn" id="background-black" value="selected">selected</button>
        </div>
        <div class="cards">
            <h1>yellow</h1>
            <p id="background-yellow">price: 400</p>
            <button class="neon-btn" id="background-yellow" value="buy">buy</button>
        </div>
        <div class="cards">
            <h1>blue</h1>
            <p id="background-blue">price: 600</p>
            <button class="neon-btn" id="background-blue" value="buy">buy</button>
        </div>
        <div class="cards">
            <h1>red</h1>
            <p id="background-red">price: 800</p>
            <button class="neon-btn" id="background-red" value="buy">buy</button>
        </div>
        <div class="cards">
            <h1>white</h1>
            <p id="background-white">price: 1k</p>
            <button class="neon-btn" id="background-white" value="buy">buy</button>
        </div>
    </div>
</body>
<script>
    let points = <?=$points?>;
let notbought = [];
let prices = document.querySelectorAll("p");

document.querySelectorAll("button").forEach((button) => {
    if(button.value == "buy") {
        notbought.push(button);
    }
});

notbought.forEach((button) => {
    button.addEventListener("click", (event) => {
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
            } else {
                console.log("You don't have enough points. Click more in the game to get more points.");
            }
        } else {
            console.log("Price not found for this item.");
        }
    });
});
</script>
</html>
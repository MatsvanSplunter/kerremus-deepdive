<?php


include_once("connect.php");

session_start();

$selected = ["yellow", "grey", "black"];
if(!empty($_SESSION['selected'])) {
    $selected = $_SESSION['selected'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="shop.css">
</head>
<body>
    <a href="index.php"><button class="neon-btn">back</button></a>
    <h1 class="title">Shop</h1>
    <h1>glowing colors</h1>
    <div class="cardrowcolors">
        <div class="cards">
            <h1>yellow</h1>
            <img src="yellow.png" alt="yellow">
            <p>free</p>
            <button class="neon-btn" id="glow-yellow" value="selected">selected</button>
        </div>
        <div class="cards">
            <h1>red</h1>
            <img src="red.png" alt="red">
            <p>price: 200</p>
            <button class="neon-btn" id="glow-red" value="buy">buy</button>
        </div>
        <div class="cards">
            <h1>pink</h1>
            <img src="pink.png" alt="red">
            <p>price: 600</p>
            <button class="neon-btn" id="glow-pink" value="buy">buy</button>
        </div>
        <div class="cards">
            <h1>blue</h1>
            <img src="blue.png" alt="red">
            <p>price: 800</p>
            <button class="neon-btn" id="glow-blue" value="buy">buy</button>
        </div>
        <div class="cards">
            <h1>orange</h1>
            <img src="orange.png" alt="red">
            <p>price: 1k</p>
            <button class="neon-btn" id="glow-orange" value="buy">buy</button>
        </div>
    </div>
    <h1>cell color</h1>
    <div class="cardrowcolors">
        <div class="cards">
            <h1>grey</h1>
            <p>free</p>
            <button class="neon-btn" id="cell-grey" value="selected">selected</button>
        </div>
        <div class="cards">
            <h1>red</h1>
            <p>price: 400</p>
            <button class="neon-btn" id="cell-red" value="buy">buy</button>
        </div>
        <div class="cards">
            <h1>pink</h1>
            <p>price: 600</p>
            <button class="neon-btn" id="cell-pink" value="buy">buy</button>
        </div>
        <div class="cards">
            <h1>transparent</h1>
            <p>price: 2k</p>
            <button class="neon-btn" id="cell-transparent" value="buy">buy</button>
        </div>
        <div class="cards">
            <h1>black</h1>
            <p>price: 10k</p>
             <button class="neon-btn" id="cell-black" value="buy">buy</button>
        </div>
    </div>
    <h1>background colors</h1>
    <div class="cardrowcolors">
        <div class="cards">
            <h1>black</h1>
            <p>free</p>
            <button class="neon-btn" id="background-black" value="selected">selected</button>
        </div>
        <div class="cards">
            <h1>yellow</h1>
            <p>price: 400</p>
            <button class="neon-btn" id="background-yellow" value="buy">buy</button>
        </div>
        <div class="cards">
            <h1>blue</h1>
            <p>price: 600</p>
            <button class="neon-btn" id="background-blue" value="buy">buy</button>
        </div>
        <div class="cards">
            <h1>red</h1>
            <p>price: 800</p>
            <button class="neon-btn" id="background-red" value="buy">buy</button>
        </div>
        <div class="cards">
            <h1>white</h1>
            <p>price: 1k</p>
            <button class="neon-btn" id="background-white" value="buy">buy</button>
        </div>
    </div>
</body>
<script>
    let notbought = [];
    document.querySelectorAll("button").forEach((button) => {
        if(button.value == "buy") {
            notbought.push(button);
        }
    });
    notbought.forEach((button) => {
        button.addeventlistener("click", (button) => {
        $.ajax({
            method: "POST",
            url: "wrap.php",
            data: { function: "buy", buying: button.id }
        })
        .done(function( response ) {
            $("p.broken").html(response);
        });
        });
    });
</script>
</html>
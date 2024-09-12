<?php

//dit is geen pagina dit is een file puur om op te slaan!

include_once("connect.php");
$dbhost = "localhost";
$dbname = "kerremus_deepdive";
$dbuser = "bit_academy";
$dbpass = "bit_academy";

$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

session_start();

if($_POST['function']) {
    switch ($_POST["function"]) {
        case "buy":
            buy();
            break;
        default:
        break;
    }
}

function buy() {

}
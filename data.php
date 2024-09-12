<?php

//dit is geen pagina dit is een file puur om op te slaan!

include_once("connect.php");
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
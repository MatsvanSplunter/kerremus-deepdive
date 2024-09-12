<?php

//dit is geen pagina dit is een file puur om op te slaan!

include("connect.php");
session_start();

$stmt = $pdo->query("SELECT * FROM users WHERE id = ?");
$user = $stmt->fetch($_SESSION['userid']);

if($_POST['function']) {
    switch ($_POST["function"]) {
        case "buy":
            buy($pdo, $_POST["buying"]);
            break;
        default:
        break;
    }
}

function buy($pdo, $id) {
    [$type, $color] = explode("-", $id);
    switch($type) {
        case "background":
            $sql = "UPDATE users SET backroundcolor";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([]);
            break;
        case "cell":
            break;
        case "glow":
            break;
        default:
            break;
    }
}
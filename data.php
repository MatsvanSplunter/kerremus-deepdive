<?php

//dit is geen pagina dit is een file puur om op te slaan!

include("connect.php");
session_start();

$stmt = $pdo->query("SELECT * FROM user WHERE id = ?");
$user = $stmt->fetch($_SESSION['userid']);

if($_POST['function']) {
    switch ($_POST["function"]) {
        case "buy":
            buy($pdo, $user, $_POST["buying"]);
            $_SESSION['points'] = $_POST['points'];
            break;
        case "select":
            switch ($_POST['selected']) {
                case 'glow':
                    $_SESSION['select'][0] = $_POST['color'];
                    break;
                case 'cel':
                    $_SESSION['select'][2] = $_POST['color'];
                    break;
                case 'background':
                    $_SESSION['select'][1] = $_POST['color'];
                    break;
                default:
                    break;

            }
            break;
        default:
            break;
    }
}

function buy($pdo, $user, $id) {
    [$type, $color] = explode("-", $id);
    switch($type) {
        case "background":
            if (empty($user['backgroundcolor'])) {
                $user['backgroundcolor'] = 'black';
            }
            $colors = $user['backgroundcolor'] . ', ' . $color;
            $sql = "UPDATE users SET backroundcolor=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$colors, $_SESSION['userid']]);
            break;
        case "cell":
            if (empty($user['celcolor'])) {
                $user['celcolor'] = 'grey';
            }
            $colors = $user['celcolor'] . ', ' . $color;
            $sql = "UPDATE users SET celcolor=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$colors, $_SESSION['userid']]);
            break;
        case "glow":
            if (empty($user['color'])) {
                $user['color'] = 'yellow';
            }
            $colors = $user['color'] . ', ' . $color;
            $sql = "UPDATE users SET color=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$colors, $_SESSION['userid']]);
            break;
        default:
            break;
    }
}
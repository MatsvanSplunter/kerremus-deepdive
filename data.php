<?php
include("connect.php");
session_start();

try {
    $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->execute([$_SESSION['userid']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if (isset($_POST['function'])) {
    switch ($_POST["function"]) {
        case "buy":
            buy($pdo, $user, $_POST["buying"], $_POST["points"]);
            $_SESSION['points'] = $_POST['points'];
            echo "Item bought successfully!";
            break;
        case "select":
            switch ($_POST['selected']) {
                case 'glow':
                    $_SESSION['select'] = [$_POST['color'], $_SESSION['select'][1], $_SESSION['select'][2]];
                    var_dump($_SESSION['select']);
                    break;
                case 'cell':
                    $_SESSION['select'] = [$_SESSION['select'][0], $_POST['color'], $_SESSION['select'][2]];
                    var_dump($_SESSION['select']);
                    break;
                case 'background':
                    $_SESSION['select'] = [$_SESSION['select'][0], $_SESSION['select'][1], $_POST['color']];
                    var_dump($_SESSION['select']);
                    break;
                default:
                    echo "Invalid selection.";
            }
            break;
        default:
            echo "Invalid function call.";
            break;
    }
}

function buy($pdo, $user, $itemId, $points) {
    [$type, $color] = explode("-", $itemId);
    $_SESSION['points'] -= $points;
    switch($type) {
        case "background":
            $colors = !empty($user['backgroundcolor']) ? $user['backgroundcolor'] . ', ' . $color : $color;
            $sql = "UPDATE user SET backgroundcolor=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$colors, $_SESSION['userid']]);
            break;
        case "cell":
            $colors = !empty($user['celcolor']) ? $user['celcolor'] . ', ' . $color : $color;
            $sql = "UPDATE user SET celcolor=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$colors, $_SESSION['userid']]);
            break;
        case "glow":
            $colors = !empty($user['color']) ? $user['color'] . ', ' . $color : $color;
            $sql = "UPDATE user SET color=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$colors, $_SESSION['userid']]);
            break;
    }
    echo "Bought: " . $color;
}
?>
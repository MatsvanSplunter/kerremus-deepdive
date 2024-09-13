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
                    $_SESSION['selected'] = [$_POST['color'], $_SESSION['selected'][1], $_SESSION['selected'][2]];
                    break;
                case 'cell':
                    $_SESSION['selected'] = [$_SESSION['selected'][0], $_POST['color'], $_SESSION['selected'][2]];
                    break;
                case 'background':
                    $_SESSION['selected'] = [$_SESSION['selected'][0], $_SESSION['selected'][1], $_POST['color']];
                    break;
                default:
                    echo "Invalid selection.";
            }
            break;
        case "points":
            $_SESSION['points'] = $_POST['points'];
            break;
        case "savepattern":
            savepattern($pdo);
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

function savepattern($pdo) {
    $size = explode(".", $_POST['size']);
    if($size[0] != 0 && $size[1] != 0) {
        $pattern = "";
        foreach($_POST['pattern'] as $cel) {
            echo $cel;
            if($cel == "true") {
                $pattern .= "1";
            } else {
                $pattern .= "0";
            }
        }
        $sql = "INSERT INTO patternsaves (pattern, gamesize, userid) VALUES (?,?,?)";
        $stmt = $pdo->prepare($sql);
        $size = join(".", $size);
        $stmt->execute([$pattern, $size, $_SESSION['userid']]);
    }
}

function savegame($pdo) {
    $rawpattern = explode(",", $_POST['pattern']);
    $size = explode(".", $_POST['size']);
    $pattern = [];
    for ($i = 0; $i < $size[1]; $i++){
        $y = [];
        for ($j = 0; $j < $size[0]; $j++){
            if(str_contains($rawpattern[$j + $i * $size[0]], "true")) {
                $y[$j] = "1";
            } else {
                $y[$j] = "0";
            }
        }
        $pattern[$i] = join($y);
    }
    $pattern = join($pattern);
    $sql = "INSERT INTO patternsaves (bord, gamesize, userid) VALUES (?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$pattern, $_POST['size'], $_SESSION['userid']]);
}
?>
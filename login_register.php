<?php
error_reporting(0);
if ($_GET["login/register"] == 'login') {

        include_once("connect.php");
        $dbhost = "localhost";
        $dbname = "kerremus_deepdive";
        $dbuser = "bit_academy";
        $dbpass = "bit_academy";

        try {
            $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            session_start();

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if ($_POST['gebruikersnaam'] == "") {
                    echo 'fill in a username';
                } elseif ($_POST['password'] == "") {
                    echo "fill in your password";
                } else {
                    $password = $_POST['password'];
                    $stmt = $pdo->prepare('SELECT * FROM users WHERE gebruikersnaam = :gebruikersnaam');
                    $stmt->execute([':gebruikersnaam' => $_POST['gebruikersnaam']]);
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($row !== false) {
                        var_dump($row);
                        if (password_verify($password, $row['password'])) {
                            $_SESSION['admintoegang'] = $row['admintoegang'];
                            $_SESSION['account'] = $_POST['gebruikersnaam'];
                            header("Location: index.php");
                            exit;
                        }
                    } else {
                        echo "Invalid username or password";
                    }
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>login</title>
            <style>
                body {
                    background-color: darkgray
                }

                .login-forum {
                    display: grid;
                    justify-items: center;
                    margin-top: 53mm;
                }

                .button {
                    margin-top: 5mm;
                    margin-right: 5px;
                    padding: 10px 20px;
                    background-color: #007bff;
                    color: #fff;
                    border: none;
                    border-radius: 5px;
                }

                .button:hover {
                    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
                }

                .knop {
                    display: inline-block;
                    padding: 8px 16px;
                    background-color: #007bff;
                    color: #fff;
                    font-size: 16px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    text-decoration: none;
                    transition: background-color 0.3s;
                }
            </style>
        </head>

        <body>
            <div class="login-forum">
                <form method="POST">
                    <h1>username</h1>
                    <input type="text" name="gebruikersnaam" id="gebruikersnaam">
                    <h1>password</h1>
                    <input type="password" name="password" id="password">
                    <div class="button-container">
                        <input type="submit" class="button" value="login" id="login">
                        <a href="register.php" class="knop">register</a>
                    </div>
                </form>
            </div>
        </body>

        </html>
        <?php
            } else {
            ?>
        <!--  -->

        <?php

        include_once("connect.php");
        $dbhost = "localhost";
        $dbname = "kerremus_deepdive";
        $dbuser = "bit_academy";
        $dbpass = "bit_academy";

        $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            try {
                if ($_POST['gebruikersnaam'] !== null && $_POST['password'] !== null && $_POST['verifypassword'] !== null) {
                    if ($_POST['password'] == $_POST['verifypassword']) {
                        $password = $_POST['password'];
                        $hashpassword = password_hash($password, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO users (gebruikersnaam, password, admintoegang)
                        VALUES (:gebruikersnaam, :password, :admintoegang)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([
                            ":gebruikersnaam" => $_POST['gebruikersnaam'],
                            ":password" => $hashpassword,
                            ":admintoegang" => "NO"
                        ]);
                        header('Location: login.php');
                        exit();
                    } else {
                        echo "password doesn't match";
                    }
                } else {
                    echo "warning: fill all in";
                }
            } catch (\Throwable $th) {
                if ($th instanceof \PDOException && $th->errorInfo[1] == 1062) {
                    echo "gebruikersnaam bestaat al";
                } else {
                    var_dump($th);
                }
            }
        }

        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="login.css">
        </head>

        <body>
            <div class="container">
            <div class="register-forum">
                <form method="post">
                    <h1>username</h1>
                    <input type="text" name="gebruikersnaam" id="gebruikersnaam">
                    <h1>password</h1>
                    <input type="password" name="password" id="password">
                    <h1>verify password</h1>
                    <input type="password" name="verifypassword" id="verifypassword">
                    <div>
                        <input type="submit" class="button" value="register user" name="submit" id="submit">
                    </div>
                </form>
            </div>
            </div>
        </body>

</html>
<?php
    }
?>
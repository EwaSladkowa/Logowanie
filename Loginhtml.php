<?php
$message = "Wpisz login i hasło";
$messageType = "info";

ini_set('display_errors', 1);
error_reporting(E_ALL);


if (!empty($_POST["Login"]) && !empty($_POST["Haslo"]) && !empty($_POST["button"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "logowanie";

    $link = mysqli_connect($servername, $username, $password, $dbname);
    if (!$link) {
        die(mysqli_connect_error());
    }

    $Login = $_POST["Login"];
    $Haslo = $_POST["Haslo"];
    $action = $_POST["button"];
    if ($action == "Login") {
        $query = "SELECT Login, Haslo FROM uzytkownicy WHERE `Login`='$Login' AND `Haslo`='$Haslo'";
        $res = mysqli_query($link, $query);
        $user = mysqli_fetch_assoc($res);

        if ($user) {
            $message = "Zalogowano";
            $messageType = "success";
        } else {
            $message = "Nieprawidłowy login lub hasło";
            $messageType = "error";
        }

    } elseif ($action == "Registracja") {
      
        $s = "SELECT COUNT(*) FROM uzytkownicy WHERE `Login`='$Login'";
        $res1 = mysqli_query($link, $s);
        if ($res1){
            $row = mysqli_fetch_row($res1);
            if ($row[0] > 0){
                $message = "Taki login już istnieje";
                $messageType = "error";
            }else{
                $query = "INSERT INTO `uzytkownicy`(`Login`, `Haslo`) VALUES ('$Login','$Haslo')";
                $res = mysqli_query($link, $query);
    
                if ($res) {
                    $message = "Dodano do bazy";
                    $messageType = "success";
                } else {
                    $message = "Nie udało się zarejestrować";
                    $messageType = "error";
                }
            }
        }else {
            $message = "Błąd podczas sprawdzania loginu";
            $messageType = "error";
        }
    }

    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Login.css">
    <title>Login</title>
</head>


<body>
    <br><br>
    <form class="form" method="post">
        <?php if (!empty($message)): ?>
            <div class="message <?php echo $messageType; ?>">
                <h1 style="margin-top:20px;"><?php echo htmlspecialchars($message); ?></h1>
            </div>
        <?php endif; ?>
        <div class="b">
            <input name="Login" class="input1 input-label" id="login-input" type="text" placeholder=" " required/>
            <label for="login-input" class="a">User</label>
        </div>
        <br>
        <div class="b">
            <input name="Haslo" class="input2 input-label" id="password-input" placeholder=" " type="password" required/>
            <label for="password-input" class="a">Password</label>
        </div>
        <br>
        <div class="btn">
            <button class="button1" name="button" value="Registracja" type="submit">Registracja</button>
            <button class="button2" name="button" value="Login" type="submit">Login</button>
        </div>
        <br>
    </form>

    <div class="bb  bb1"></div>
    <div class="bb  bb2"></div>
    <div class="bb  bb3"></div>
    <div class="bb  bb4"></div>
    <div class="bb  bb5"></div>
    <script src="Login.js"></script>
</body>

</html>


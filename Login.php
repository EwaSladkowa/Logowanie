<?php
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
Print "<p>$message</p>";
?>
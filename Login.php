<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$message = "Wpisz login i hasło";
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
        } else {
            $message = "Nieprawidłowy login lub hasło";
        }

    } elseif ($action == "Registracja") {
      
        $s = "SELECT COUNT(*) FROM uzytkownicy WHERE `Login`='$Login'";
        $res1 = mysqli_query($link, $s);
        if ($res1){
            $row = mysqli_fetch_row($res1);
            if ($row[0] > 0){
                $message = "Taki login już istnieje";
            }else{
                $query = "INSERT INTO `uzytkownicy`(`Login`, `Haslo`) VALUES ('$Login','$Haslo')";
                $res = mysqli_query($link, $query);
    
                if ($res) {
                    $message = "Dodano do bazy";
                } else {
                    $message = "Nie udało się zarejestrować";
                }
            }
        }else {
            $message = "Błąd podczas sprawdzania loginu";
        }
    }

    mysqli_close($link);
}
echo "<p>$message</p>";
?>
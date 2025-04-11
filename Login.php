<?php
if (!empty($_POST["Login"]) && !empty($_POST["Haslo"]) && !empty($_POST["button"])){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logowanie";

$link = mysqli_connect(hostname: $servername, username: $username, password: $password = "",database: $dbname);


if (!$link ){
    die(mysqli_error(mysql: $link));
}

$Login = $_POST["Login"];
$Haslo = $_POST["Haslo"];
$action = $_POST["button"];

if (!empty($_POST["Haslo"]) and !empty($_POST["Login"])){

if  ($action == "Login"){
    echo "ujg";
    $query = "SELECT `Login`, `Haslo` FROM `uzytkownicy` WHERE login='$Login' AND password='$Haslo'";
    $res =  mysqli_query($query, $link);
    $user = mysqli_fetch_assoc($res);
    
    if ($user) {
        echo "aaaaaaaaaaaaaaaaaaaa";
    } else {
        echo ":(";
    }

}
elseif ($action == "Registracja") {
       $query = "INSERT INTO `uzytkownicy`(`Login`, `Haslo`) VALUES ('$Login','$Haslo')" ;
       $res =  mysqli_query($query, $link);
    
       if ($res){
        echo "Dodano do bazy";
       }else{
        echo ":((";
       }
}

}
mysqli_close(mysql: $link);
}
?>
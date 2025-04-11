<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logowanie";

$connection = mysqli_connect(hostname: $servername, username: $username, password: $password = "",database: $dbname);


if (!$connection ){
    die(mysqli_error(mysql: $connection));
}

$Login = $_POST["Login"];
$Haslo = $_POST["Haslo"];

mysqli_query(
    $connection,
    query: INSERT INTO `uzytkownicy`(`Login`, `hASŁO`) VALUES ('$Login','$Haslo');
);
mysqli_close(mysql: $connection);








?>
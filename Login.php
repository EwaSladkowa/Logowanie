
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);



if (!empty($_POST["Login"]) && !empty($_POST["Haslo"]) && !empty($_POST["button"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "logowanie";

    $Login = $_POST["Login"] ?? null;
    $Haslo = $_POST["Haslo"] ?? null;
    $action = $_POST["button"] ?? null;
 
    $link = mysqli_connect($servername, $username, $password, $dbname);
    if (!$link) {
        die(mysqli_connect_error());
    }
        if ($action == "Login") {
                $query = "SELECT Login, Haslo FROM uzytkownicy WHERE `Login`='$Login' AND `Haslo`='$Haslo'";
                $res = mysqli_query($link, $query);
                $user = mysqli_fetch_assoc($res);

                if ($user) {
                        $message = "Zalogowano";
                        $messageType = "success";
                }else {
                        header("Location: Loginhtml.php?message=Nieprawidłowy+login+lub+hasło&messageType=error");
                        exit;
                }
        }elseif ($action == "Rejestracja") {
                $s = "SELECT COUNT(*) FROM uzytkownicy WHERE `Login`='$Login'";
                $res1 = mysqli_query($link, $s);
                if ($res1) {
                        $row = mysqli_fetch_row($res1);
                        $count = $row[0];
                    
                        if ($count > 0) {
                            header("Location: Loginhtml.php?message=Taki+login+już+istnieje&messageType=error");
                            exit;
                        }
                    }
                $query = "INSERT INTO `uzytkownicy`(`Login`, `Haslo`) VALUES ('$Login','$Haslo')";
                $res = mysqli_query($link, $query);          
        if ($res) {
                $message = "Dodano do bazy";
                $messageType = "success";
                
            }else{
                header("Location: Loginhtml.php?message=Nie+udało+się+zarejestrować&messageType=error");
                exit;
            }
            }else{
                header("Location: Loginhtml.php?message=Błąd+podczas+sprawdzania+loginu&messageType=error");
                exit;
            }
        }

mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Login1.css">
        <title>Login</title>
</head>
<body>
        <form class="form" method="post">
                <?php if (!empty($message)): ?>
                        <div class="d">
                                <div class="message <?php echo $messageType; ?>">
                                        <h1 style="margin-top:20px;"><?php echo htmlspecialchars($message); ?></h1>
                                </div>
                                <div class="cat">
                                        <img src="dancecat.gif" alt="dancingcat">
                                </div>
                                <div class="powrot">
                                        <a href="Loginhtml.php">Wróć na stronę logowania</a>
                                </div>
                        </div>
                <?php endif; ?>
        </form>
</body>
</html>

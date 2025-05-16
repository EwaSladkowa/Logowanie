<?php 
    $message = $_GET['message'] ?? "Wpisz login i hasło";
    $messageType = $_GET['messageType'] ?? "info";
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
    <form class="form" action="Login.php" method="post">
        <div class="errorjs" id="errorjs">
            <h1>Error</h1>
        </div>
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
            <button class="button1" name="button" value="Rejestracja" type="submit" onclick="error">Rejestracja</button>
            <button class="button2" name="button" value="Login" type="submit" onclick="error">Login</button>
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

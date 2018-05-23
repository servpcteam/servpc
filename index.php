<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Serwis komputrowy - logowanie</title>
    <link rel="stylesheet" href="css/stylesheet.css" type="text/css">
</head>
<body>
<div id="main_container">
    <div class="logo"><img src="img/1.jpg" title="help"></div>
    <div class="login-form">
        <form action="php/login.php" method="post">
            <input type="email" name="email" placeholder="Twój e-mail">
            <input type="password" name="haslo" placeholder="Hasło">
            <input type="submit" value="Zaloguj">
        </form>
    </div>
    <div class="register-link"><a href="php/register.php">Nie masz konta - załóż je tutaj</a></div>
</div>

</body>
</html>
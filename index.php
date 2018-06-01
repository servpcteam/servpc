<!doctype html>
<?php
session_start();


if (isset($_SESSION['loggedIn']) && ($_SESSION['loggedIn'] == true) && ($_SESSION['isAdmin'] == true)){
    header("location: adminpanel.php");
    exit();
} elseif (isset($_SESSION['loggedIn']) && ($_SESSION['loggedIn'] == true)) {
    header("location: userpanel.php");
    exit;
}

?>
<html lang="en">
<head>
   <?php
        require_once('./inc/header.php')
    ?>
    <title>Panel użytkownika</title>
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
        <?php
            if (isset($_SESSION['error'])){
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
        ?>
    </div>
    <div class="register-link"><a href="register.php">Nie masz konta - załóż je tutaj</a></div>
</div>

</body>
</html>
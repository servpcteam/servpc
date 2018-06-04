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
    <title>Serwis komputerowy</title>
</head>
<body>   
<div class="card border-primary mb-3">
    <img src="./img/1.jpg" class="card-img-top"/>
    <div class="col-4"></div>
    <div class="col-4">
    <div class="card-body">
    <form action="php/login.php" method="post">
        <div class="form-group" style="width: 18rem">
            <label for="inputEmail">Adres email</label>
            <input id="inputEmail" class="form-control" type="email" name="email" placeholder="Twój e-mail">
        </div>
        <div class="form-group" style="width: 18rem">
            <label for="inputPassword">Hasło</label>
            <input id="inputPassword" class="form-control" type="password" name="haslo" placeholder="Hasło">
        </div>    
            <button class="btn btn-primary" type="submit">Zaloguj</button>
        </form>
    </div>
    <div class="col-4"></div>
        <?php
            if (isset($_SESSION['error'])){
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
        ?>
    <div class="register-link"><a href="register.php">Nie masz konta? Załóż je tutaj</a></div>
    </div>
</div>

</body>
</html>
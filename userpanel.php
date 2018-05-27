<?php
session_start();

if (!isset($_SESSION['loggedIn'])) {
    header("location: index.php");
    exit();
}
?>


<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel użytkownika</title>
    <link rel="stylesheet" href="css/stylesheet.css" type="text/css">
</head>
<body>
<?php
echo "Zalogowano jako: " . $_SESSION['imie'] . " " . $_SESSION['nazwisko'];
?>
<a href="php/logout.php">Wyloguj</a>













</body>
</html>
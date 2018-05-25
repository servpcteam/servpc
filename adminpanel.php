<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN PANEL</title>
    <link rel="stylesheet" href="css/stylesheet.css" type="text/css">
</head>
<body>
<?php
session_start();
if (isset($_SESSION['isAdmin'])) {
    echo "Zalogowano jako Administrator: " . $_SESSION['imie'] . " " . $_SESSION['nazwisko'];
    echo '<a href="php/logout.php">Wyloguj</a>';
} else {
    header("location: index.php");
}


?>

</body>
</html>
<?php
session_start();

if (!isset($_SESSION['registrationCompleted'])) {
    header("location: index.php");
} else {
    unset($_SESSION['registrationCompleted']);
}

?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dziękujemy za rejestrację</title>
    <link rel="stylesheet" href="css/stylesheet.css" type="text/css">
</head>
<body>
    <div><h1>Dziekujemy za rejestrację <a href="index.php">Tutaj możesz się zalogować</a></h1></div>
</body>
</html>
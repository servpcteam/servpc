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
    <?php
        require_once('./inc/header.php')
    ?>
    <title>Dziękujemy za rejestrację</title>
</head>
<body>
    <div><h1>Dziekujemy za rejestrację <a href="index.php">Tutaj możesz się zalogować</a></h1></div>
</body>
</html>
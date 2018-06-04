<?php
require_once "sql/sql.php";
session_start();

if (isset($_POST['email'])) {
    $validationOk = true;

    //sprawdzenie imienia 3-20 znaków
    $imie = $_POST['imie'];
    if ((strlen($imie) < 3) || (strlen($imie) > 20)) {
        $validationOk = false;
        $_SESSION['e_imie'] = "Imię musi zawierać od 3 do 20 znaków";
    }

    //sprawdzenie nazwiska 3-20 znaków
    $nazwisko = $_POST['nazwisko'];
    if ((strlen($nazwisko) < 3) || (strlen($nazwisko) > 20)) {
        $validationOk = false;
        $_SESSION['e_nazwisko'] = "Nazwisko musi zawierać od 3 do 20 znaków";
    }

    $telefon = $_POST['telefon'];

    //sprawdzenie email
    $email = $_POST['email'];
    $emailSanitized = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ((filter_var($emailSanitized, FILTER_VALIDATE_EMAIL) == false) || ($emailSanitized != $email)) {
        $validationOk = false;
        $_SESSION['e_email'] = "Nieprawidłowy adres email";
    }

    //sprawdzanie hasła
    $haslo = $_POST['haslo'];
    $hasloReTyped = $_POST['haslo1'];

    if ($haslo != $hasloReTyped) {
        $validationOk = false;
        $_SESSION['e_haslo'] = "Podane hasła są różne";
    }

    if (strlen($haslo) < 4 || strlen($haslo) > 20) {
        $validationOk = false;
        $_SESSION['e_haslo'] = "Dozwolone hasło zawiera od 4 - 20 znaków";
    }

    //sprawdzenie zaznaczenia checkboxa
    if (!isset($_POST['tos'])) {
        $validationOk = false;
        $_SESSION['e_tos'] = "Zapoznaj się z regulaminem i potwierdź jego treść";
    }

    //hashowanie hasła
    $hasloHash = password_hash($haslo, PASSWORD_DEFAULT);

    require_once "./php/DBconfig.class.php";

    try {
        $connection = @new mysqli(DBconfig::host, DBconfig::login, DBconfig::password, DBconfig::database);
        if ($connection->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {

            // sprawdzenie czy email jest w bazie
            $result = $connection->query(sprintf($queryEmail,
                mysqli_real_escape_string($connection, $email)));

            if (!$result) throw new Exception($connection->error);

            $emails = $result->num_rows;

            if ($emails > 0) {
                $validationOk = false;
                $_SESSION['e_email'] = "Email jest już zajęty";
            }
            if ($validationOk == true) {
                // Insert do bazy
                if ($connection->query(sprintf($queryRegister,
                    mysqli_real_escape_string($connection, $imie),
                    mysqli_real_escape_string($connection, $nazwisko),
                    mysqli_real_escape_string($connection, $telefon),
                    mysqli_real_escape_string($connection, $email),
                    mysqli_real_escape_string($connection, $hasloHash)))) {
                    $_SESSION['registrationCompleted'] = true;
                    header("location: welcome.php");
                } else {
                    throw new Exception($connection->error);
                }
            }
            $connection->close();
        }

    } catch (Exception $e) {
        echo "Coś poszło nie tak - Błąd serwera";
        echo "$e";
    }
}
?>
<!doctype html>
<html lang="pl">
<head>
    <?php
        require_once('./inc/header.php')
    ?>
    <title>Rejestracja</title>
</head>
<body>
<form method="post">
    <br/> Imie:
    <input type="text" name="imie" placeholder="Imie"><br/>
    <?php
    if (isset($_SESSION['e_imie'])) {
        echo '<span class="error">' . $_SESSION['e_imie'] . '</span>';
        unset($_SESSION['e_imie']);
    }
    ?>
    <br/>Nazwisko:
    <input type="text" name="nazwisko" placeholder="Nazwisko"><br/>
    <?php
    if (isset($_SESSION['e_nazwisko'])) {
        echo '<span class="error">' . $_SESSION['e_nazwisko'] . '</span>';
        unset($_SESSION['e_nazwisko']);
    }
    ?>
    <br/>Telefon:
    <input type="tel" name="telefon" placeholder="Telefon"><br/>
    <br/> E-mail:
    <input type="email" name="email" placeholder="E-mail"><br/>
    <?php
    if (isset($_SESSION['e_email'])) {
        echo '<span class="error">' . $_SESSION['e_email'] . '</span>';
        unset($_SESSION['e_email']);
    }
    ?>
    <br/> Hasło:
    <input type="password" name="haslo" placeholder="Hasło"><br/>
    <?php
    if (isset($_SESSION['e_haslo'])) {
        echo '<span class="error">' . $_SESSION['e_haslo'] . '</span>';
        unset($_SESSION['e_haslo']);
    }
    ?>
    <br/> Powtórz hasło:
    <input type="password" name="haslo1" placeholder="Powtórz hasło"><br/>
    <br/>
    <label>
        <a href="tos.php">Akceptuję regulamin</a> <input type="checkbox" name="tos" id="tos-checkbox">
    </label>
    <br/>
    <?php
    if (isset($_SESSION['e_tos'])) {
        echo '<span class="error">' . $_SESSION['e_tos'] . '</span>';
        unset($_SESSION['e_tos']);
    }
    ?>
    <br/>
    <input type="submit" value="Załóż konto">
</form>

</body>
</html>
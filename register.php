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
    <div class="card border-primary mb-3">
    <img src="./img/1.jpg" class="card-img-top"/>
    <div class="col-4"></div>
    <div class="col-4">
    <div class="card-body">
        <h5 class="card-title">Rejestracja</h5>
        <form method="post">
            <div class="form-group" style="width: 18rem">
                <label for="inputName">Imie</label>
                <input id="inputName" type="text" name="imie" placeholder="Imie" class="form-control">
                     <?php
                        if (isset($_SESSION['e_imie'])) {
                        echo '<span class="error">' . $_SESSION['e_imie'] . '</span>';
                        unset($_SESSION['e_imie']);
                        }
                    ?>
            </div>
            <div class="form-group" style="width: 18rem">
                <label for="inputSurname">Nazwisko</label>
                <input id="inputSurname" type="text" name="nazwisko" placeholder="Nazwisko" class="form-control">
                <?php
                    if (isset($_SESSION['e_nazwisko'])) {
                    echo '<span class="error">' . $_SESSION['e_nazwisko'] . '</span>';
                    unset($_SESSION['e_nazwisko']);
                    }
                ?>
            </div>
            <div class="form-group" style="width: 18rem">
                <label for="inputPhone">Telefon</label>
                <input id="inputPhone" type="tel" name="telefon" placeholder="Telefon" class="form-control">
            </div>    
            <div class="form-group" style="width: 18rem">
                <label for="inputEmail">Email</label>
                <input type="email" name="email" placeholder="E-mail" class="form-control" id="inputEmail">
                <?php
                    if (isset($_SESSION['e_email'])) {
                    echo '<span class="error">' . $_SESSION['e_email'] . '</span>';
                    unset($_SESSION['e_email']);
                    }
                ?>
            </div>
            <div class="form-group" style="width: 18rem">
                <label for="inputPassword1">Hasło</label>
                <input type="password" name="haslo" placeholder="Hasło" class="form-control" id="inputPassword1">
                    <?php
                        if (isset($_SESSION['e_haslo'])) {
                        echo '<span class="error">' . $_SESSION['e_haslo'] . '</span>';
                        unset($_SESSION['e_haslo']);
                        }
                    ?>    
            <div class="form-group" style="width: 18rem">
                <label for="inputPassword2">Powtórz hasło</label>
                <input id="inputPassword2" type="password" name="haslo1" placeholder="Powtórz hasło" class="form-control">    
            </div>
            <div class="form-group" style="width: 18rem">
                <label for="checkTos">
                    <a href="tos.php">Akceptuję regulamin</a> <input id="checkTos" type="checkbox" name="tos" id="tos-checkbox">
                </label>
            </div>
    <?php
    if (isset($_SESSION['e_tos'])) {
        echo '<span class="error">' . $_SESSION['e_tos'] . '</span>';
        unset($_SESSION['e_tos']);
    }
    ?>
    <button class="btn btn-primary" type="submit">Załóż konto</button>
</form>

</body>
</html>
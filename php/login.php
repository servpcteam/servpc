<?php

session_start();
require_once "connection.php";
require_once "../sql/sql.php";
include "../sql/sql.php";

$connection = @new mysqli($host, $uzytkownikBazyDanych, $hasloBazyDanych, $nazwaBazyDanych);

if ($connection->connect_errno != 0) {
    echo "Error " . $connection->connect_errno . "Opis: " . $connection->connect_error;
} else {
    $email = $_POST['email'];
    $haslo = $_POST['haslo'];

    if ($result = @$connection->query(sprintf($queryLogin,
        mysqli_real_escape_string($connection, $email)))) {
        $userNumber = $result->num_rows;
        if ($userNumber > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($haslo, $row['Haslo'])) {

                $_SESSION['loggedIn'] = true;
                $_SESSION['idKlient'] = $row['ID_Klient'];
                $_SESSION['email'] = $row['Email'];
                $_SESSION['imie'] = $row['Imie'];
                $_SESSION['nazwisko'] = $row['Nazwisko'];
                $_SESSION['telefon'] = $row['Telefon'];
                echo $user;
                unset($_SESSION['error']);
                $result->close();
                if ($row['Rola'] === 'admin') {
                    $_SESSION['isAdmin'] = true;
                    header("Location: ../adminpanel.php");
                } else {
                    header("Location: ../userpanel.php");
                }
            } else {
                $_SESSION['error'] = '<span class="error">Nieprawidlowy login lub haslo</span>';
                header("location: ../index.php");
            }
        } else {
            $_SESSION['error'] = '<span class="error">Nieprawidlowy login lub haslo</span>';
            header("location: ../index.php");
        }
    }
    $connection->close();
}


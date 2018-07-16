<?php

session_start();
require_once("DB.class.php");
require_once("../sql/sql.php");


$res = new DBconnector();


    $email = $_POST['email'];
    $haslo = $_POST['haslo'];
    
    $whoisEmail = $res->get_array(sprintf($queryLogin, $email))[0];
    $userNumber = count($whoisEmail);
    if ($userNumber > 0 && password_verify($haslo, $whoisEmail['Haslo']))
    {
        $_SESSION['loggedIn'] = true;
        $_SESSION['idKlient'] = $whoisEmail['ID_Klient'];
        $_SESSION['email'] = $whoisEmail['Email'];
        $_SESSION['imie'] = $whoisEmail['Imie'];
        $_SESSION['nazwisko'] = $whoisEmail['Nazwisko'];
        $_SESSION['telefon'] = $whoisEmail['Telefon'];
        unset($_SESSION['error']);
            if ($whoisEmail['Rola'] === 'admin') {
                $_SESSION['isAdmin'] = true;
                header("Location: ../adminpanel.php");
            } else {
                header("Location: ../userpanel.php");
            }
    } else {
        $_SESSION['error'] = '<span class="error">Nieprawidlowy login lub haslo</span>';
        header("location: ../index.php");
    }
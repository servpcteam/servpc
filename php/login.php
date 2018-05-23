<?php

require_once "connection.php";


$connection = @new mysqli($host, $uzytkownikBazyDanych, $hasloBazyDanych, $nazwaBazyDanych);


if ($connection->connect_errno != 0) {
    echo "Error " . $connection->connect_errno . "Opis: " . $connection->connect_error;
} else {
    $email = $_POST['email'];
    $haslo = $_POST['haslo'];

    $sql = "SELECT * FROM KLIENT WHERE Email='$email' AND Haslo='$haslo'";

    if ($result = @$connection->query($sql)) {
        $userNumber = $result->num_rows;
        if ($userNumber > 0) {
            $row = $result->fetch_assoc();
            $user = $row['Email'];
            echo $user;
            $result->close();
            header("Location: ../userpanel.php");
        } else {
            
        }
    }
    $connection->close();
}


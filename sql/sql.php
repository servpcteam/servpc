<?php

 $queryLogin = "SELECT * FROM KLIENT WHERE Email='%s'";
 $queryEmail = "SELECT ID_Klient FROM KLIENT WHERE Email='%s'";
 $queryRegister = "INSERT INTO KLIENT VALUES (NULL, '%s', '%s', '%s', '%s', '%s', 'user')";
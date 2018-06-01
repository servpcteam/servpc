<?php
require('DB.class.php');

$id = $_POST['id'];

$db = new DBconnector();
$db->execute('DELETE FROM klient WHERE ID_Klient='.$id);

echo "Usunieto";
exit();

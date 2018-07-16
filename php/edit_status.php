<?php
require('DB.class.php');

$id = $_POST['id'];

$db = new DBconnector();
$id_status_array = $db->get_array("SELECT STATUS_Z_ID_Status FROM Zgloszenie WHERE ID_Zgloszenie=$id");
$id_status = ($id_status_array[0]['STATUS_Z_ID_Status'] % 3) + 1;
$db->execute("UPDATE Zgloszenie SET STATUS_Z_ID_Status = $id_status WHERE ID_Zgloszenie=$id");

exit();

<?php
require('DB.class.php');
session_start();

$sprzet = $_POST['sprzet'];
$numerseryjny = $_POST['numerseryjny'];
$producent = $_POST['producent'];
$opis = $_POST['opis'];

$db = new DBconnector();

$queryDevice = "SELECT RODZAJ_ID_Rodzaj, SerialNumber, Producent FROM sprzet WHERE SerialNumber='%s' AND Producent = '%s'";
$insertDevice = "INSERT INTO SPRZET(RODZAJ_ID_Rodzaj, SerialNumber, Producent) VALUES ('%s', '%s', '%s')";
$queryDeviceSmall = "SELECT ID_Sprzet FROM sprzet WHERE SerialNumber= '%s'";
$insertOrder = "INSERT INTO ZGLOSZENIE(SPRZET_ID_Sprzet, KLIENT_ID_Klient, STATUS_Z_ID_Status, PRACOWNIK_ID_Pracownik_Przyjmujacy, PRACOWNIK_ID_Pracownik_Wydajacy, Data_Przyjecia, Data_Wydania, Opis) VALUES (%d, %d, 1, 2, NULL, '%s', NULL, '%s')";

$is_exist = $db->get_array(sprintf($queryDevice, $numerseryjny, $producent));

if (count($is_exist)==0)
{
	
	$db->execute(sprintf($insertDevice, $sprzet, $numerseryjny, $producent));

}
$idsprzet_array = $db->get_array(sprintf($queryDeviceSmall, $numerseryjny));
$idsprzet = $idsprzet_array[0]['ID_Sprzet'];
	
$db->execute(sprintf($insertOrder, $idsprzet, $_SESSION['idKlient'], date("Y-m-d"), $opis));

//$db->execute("UPDATE Zgloszenie SET STATUS_Z_ID_Status = $id_status WHERE ID_Zgloszenie=$id");

echo "Zmieniono status";
exit();

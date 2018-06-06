<?php
require('DB.class.php');
session_start();

$sprzet: $_POST['sprzet'];
$numerseryjny : $_POST['numerseryjny'];
$producent : $_POST['producent'];
$opis : $_POST['opis'];

$db = new DBconnector();

$is_exist = $db->get_array("SELECT RODZAJ_ID_Rodzaj, SerialNumber, Producent FROM sprzet WHERE SerialNumber = $numerseryjny AND Producent = $producent");

if (count($is_exist)==0)
{
	$db->execute("INSERT INTO SPRZET(RODZAJ_ID_Rodzaj, SerialNumber, Producent) 
		VALUES ($sprzet, $numerseryjny, $producent)");
	$idsprzet_array = db->get_array("SELECT ID_sprzet FROM sprzet WHERE SerialNumber= $numerseryjny");
	$idsprzet = $idsprzet_array[0];
	$db->execute("INSERT INTO ZGLOSZENIE(SPRZET_ID_Sprzet, KLIENT_ID_Klient, STATUS_Z_ID_Status, 
	PRACOWNIK_ID_Pracownik_Przyjmujacy, PRACOWNIK_ID_Pracownik_Wydajacy, Data_Przyjecia, Data_Wydania, Opis) 
		 VALUES (, $_SESSION['idKlient'], 1, 2, NULL, date("Y-m-d"), NULL, $opis)");
}

//$db->execute("UPDATE Zgloszenie SET STATUS_Z_ID_Status = $id_status WHERE ID_Zgloszenie=$id");

echo "Zmieniono status";
exit();

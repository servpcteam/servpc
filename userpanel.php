<?php
session_start();
require('./php/DB.class.php');

if (!isset($_SESSION['loggedIn'])) {
    header("location: index.php");
    exit();
}
?>

<!doctype html>
<html lang="pl">
<head>
	<?php
		require_once('./inc/header.php')
	?>
	<title>Panel użytkownika</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Zalogowany jako <?php 
  echo  $_SESSION['imie'] . " " . $_SESSION['nazwisko']; 
  ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse md-right-auto" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="navbar-text">
        <a class="nav-link" href="php/logout.php">Wyloguj</a>
      </li>
    </ul>
  </div>
</nav>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Rodzaj</th>
      <th scope="col">Producent</th>
      <th scope="col">Numer seryjny</th>
      <th scope="col">Opis</th>
      <th scope="col">Statut</th>
    </tr>
  </thead>
  <tbody>
    <tr>
	<?php
		$idKlient = $_SESSION['idKlient'];
		$db = new DBconnector();
		$orders = $db->get_array("SELECT zgloszenie.ID_Zgloszenie, sprzet.Producent, sprzet.SerialNumber, rodzaj.Nazwa, zgloszenie.Opis, status_z.Status FROM ((sprzet INNER JOIN zgloszenie ON sprzet.ID_Sprzet = zgloszenie.SPRZET_ID_Sprzet) INNER JOIN status_z ON status_z.ID_Status = zgloszenie.STATUS_Z_ID_Status) INNER JOIN rodzaj ON rodzaj.ID_Rodzaj = sprzet.RODZAJ_ID_Rodzaj WHERE zgloszenie.KLIENT_ID_Klient = $idKlient");
    foreach($orders as $order) {
			echo '<tr>'.'<td>'.$order['Nazwa'].'</td>'
      .'<td>'.$order['Producent'].'</td>'
			.'<td>'.$order['SerialNumber'].'</td>'
			.'<td>'.$order['Opis'].'</td>'
			.'<td>'.$order['Status'].'</td>'
			.'</tr>';
		}
	?>
      </tr>
   </tbody>
</table>
<div>
  <?php
    $devices = $db->get_array("SELECT * FROM rodzaj");
    var_dump($devices);
  ?>
  <form method="post">
    <div class="form-group">
      <label for="selectSprzetIDSprzet">Rodzaj sprzetu</label>
       <select id="selectSprzetIDSprzet">
     <?php   

          foreach ($devices as $device) {
           echo '<option value="'.$device['ID_Rodzaj'].'>'.$device['Nazwa'].'</option>.';
          }
        ?>
      </select> 
    </div>
</div>




<?php
	require_once('./inc/footer.php')
?>
</body>
<script type="text/javascript" src="./js/createorder.js"></script>
</html>
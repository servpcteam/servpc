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
    <title>ADMIN PANEL</title>
</head>
<body>
	<div class = "row">
		<?php
			if (isset($_SESSION['isAdmin'])) {
    			echo "<div class = 'col-sm-4'> Zalogowano jako Administrator: </div>
    					<div class = 'col-sm-4'>" . $_SESSION['imie'] . " " . $_SESSION['nazwisko']."</div>";
    			echo '<div class = "col-sm-4"><a href="php/logout.php">Wyloguj</a></div>';
			} else {
    			header("location: index.php");
			}
		?>
	</div>
	<table class="table">
  <thead>
    <tr>
      <th scope="col">Rodzaj</th>
      <th scope="col">Numer seryjny</th>
      <th scope="col">Opis</th>
      <th scope="col">Statut</th>
      <th scope="col">Zmień statut</th>
    </tr>
  </thead>
  <tbody>
    <tr>
	<?php
		$db = new DBconnector();
		$orders = $db->get_array("SELECT zgloszenie.ID_Zgloszenie, sprzet.SerialNumber, rodzaj.Nazwa, zgloszenie.Opis, status_z.Status FROM ((sprzet INNER JOIN zgloszenie ON sprzet.ID_Sprzet = zgloszenie.SPRZET_ID_Sprzet) INNER JOIN status_z ON status_z.ID_Status = zgloszenie.STATUS_Z_ID_Status) INNER JOIN rodzaj ON rodzaj.ID_Rodzaj = sprzet.RODZAJ_ID_Rodzaj");
    	foreach($orders as $order) {
			echo '<tr>'.'<td>'.$order['Nazwa'].'</td>'
			.'<td>'.$order['SerialNumber'].'</td>'
			.'<td>'.$order['Opis'].'</td>'
			.'<td>'.$order['Status'].'</td>'
			.'<td><a class="btn btn-primary edit-status" href="#" data-id="'.$order['ID_Zgloszenie'].'">Zmień</a></td>'
			.'</tr>';
		}
	?>
      </tr>
   </tbody>
   
</table>

	












	<?php
		require_once('./inc/footer.php')
	?>
</body>
<script type="text/javascript" src="./js/app.js"></script>
</html>
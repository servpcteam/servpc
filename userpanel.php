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
      <th scope="col">Imie</th>
      <th scope="col">Nazwisko</th>
      <th scope="col">Hasło</th>
      <th scope="col">Rola</th>
      <th scope="col">Edytuj</th>
      <th scope="col">Usuń</th>
    </tr>
  </thead>
  <tbody>
    <tr>
	<?php
		
		$db = new DBconnector();
		$clients = $db->get_array('SELECT * FROM klient WHERE rola="user"');
		
		foreach($clients as $client) {
			echo '<tr>'.'<td>'.$client['Imie'].'</td>'
			.'<td>'.$client['Nazwisko'].'</td>'
			.'<td>'.$client['Haslo'].'</td>'
			.'<td>'.$client['Rola'].'</td>'
			.'<td><a class="btn btn-primary" href="#">Edytuj</a></td>'
			.'<td><a class="btn btn-primary delete-client" href="#" data-id="'.$client['ID_Klient'].'">Usuń</a></td>'
			.'</tr>';
		}
	?>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
   </tbody>
</table>












<?php
	require_once('./inc/footer.php')
?>
</body>
<script type="text/javascript" src="./js/app.js"></script>
</html>
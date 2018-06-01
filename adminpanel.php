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
	
		session_start();
			if (isset($_SESSION['isAdmin'])) {
    			echo "<div class = 'col-sm-4'> Zalogowano jako Administrator: </div>
    					<div class = 'col-sm-4'>" . $_SESSION['imie'] . " " . $_SESSION['nazwisko']."</div>";
    			echo '<div class = "col-sm-4"><a href="php/logout.php">Wyloguj</a></div>';
			} else {
    			header("location: index.php");
			}
		?>
	</div>












	<?php
		require_once('./inc/footer.php')
	?>
</body>
</html>
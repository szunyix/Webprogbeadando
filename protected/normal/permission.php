<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : # isset létrehozás ha pedmission jogunk van és nagyobbb mint 1 akk enged tovább ?>
	<h1>Page acces is formbidden!</h1>
	<?= isset($_SESSION['permission']) ? $_SESSION['permission'] : "Null" ?>
<?php else : ?>
	<h1>Acces allowed</h1>
	<p>Your permission level is <?=$_SESSION['permission'] ?></p>
<?php endif; ?>


<hr>
<a href="index.php">home</a>
<?php if (!IsUserLoggedIn()) : ?>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=login">Bejeletkezés</a>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=register">Regisztráció</a>
<?php else : ?>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=test">Jogok</a>
	<?php if(isset($_SESSION['permission']) && $_SESSION['permission'] >= 1) : # isset létrehozás ha  permission jogunk van és nagyobbb mint 1 akk enged tovább ?>
	<span> &nbsp; |* &nbsp; </span>
	<a href="index.php?P=users">Felhasználók</a> 
		<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=list_oktato">Oktatók</a>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=add_oktato">Oktató hozzáadása</a>
	<span> &nbsp; *| &nbsp; </span>
	<?php else : ?>
		<span> &nbsp; | &nbsp; </span>
	<?php endif; ?>

	<a href="index.php?P=logout">Kijeletkezés</a>
<?php endif; ?>
<hr>
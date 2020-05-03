<?php session_start(); ?>
<?php require_once 'protected/config.php'; #meghivás elhanyagolhatatlan ?>
<?php require_once USER_MENAGER; # behívtuk a fügvényeket ?> 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>WEB2</title>
	<!-- boostrep  -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<!-- saját css	-->
	<link rel="stylesheet" type="text/css" href="<?=PUBLIC_DIR.'style.css'?>">
</head>
<body> <!-- cont f5 -->
	<div class="container-fluid"> <?php #css miatt class ?>
		<header><?php include_once PROTECTED_DIR.'header.php' ?></header> <?php #meghivás oldalakat ?>
		<nav><?php require_once PROTECTED_DIR.'nav.php' ?></nav>
		<content><?php require_once PROTECTED_DIR.'routing.php'; ?></content>
		<footer><?php include_once PROTECTED_DIR.'footer.php' ?></footer>
	</div>

</body>
</html>
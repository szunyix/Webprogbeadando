<?php 
if(!array_key_exists('w', $_GET) || empty($_GET['w'])) : 
	header('Location: index.php');
else: 
	$query = "SELECT id, first_name, last_name, email, gender, nationality FROM workers WHERE id = :id";
	$params = [':id' => $_GET['w']];
	require_once DATABASE_CONTROLLER;
	$worker = getRecord($query, $params);
	if(empty($worker)) :
		header('Location: index.php');
	else : ?>
		<h2><?=$worker['first_name'].' '.$worker['last_name'] ?></h2>
		<h3><?=$worker['email'] ?></h3>
		<p>Gender: <?=$worker['gender'] ?> <br>
		Nationality: <?=$worker['nationality'] ?></p>
	<?php endif;
endif;
?>
<?php 
function IsUserLoggedIn(){ #felhasználó belépett e
	return $_SESSION != null && array_key_exists('uid', $_SESSION) && is_numeric($_SESSION['uid']); #ha nem nulla , ha van elemünk , ha szám akkor fasza
}
function UserLogout() {
	session_unset(); #ebbe tároltuk hogy belépett
	session_destroy(); #munkafolyamat megszüntetés
	header('Location: index.php'); #ugrás a munkába
}
function UserLogin($email, $password) {
	$query="SELECT id, first_name, last_name, email, permission FROM users WHERE email = :email AND password = :password";
	$params = [
		':email' => $email,
		':password' => sha1($password)
	];

	require_once DATABASE_CONTROLLER;

	$record = getRecord($query,$params);
	if (!empty($record)) {
		$_SESSION['uid'] = $record['id'];
		$_SESSION['fname'] = $record['first_name']; //az első param , a második formális
		$_SESSION['lname'] = $record['last_name'];
		$_SESSION['email'] = $record['email'];
		$_SESSION['permission'] = $record['permission'];
		header('Location: index.php');
	}
	return false;
}
function UserRegister($email, $password, $fname, $lname){
	$query = "SELECT id FROM users WHERE email = ':email'"; #létezik e már az email 
	$params = [':email' => $email];

	require_once DATABASE_CONTROLLER;
	$record = getRecord($query,$params);
	if (empty($record)) {
		$query ="INSERT INTO users (first_name, last_name ,email, password) VALUES (:first_name, :last_name, :email, :password)";
		$params =[
			':first_name' => $fname,
			':last_name' => $lname,
			':email' => $email,
			':password' => sha1($password)
		];
		if(executeDML($query,$params))
			header('location: index.php?P=login'); //átugrik
	}

	return false;
}

 ?>
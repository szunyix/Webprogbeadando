<?php 
function getConnection() {
	$connection = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME.';',DB_USER, DB_PASS);
	$connection->exec("SET NAMES '".DB_CHARSET."'");
	return $connection;
}

function getRecord($queryString, $queryParams = []) { #rekord lekérés
	$connection = getConnection();
	$statement = $connection->prepare($queryString);
	$success = $statement->execute($queryParams);
	$result = $success ? $statement->fetch(PDO::FETCH_ASSOC) : [];
	$statement->closeCursor();
	$connection = null;
	return $result;
}

function getList($queryString, $queryParams = []) { #lista lekérsé
	$connection = getConnection();
	$statement = $connection->prepare($queryString);
	$success = $statement->execute($queryParams);
	$result = $success ? $statement->fetchAll(PDO::FETCH_ASSOC) : [];
	$statement->closeCursor();
	$connection = null;
	return $result;
}

function executeDML($queryString, $queryParams = []) { #dml utasítás
	$connection = getConnection();
	$statement = $connection->prepare($queryString);
	$success = $statement->execute($queryParams);
	$statement->closeCursor();
	$connection = null;
	return $success;
}

function getField($queryString, $queryParams = []) { #egymező lekérés
	$connection = getConnection();
	$statement = $connection->prepare($queryString);
	$success = $statement->execute($queryParams);
	$result = $success ? $statement->fetch()[0]: [];
	$statement->closeCursor();
	$connection = null;
	return $result;
}
?>
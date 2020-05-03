<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : # isset létrehozás ha pedmission jogunk van és nagyobbb mint 1 akk enged tovább ?>
	<h1>Page acces is formbidden!</h1>
<?php else : ?>

	<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addWorker'])) {
		$postData = [
		'first_name' => $_POST['first_name'],
		'last_name' => $_POST['last_name'],
		'email' => $_POST['email'],	
		'gender' => $_POST['gender'],
		'nationality' => $_POST['nationality']
	];	

		if (empty($postData['first_name']) || empty($postData['last_name']) || empty($postData['email']) || empty($postData['nationality']) || $postData['gender'] < 0 && $postData['gender'] > 2 ) {
			echo "Hiányzó adat(ok)!";
		}else if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
			echo "Hibás email formátum!";
		}else {
			$query = "INSERT INTO workers (first_name, last_name, email ,gender , nationality) VALUES(:first_name, :last_name, :email, :gender, :nationality)";
			$params =[
				':first_name' => $postData['first_name'],
				':last_name' => $postData['last_name'],
				':email' => $postData['email'],
				':gender' => $postData['gender'],
				':nationality' => $postData['nationality']
			];
		require_once DATABASE_CONTROLLER;
		if (!executeDML($query, $params)) {
			echo "Hiba az adatban!";
		} header('location: index.php');
	}
}


	?>

<form method="post">
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="workerFirstName">First Name</label>
			<input type="text" class="form-control" id="workerFirstName" name="first_name">
		</div>
		<div class="form-group col-md-6">
			<label for="workerLastName">Last Name</label>
			<input type="text" class="form-control" id="workerLastName" name="last_name">
		</div>
	</div>

	<div class="form-row">
		<div class="form-group col-md-12">
			<label for="workerEmail">Email</label>
			<input type="email" class="form-control" id="workerEmail" name="email">
		</div>
	</div>

	<div class="form-row">
		<div class="form-group col-md-12">
	    	<label for="workerGender">Gender</label>
	    	<select class="form-control" id="workerGender" name="gender">
		      <option value="0">Nő</option>
		      <option value="1">Férfi</option>
		      <option value="3">Egyéb</option>
		    </select>
	  	</div>
	</div>

	<div class="form-row">
		<div class="form-group col-md-12">
			<label for="workerNationality">Nationality</label>
			<input type="text" class="form-control" id="workerNationality" name="nationality" value="">
		</div>
	</div>

	<button type="submit" class="btn btn-primary" name="addWorker">Add worker</button>
</form>
	
<?php endif; ?>
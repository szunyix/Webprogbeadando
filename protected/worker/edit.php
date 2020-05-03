<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
<?php else :
	if(!array_key_exists('w', $_GET) || empty($_GET['w'])) : 
		header('Location: index.php');
else: 
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editWorker'])) {
		$postData = [
			'id' => $_POST['workerId'],
			'first_name' => $_POST['first_name'],
			'last_name' => $_POST['last_name'],
			'email' => $_POST['email'],
			'gender' => $_POST['gender'],
			'nationality' => $_POST['nationality']
		];
		if($postData['id'] != $_GET['w']) {
			echo "Hiba a dolgozó azonosítása során!";
		} else {
			if(empty($postData['first_name']) || empty($postData['last_name']) || empty($postData['email']) || empty($postData['nationality']) || $postData['gender'] < 0 && $postData['gender'] > 2) {
				echo "Hiányzó adat(ok)!";
			} else if(!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
				echo "Hibás email formátum!";
			} else {
				$query = "UPDATE workers SET first_name = :first_name, last_name = :last_name, email = :email, gender = :gender, nationality = :nationality WHERE id = :id";
				$params = [
					':first_name' => $postData['first_name'],
					':last_name' => $postData['last_name'],
					':email' => $postData['email'],
					':gender' => $postData['gender'],
					':nationality' => $postData['nationality'],
					':id' => $postData['id']
				];
				require_once DATABASE_CONTROLLER;
				if(!executeDML($query, $params)) {
					echo "Hiba az adatbevitel során!";
				} header('Location: ?P=list_worker');
			}
		}
	}
	$query = "SELECT id, first_name, last_name, email, gender, nationality FROM workers WHERE id = :id";
	$params = [':id' => $_GET['w']];
	require_once DATABASE_CONTROLLER;
	$worker = getRecord($query, $params);
	if(empty($worker)) :
		header('Location: index.php');
		else : ?>
			<form method="post">
				<input type="hidden" name="workerId" value="<?=$worker['id'] ?>">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="workerFirstName">First Name</label>
						<input type="text" class="form-control" id="workerFirstName" name="first_name" value="<?=$worker['first_name'] ?>">
					</div>
					<div class="form-group col-md-6">
						<label for="workerLastName">Last Name</label>
						<input type="text" class="form-control" id="workerLastName" name="last_name" value="<?=$worker['last_name'] ?>">
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="workerEmail">Email</label>
						<input type="email" class="form-control" id="workerEmail" name="email" value="<?=$worker['email'] ?>">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="workerGender">Gender</label>
						<select class="form-control" id="workerGender" name="gender">
							<option value="0" <?=$worker['gender'] == 0 ? 'selected' : '' ?> >Female</option>
							<option value="1" <?=$worker['gender'] == 1 ? 'selected' : '' ?> >Male</option>
							<option value="2" <?=$worker['gender'] == 2 ? 'selected' : '' ?> >Other</option>
						</select>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="workerNationality">Nationality</label>
						<input type="text" class="form-control" id="workerNationality" name="nationality" value="<?=$worker['nationality'] ?>">
					</div>
				</div>

				<button type="submit" class="btn btn-primary" name="editWorker">Save Worker</button>
			</form>
		<?php endif;
	endif;
endif;
?>
<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : # isset létrehozás ha permission jogunk van és nagyobbb mint 1 akk enged tovább ?>
	<h1>Az oldal elérése nem engedélyezett </h1>
<?php else : ?>

	<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addOktato'])) {
			$postData = [
			'nev' => $_POST['nev'],
			'kepzettseg' => $_POST['kepzettseg']
		];	

		if (empty($postData['nev']) || empty($postData['kepzettseg'])) {
			echo "Hiányzó adat(ok)!";
		}else {
			$query = "INSERT INTO oktatok (nev, kepzettseg) VALUES(:nev, :kepzettseg)";
			$params =[
				':nev' => $postData['nev'],
				':kepzettseg' => $postData['kepzettseg']
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
		<div class="form-group col-md-2">
			<label for="oktatoName">Név</label>
			<input type="text" class="form-control" id="oktatoName" name="nev">
		</div>
	</div>

	<div class="form-row">
		<div class="form-group col-md-1">
	    	<label for="oktatoKepzettseg">Képzettség</label>
	    	<select class="form-control" id="oktatoKepzettseg" name="kepzettseg">
		      <option value="Kezdő">Kezdő</option>
		      <option value="Haladó">Haladó</option>
		      <option value="Mester">Mester</option>
		    </select>
	  	</div>
	</div>

	<button type="submit" class="btn btn-primary" name="addOktato">Oktató hozzáadása</button>
</form>
	
<?php endif; ?>
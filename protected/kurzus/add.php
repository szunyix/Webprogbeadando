<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : # isset létrehozás ha permission jogunk van és nagyobbb mint 1 akk enged tovább ?>
	<h1>Az oldal elérése nem engedélyezett </h1>
<?php else : ?>

	<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
			$postData = [
			'oktatoid' => $_POST['oktatoid'],
			'csoport' => $_POST['csoport']
		];	

		if (empty($postData['oktatoid']) || empty($postData['csoport'])) {
			echo "Hiányzó adat(ok)!";
		}else {
			$query = "INSERT INTO kurzusok (oktatoid, csoport) VALUES(:oktatoid, :csoport)";
			$params =[
				':oktatoid' => $postData['oktatoid'],
				':csoport' => $postData['csoport']
			];
		require_once DATABASE_CONTROLLER;
		if (!executeDML($query, $params)) {
			echo "Zavar az erőben!";
		} header('location: index.php?P=list_kurzus');
	}
}


	?>

<form method="post">
	<div class="form-row">
		<div class="form-group col-md-1">
	    	<label for="oktatoKepzettseg">Oktató</label>
	    	<select class="form-control" id="oktatoKepzettseg" name="oktatoid">

				<?php
					$query ="SELECT nev,oktatoid FROM oktatok ORDER BY oktatoid ASC";
					require_once  DATABASE_CONTROLLER;
					$oktatok =getList($query);
				?>
				<?php foreach($oktatok as $o): ?>
					<option value="<?=$o['oktatoid']?>"><?=$o['nev']?></option>
				<?php endforeach; ?>
		    </select>
	  	</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-2">
			<label for="kurzusCsoport">Csoport</label>
			<input type="text" class="form-control" id="kurzusCsoport" name="csoport" placeholder="Csoport">
		</div>
	</div>


	<button type="submit" class="btn btn-primary" name="add">Kurzus hozzáadása</button>
</form>
	
<?php endif; ?>
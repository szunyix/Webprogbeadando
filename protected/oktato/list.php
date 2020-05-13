<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : # isset létrehozás ha pedmission jogunk van és nagyobbb mint 1 akk enged tovább ?>
	<h1>Page acces is formbidden!</h1>
<?php else : ?>
<center style="font-weight: bold;color: green">
<?php 
  if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['delete'])){
        $query = "DELETE FROM oktatok WHERE oktatoid = :id";
		$params = [':id' => $_POST['id']];
		require_once DATABASE_CONTROLLER;
		if(!executeDML($query, $params)) {
			echo "Hiba törlés közben!";
		}
    }
    else if(isset($_POST['save'])){
      if(!isset($_POST['nev']) || !isset($_POST['kepzettseg']) || !isset($_POST['id'])){
        echo "Hiányzó adat!";
      }else{
	      $postData = [
	        'nev' => $_POST['nev'],
	        'kepzettseg' => $_POST['kepzettseg'],
	        'id' => $_POST['id']
	      ];
	      $query = "UPDATE oktatok SET nev = :nev, kepzettseg = :kepzettseg WHERE oktatoid = :id";
	      $params = [
	      	':nev' => $postData['nev'],
	      	':kepzettseg' => $postData['kepzettseg'],
	      	':id' => $postData['id']
	      ];
	      require_once DATABASE_CONTROLLER;
	      if(!executeDML($query,$params)){
	      	echo "A szereksztés nem sikerült";
	      }else{
	      	echo "A szerkesztés sikeres!";
	      }
      }
    }
  }
 ?></center>

<?php
	$query ="SELECT * from oktatok ORDER BY nev ASC";
	require_once  DATABASE_CONTROLLER;
	$oktatok =getList($query);
 ?>
 <?php if (count($oktatok) <= 0) : ?>
 	<h1>Nincs oktató</h1>
 	<?php else : ?>

	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col"> #</th>
				<th scope="col"> Név</th>
				<th scope="col"> Képzettség</th>
				<th scope="col" class="text-center"> Mentés</th>
				<th scope="col" class="text-center"> Törlés</th>

			</tr>
		</thead>
		<tbody>

			<?php foreach ($oktatok as $o) : ?>
				<form method="post">
					<tr>
						<th scope="row"><?=$o['oktatoid']?><input type="hidden" name="id" value="<?=$o['oktatoid']?>"></th>
						<td><input class="form-control col-md-4" type="text" name="nev" value="<?=$o['nev'] ?>" placeholder="Név"></td>
						<td>
					    	<select class="form-control" id="oktatoKepzettseg" name="kepzettseg">
						      <option selected value="<?=$o['kepzettseg']?>"><?=$o['kepzettseg']?> (Aktuális)</option>
						      <option value="Kezdő">Kezdő</option>
						      <option value="Haladó">Haladó</option>
						      <option value="Mester">Mester</option>
						    </select>
						</td>
						<td class="text-center"><input type="submit" name="save" value="Mentés" class="btn btn-primary"></a></td>
						<td class="text-center"><input type="submit" name="delete" value="Törlés" class="btn btn-danger"></td>
					</tr>
				</form>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php endif; ?>
<?php endif; ?>
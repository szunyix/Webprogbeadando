<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : # isset létrehozás ha pedmission jogunk van és nagyobbb mint 1 akk enged tovább ?>
	<h1>Page acces is formbidden!</h1>
<?php else : ?>
<center style="font-weight: bold;color: green">
<?php 
  if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['delete'])){
        $query = "DELETE FROM kurzusok WHERE kurzusid = :id";
		$params = [':id' => $_POST['id']];
		require_once DATABASE_CONTROLLER;
		if(!executeDML($query, $params)) {
			echo "Hiba törlés közben!";
		}
    }
    else if(isset($_POST['save'])){
      if(!isset($_POST['oktatoid']) || !isset($_POST['csoport']) || !isset($_POST['kurzusid'])){
        echo "Hiányzó adat!";
      }else{
	      $postData = [
	        'oktatoid' => $_POST['oktatoid'],
	        'csoport'  => $_POST['csoport'],
	        'kurzusid' => $_POST['kurzusid']
	      ];
	      $query = "UPDATE kurzusok SET oktatoid = :oktatoid, kurzusid = :kurzusid, csoport = :csoport";
	      $params = [
	      	':oktatoid' => $postData['oktatoid'],
	      	':kurzusid' => $postData['kurzusid'],
	      	':csoport' => $postData['csoport']
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
	$query ="SELECT * from kurzusok LEFT JOIN oktatok ON kurzusok.oktatoid = oktatok.oktatoid ORDER BY kurzusok.oktatoid ASC";
	require_once  DATABASE_CONTROLLER;
	$kurzusok =getList($query);
 ?>
 <?php if (count($kurzusok) <= 0) : ?>
 	<h1>Nincs kurzus</h1>
 	<?php else : ?>

	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col"> #</th>
				<th scope="col" class="text-center"> Oktató</th>
				<th scope="col" class="text-center"> Képzettség</th>
				<th scope="col"> Csoport</th>
				<th scope="col" class="text-center"> Mentés</th>
				<th scope="col" class="text-center"> Törlés</th>

			</tr>
		</thead>
		<tbody>

			<?php foreach ($kurzusok as $k) : ?>
				<form method="post">
					<tr>
						<th scope="row"><?=$k['kurzusid']?><input type="hidden" name="kurzusid" value="<?=$k['kurzusid']?>"></th>
						<td class="text-center">
							<select class="form-control" id="oktatoKepzettseg" name="oktatoid">
								<?php
									$query ="SELECT nev,oktatoid FROM oktatok ORDER BY oktatoid ASC";
									require_once  DATABASE_CONTROLLER;
									$oktatok =getList($query);
								?>
								<?php foreach($oktatok as $o): ?>
									<option value="<?=$o['oktatoid']?>" <?=$o['oktatoid']==$k['oktatoid'] ? 'selected' : '' ?>><?=$o['nev']?></option>
								<?php endforeach; ?>
		    				</select>
						</td>
						<td class="text-center">
							<?=$k['kepzettseg'] ?>
						</td>
						<td>
							<input class="form-control col-md-4" type="text" name="csoport" value="<?=$k['csoport'] ?>" placeholder="Csoport">
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
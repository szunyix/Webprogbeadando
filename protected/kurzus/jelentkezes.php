<center style="font-weight: bold;color: green">
<?php 

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
  	if(isset($_POST['jelentkezes'])){
  		$query = "INSERT INTO rend(id,kurzusid) VALUES(:id,:kurzusid)";
  		$params=[
  			':id' => $_SESSION['uid'],
  			':kurzusid' => $_POST['jelentkezes']
  		];
		require_once  DATABASE_CONTROLLER;
  		if(!executeDML($query,$params)){
  			echo "Hupsz";
  		}else{
  			echo "Sikeres jelentkezés";
  		}
  	}else if(isset($_POST['leadas'])){
  		$query = "DELETE FROM rend WHERE id = :id AND kurzusid = :kurzusid";
  		$params=[
  			':id' => $_SESSION['uid'],
  			':kurzusid' => $_POST['leadas']
  		];
		require_once  DATABASE_CONTROLLER;
  		if(!executeDML($query,$params)){
  			echo "Hupsz";
  		}else{
  			echo "Sikeres leadás";
  		}
  	}
  }
 ?></center>
<?php
	$query ="SELECT * FROM kurzusok LEFT JOIN oktatok ON kurzusok.oktatoid = oktatok.oktatoid WHERE NOT kurzusid = ANY(SELECT kurzusid FROM rend WHERE id = :id) ORDER BY kurzusok.oktatoid ASC";
	$params = [
		':id' => $_SESSION['uid'],
	];
	require_once  DATABASE_CONTROLLER;
	$kurzusok =getList($query,$params);
 ?>
 <table class="table table-striped">
 	<thead>
 		<th>Név</th>
 		<th>Csoport</th>
 		<th>Képzettség</th>
 		<th>Jelentkezés</th>
 	</thead>
 	<tbody>
		 <?php foreach($kurzusok as $k) : ?>
			 <tr>
			 	<td><?=$k['nev']?></td>
			 	<td><?=$k['csoport']?></td>
			 	<td><?=$k['kepzettseg']?></td>
			 	<td><form method="post"><button class="btn btn-success" type="submit" name="jelentkezes" value="<?=$k['kurzusid']?>">Jelentkezés</button></form></td>
			 </tr>
		 <?php endforeach; ?>
		<?php
			$query ="SELECT * FROM kurzusok LEFT JOIN oktatok ON kurzusok.oktatoid = oktatok.oktatoid WHERE kurzusid = ANY(SELECT kurzusid FROM rend WHERE id = :id) ORDER BY kurzusok.oktatoid ASC";
			$params = [
				':id' => $_SESSION['uid'],
			];
			require_once  DATABASE_CONTROLLER;
			$kurzusok =getList($query,$params);
		 ?>
		 <?php foreach($kurzusok as $k) : ?>
		 	<tr>
			 	<td><?=$k['nev']?></td>
			 	<td><?=$k['csoport']?></td>
			 	<td><?=$k['kepzettseg']?></td>
			 	<td><form method="post"><button class="btn btn-danger" type="submit" name="leadas" value="<?=$k['kurzusid']?>">Leadás</button></form></td>
		 	</tr>
		 <?php endforeach; ?>
 	</tbody>
 </table>
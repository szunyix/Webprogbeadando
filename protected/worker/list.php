<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : # isset létrehozás ha pedmission jogunk van és nagyobbb mint 1 akk enged tovább ?>
	<h1>Page acces is formbidden!</h1>
<?php else : ?>
<?php 
	if(array_key_exists('d', $_GET) && !empty($_GET['d'])) {
		$query = "DELETE FROM workers WHERE id = :id";
		$params = [':id' => $_GET['d']];
		require_once DATABASE_CONTROLLER;
		if(!executeDML($query, $params)) {
			echo "Hiba törlés közben!";
			#Ellenőrizzük, hogy van-e 'd' elemünk a $_GET tömbben, tehát az URL-ben, illetve megvizsgáljuk hogy van-e értéke. Ha létezik és nem üres, akkor belépünk az elágazásba.
			#Ezt követően előkészítjük a törlést, tehát az SQL kódunkat beírjuk. ("Töröljük azt az elemet, ahol az id megegyezik a paraméterben kapott id-vel.")
			#Elkészítjük a paraméter tömbünket, majd meghívjuk az adatbázist kezelő fügvényeinket az előre deklarált konstans segítségével.
			#Végezetül futtatjuk a parancsot és a kiírunk egy hibaüzenetet, ha sikertelen a törlés, tehát valamilyen hiba lépett fel.
		}
	}
?>
<?php
	$query ="SELECT id, first_name, last_name, email, gender, nationality from workers ORDER BY first_name ASC";
	require_once  DATABASE_CONTROLLER;
	$workers =getList($query);
 ?>
 <?php if (count($workers) <= 0) : ?>
 	<h1>Nincs worker</h1>
 	<?php else : ?>

	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col"> #</th>
				<th scope="col"> First name</th>
				<th scope="col"> Last name</th>
				<th scope="col"> Email</th>
				<th scope="col"> Gender</th>
				<th scope="col"> Nationality</th>
				<th scope="col" class="text-center"> Szerkesztés</th>
				<th scope="col" class="text-center"> Törlés</th>

			</tr>
		</thead>
		<tbody>


			<?php $i =0; ?>
			<?php foreach ($workers as $w) : ?>
				<?php $i++; ?>
				<tr>
					<th scope="row"><?=$i ?> </th>
					<td><a href="?P=worker&w=<?=$w['id'] ?>"><?=$w['first_name'] ?></a></td>
					<td><?=$w['last_name'] ?></td>
					<td><?=$w['email'] ?></td>
					<td><?=$w['gender'] ==0 ? 'Female' :($w['gender'] ==1 ? 'Faszi' : 'valami') ?></td>
					<td><?=$w['nationality'] ?></td>
					<td class="text-center"><a href="?P=edit_worker&w=<?=$w['id'] ?>">Edit</a></td>
					<td class="text-center"><a href="?P=list_worker&d=<?=$w['id'] ?>">Delete</a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php endif; ?>
<?php endif; ?>
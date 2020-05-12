<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : # isset létrehozás ha pedmission jogunk van és nagyobbb mint 1 akk enged tovább ?>
	<h1>Page acces is formbidden!</h1>
<?php else : ?>
<?php 
	if(array_key_exists('d', $_GET) && !empty($_GET['d'])) {
		$query = "DELETE FROM oktatok WHERE id = :id";
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
	$query ="SELECT id, first_name, last_name, email, gender, nationality from oktatok ORDER BY first_name ASC";
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
				<th scope="col"> Keresztnév</th>
				<th scope="col"> Vezetéknév</th>
				<th scope="col"> Email</th>
				<th scope="col" class="text-center"> Szerkesztés</th>
				<th scope="col" class="text-center"> Törlés</th>

			</tr>
		</thead>
		<tbody>


			<?php $i =0; ?>
			<?php foreach ($oktatok as $o) : ?>
				<?php $i++; ?>
				<tr>
					<th scope="row"><?=$i ?> </th>
					<td><a href="?P=oktatok&w=<?=$w['id'] ?>"><?=$o['first_name'] ?></a></td>
					<td><?=$o['last_name'] ?></td>
					<td><?=$o['email'] ?></td>
					<td class="text-center"><a href="?P=edit_oktatok&o=<?=$o['id'] ?>">Edit</a></td>
					<td class="text-center"><a href="?P=list_oktatok&d=<?=$o['id'] ?>">Delete</a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php endif; ?>
<?php endif; ?>
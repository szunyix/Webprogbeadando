<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : # isset létrehozás ha permission jogunk van és nagyobbb mint 1 akk enged tovább ?>
	<h1>Page acces is formbidden!</h1>
<?php else : ?>
	<?php 
	$query= "SELECT first_name, last_name, email, permission from users";
	require_once DATABASE_CONTROLLER;
	$users =getList($query);
	?>
	<?php if (count($users) <= 0) : ?>
	 <h1>No users found in the data</h1>
	<?php else : ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col"> #</th>
					<th scope="col"> Keresztnév</th>
					<th scope="col"> Vezetéknév</th>
					<th scope="col"> Elérhetőség</th>
					<th scope="col"> Jog</th>
				</tr>
			</thead>
			<tbody>
				<?php $i =0; ?>
				<?php foreach ($users as $u) : ?>
					<?php $i++; ?>
					<tr>
						<th scope="row"><?=$i ?> </th>
						<td><?=$u['first_name'] ?></td>
						<td><?=$u['last_name'] ?></td>
						<td><?=$u['email'] ?></td>
						<td><?=$u['permission'] ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

	<?php endif; ?>
<?php endif; ?>

<hr>
<a href="index.php">home</a>
<?php if (!IsUserLoggedIn()) : ?>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=login">login</a>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=register">register</a>
<?php else : ?>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=test">Permiss Test</a>

	<?php if(isset($_SESSION['permission']) && $_SESSION['permission'] >= 1) : # isset létrehozás ha  permission jogunk van és nagyobbb mint 1 akk enged tovább ?>
	<span> &nbsp; |* &nbsp; </span>
	<a href="index.php?P=users">User list</a>
		<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=list_worker">Listázó</a>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=add_worker">Add worki</a>
	<span> &nbsp; *| &nbsp; </span>
	<?php else : ?>
		<span> &nbsp; | &nbsp; </span>
	<?php endif; ?>

	<a href="index.php?P=logout">logout</a>
<?php endif; ?>
<hr>
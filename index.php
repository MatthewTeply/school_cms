<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>PHP</title>
</head>
<body>

<?php if (isset($_SESSION['scms_uid'])): echo $_SESSION['scms_uid']; ?>
		<a href="includes/users.inc.php?logout">Logout</a>
<?php else: ?>

	<form method="POST" action="includes/users.inc.php">
		<input type="text" name="uid">
		<br>
		<input type="password" name="pwd">
		<br>
		<button type="submit" name="login_subm">Login</button>
	</form>

<?php endif ?>

</body>
</html>
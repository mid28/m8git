<?php 
session_start();

?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ldap</title>


<body>
	<div>
	<a href="logout.php">Desconnectar</a>
		<p>Benvingut <?php echo $_SESSION['user']; ?>, ara pots canviar la contrasenya. </p>
	
	</div>
	<form action="pass.php" method="post">
		<div>
			<p>Contrasenya actual</p>
			<input type="password" name="passact" id="passact" placeholder=""
				tabindex=1>
			<p>Contrasenya</p>
			<input type="password" name="pass" id="pass" placeholder=""
				tabindex=2>
			<p>Re contrasenya</p>
			<input type="password" name="repass" id="repass" placeholder=""
				tabindex=3 /> <br><br><input type="submit" value="canviar pass" name="canviar" />
				
		</div>

	</form>
</body>
</html>
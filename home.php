<?php
session_start ();

$ldapconn = ldap_connect ( "localhost" ) or die ( "Could not connect to LDAP server." );
$_SESSION['lconn'] = $ldapconn;

ldap_set_option ( $ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3 );
if ($ldapconn) {
	$ldapbind = ldap_bind ( $ldapconn, "cn=" . $_POST ['nom'] . ",dc=daw2,dc=net", $_POST ['pass'] );
	
	if ($ldapbind) {
		$_SESSION ['user'] = $_POST ['nom'];
		$_SESSION['pass'] = $_POST['pass'];
	}
	else
	{
	
	}
}

if (! isset ( $_SESSION ['user'] )) {
	echo "error";
	header ( 'location:index.php' );
	
}
$user = $_SESSION['user'];
$dn = "dc=daw2,dc=net";
$filtro = "(cn=$user)";
$result = ldap_search($ldapconn,$dn,$filtro);
$entries = ldap_get_entries($ldapconn, $result);

foreach ($entries as $valor) {
	$nom =  $valor['cn'][0];
	$cognom = $valor['sn'][0];
	$uidnum = $valor['uidnumber'][0];
	$uid = $valor['uid'][0];
	$loginShell = $valor['loginshell'][0];
	$home = $valor['homedirectory'][0];
	$passwd = $valor['userpassword'][0];
	$gidNum = $valor['gidnumber'][0];
	
}



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
		<p>Benvingut <?php echo $_SESSION['user']; ?> </p>
		<table style="border:1px solid black;">
			<tr>
			<td>Nom</td><td><?php echo $nom; ?></td></tr>
			<tr><td>Cognom</td><td><?php echo $cognom; ?></td></tr>
			<tr><td>UID</td><td><?php echo $uid; ?></td></tr>
			<tr><td>GUID</td><td><?php echo $gidNum; ?></td></tr>
			<tr><td>Home</td><td><?php echo $home; ?></td></tr>
			<tr><td>Login shell</td><td><?php echo $loginShell; ?></td></tr>
			<tr><td>Password Hash</td><td><?php echo $passwd; ?></td></tr>
			
		</table>
	
	</div>
	<a href="canviar_pass.php">Canviar password</a>
</body>
</html>
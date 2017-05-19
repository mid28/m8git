<?php 

session_start();

if(isset($_POST['canviar']))
{
	$pass = $_POST['pass'];
	
	$repass=  $_POST['repass'];
	$passact = $_POST['passact'];

	$ldapconn = ldap_connect ( "localhost" ) or die ( "Could not connect to LDAP server." );
	
	$comprobarpass = ldap_bind ( $ldapconn, "cn=" . $_SESSION ['user']. ",dc=daw2,dc=net", $passact );
	
	if($comprobarpass)
	{
		if($pass == $repass)
		{
			$dn = "dc=daw2,dc=net";
			$filtro = "(cn=".$_SESSION['user'].")";
			$result = ldap_search($ldapconn,$dn,$filtro);
			$entry_id = ldap_first_entry($ldapconn, $result);
			$dn = ldap_get_dn($ldapconn, $entry_id);
			$ldapbindd = ldap_bind($ldapconn, $dn, $passact);
			var_dump($ldapbindd);
			
			$resultat = ldap_mod_replace($ldapconn,$dn, array('userpassword' => "{MD5}" . base64_encode( pack( "H*", md5( $pass ) ) )) );
			if ($resultat) echo "La contrasenya s'ha modificat correctament";
			
			else
			{
				echo "No s'ha modificat degut a algun error";
				
			}
			ldap_close($_SESSION['lconn']);
			
			
		}
		else
		{
			echo "LA CONTRASENYA NO COINCIDEIX";
		}
	}
	else
	{
		echo "La contrasenya actual no es vàlida<br>";
		session_destroy();
		//header('location:index.php');
	}
	
}
?>
<a href="logout.php">Desconnectar</a>
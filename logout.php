<?php 
session_start();
ldap_close($_SESSION['lconn']); 
session_destroy();
header('location:index.php');
?>
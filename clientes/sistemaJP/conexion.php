<?php 
	
    $host = "162.241.60.169"; 
	$user = "estrat47_Admin";
	$password = "Pepito5824";  
	$db = "estrat47_sistemaJP";

	$conection = @mysqli_connect($host,$user,$password,$db);

	if(!$conection){
		echo "Error en la conexión";
	}

?>
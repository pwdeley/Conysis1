<?php 
	
	$host = 'localhost:8889'; /*conexión para MAC localhost:8889 conexión para Win localhost*/
	$user = 'root';
	$password = 'root';  /*conexión para MAC root conexión para Win ''*/
	$db = 'facturacion';

	$conection = @mysqli_connect($host,$user,$password,$db);

	if(!$conection){
		echo "Error en la conexión";
	}

?>
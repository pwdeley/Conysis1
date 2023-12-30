<?php 
	
$alert = '';
session_start();

if(!empty($_SESSION['active']))
{
	
}else{

	if(!empty($_POST))
	{
		if(empty($_POST['usuario']) || empty($_POST['clave']))
		{
			$alert = 'Ingrese su usuario y su calve';
		}else{

			require_once "conexion.php";

			$user = mysqli_real_escape_string($conection,$_POST['usuario']);
			$pass = md5(mysqli_real_escape_string($conection,$_POST['clave']));

			$query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario= '$user' AND clave = '$pass'");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if($result > 0)
			{
				$data = mysqli_fetch_array($query);
				$_SESSION['active'] = true;
				$_SESSION['idUser'] = $data['idusuario'];
				$_SESSION['nombre'] = $data['nombre'];
				$_SESSION['email']  = $data['correo'];
				$_SESSION['user']   = $data['usuario'];
				$_SESSION['rol']    = $data['rol'];
				
				
				switch ($user || $pass)
				{
				    case ($user == AdminEA || $pass == 5821):
				    header('location: sistemaEA/');
				    break;
				    case ($user == Angy || $pass == 1973):
				    header('location: sistemaEA/');
				    break;
				    case ($user == Anita || $pass == 8585):
				    header('location: sistemaEA/');
				    break;
				    case ($user == AdminJP || $pass == 5822):
				    header('location: sistemaJP/');
				    break;
				    case ($user == Johanna || $pass == 2526):
				    header('location: sistemaJP/');
				    break;
				    default:
					header('location: modulosEA/');
				}
			}else{
				$alert = 'El usuario o la clave son incorrectos';
				session_destroy();
			}


		}

	}
}

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Login | Clientes EC</title>
	<link rel="icon" href="../imagenes/logoestratega.png" type="image/x">
	<link rel="stylesheet" type="text/css" href="estiloslogin.css">
</head>
<body>

	
	<section id="container">
		
		<form action="" method="post">
			
			<h3>Iniciar Sesión</h3>
			<img src="../imagenes/logoestratega.png" alt="Login">

			<input type="text" name="usuario" placeholder="Usuario">
			<input type="password" name="clave" placeholder="Contraseña">
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<input type="submit" value="INGRESAR">

		</form>

	</section>
</body>
</html>
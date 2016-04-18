<!DOCTYPE html>
<?php
require_once 'classes/config.php';
require_once 'classes/usuarios.php';
$conf = new Config();
$mensaje = '';
$user = new Usuario();
if($conf->getCfg("registro") != "1"){//si no esta activado el registro
	header("location: ".$conf->getCfg("url")."login/");//redirige a login
}
if(isset($_REQUEST['submit'])){//si se envia el post
	if(empty($_REQUEST['nombre']) || empty($_REQUEST['apellido']) || empty($_REQUEST['pass']) || empty($_REQUEST['user']) || empty($_REQUEST['email'])){//y no hay campos vacios
		$mensaje = '<span class="error">Todos los campos son obligatorios.</span>';
	}
	else{
		if(filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)){//verifica el email
			if(preg_match('/^([a-zA-Z0-9\-\_\.]+)$/i',$_REQUEST['user'])){// despues el user
				$user->setUser($_REQUEST['user']);
				$user->setPass(sha1($_REQUEST['pass']));
				$user->setNombre($_REQUEST['nombre']);
				$user->setApellido($_REQUEST['apellido']);
				$user->setEmail($_REQUEST['email']);
				$user->setPrivilegio("0");
				if($user->Save()){//guarda los datos
					header("location: ".$conf->getCfg("url")."login/");//si se envio correctamente te manda al login
				}
				else{//sino, manda erores
					$mensaje = '<span class="error">Ocurrio un error o el usuario ya existe, intente nuevamente mas tarde.</span>';
				}
			}
			else{
				$mensaje = '<span class="error">El usuario solo puede contener letras y numeros sin espacios.</span>';
			}
		}
		else{
			$mensaje = '<span class="error">Inserte una direccion de correo valida.</span>';
		}
	}
}

?>
<html>
<head>
<meta charset="UTF-8">
<title>Registro</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<base href="<?php echo $conf->getCfg("url"); ?>vistas/admin/"></base>
<link rel="stylesheet" href="css/admin.css">
</head>
<body class="loginpg">
	<div class="login reg">
		<div class="login-screen">
			<div class="app-title">
				<h1>Registrarse</h1>
			</div>
			<div class="login-form">
				<?php echo $mensaje; ?>
				<form action="" method="post">
					<div class="control-group">
						<input required="" type="text" class="login-field" name="user" pattern="[A-Za-z0-9\S]{1,25}" placeholder="Usuario(sin espacios)" id="login-name">
						<label class="login-field-icon fui-user" for="login-name"></label>
					</div>
					<div class="control-group">
						<input required="" type="password" class="login-field" name="pass" placeholder="Contraseña" id="login-pass">
						<label class="login-field-icon fui-lock" for="login-pass"></label>
					</div>
					<div class="control-group">
						<input required="" type="text" class="login-field" name="nombre" placeholder="Nombre" id="login-name">
						<label class="login-field-icon fui-user" for="login-name"></label>
					</div>
					<div class="control-group">
						<input required="" type="text" class="login-field" name="apellido" placeholder="Apellido" id="login-name">
						<label class="login-field-icon fui-user" for="login-name"></label>
					</div>
					<div class="control-group">
						<input required  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type="email" class="login-field" name="email" placeholder="email" id="login-name">
						<label class="login-field-icon fui-user" for="login-name"></label>
					</div>
					<input name="submit" type="submit" class="btn btn-primary btn-large btn-block" value="Registrarse">
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<!DOCTYPE html>
<?php
require_once 'classes/config.php';
require_once 'classes/sesiones.php';
$conf = new Config();
$mensaje = '';
$sesion = new Sesion();

if(isset($_REQUEST['submit'])){
	if(!empty($_REQUEST['pass']) && !empty($_REQUEST['user'])){
		$sesion->Cerrar();
		$sesion->setUser($_REQUEST['user']);
		$sesion->setPass($_REQUEST['pass']);
		if($sesion->Conectar() != true){
			$mensaje = '<span class="error">Usuario o contraseña incorrecta.</span>';
		}
		else{
			if($sesion->Verificar() == true){
				header("location: ".$conf->getCfg("url")."admin/");
			}
		}

	}
	else{//si no relleno todos los campos ↓
		$mensaje = '<span class="error">Todos los campos son obligatorios.</span>';
	}
}

?>
<html>
<head>
<meta charset="UTF-8">
<title>Iniciar Sesión</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<base href="<?php echo $conf->getCfg("url"); ?>vistas/admin/"></base>
<link rel="stylesheet" href="css/admin.css">
</head>
<body class="loginpg">
	<div class="login">
		<div class="login-screen">
			<div class="app-title">
				<h1>Ingresar</h1>
			</div>
			<div class="login-form">
				<?php echo $mensaje; ?>
				<form action="" method="post">
					<div class="control-group">
						<input type="text" class="login-field" name="user" placeholder="Usuario" id="login-name">
						<label class="login-field-icon fui-user" for="login-name"></label>
					</div>
					<div class="control-group">
						<input type="password" class="login-field" name="pass" placeholder="Contraseña" id="login-pass">
						<label class="login-field-icon fui-lock" for="login-pass"></label>
					</div>
					<input name="submit" type="submit" class="btn btn-primary btn-large btn-block" value="Ingresar">
					<a class="login-link" href="<?php echo $conf->getCfg('url');?>">Olvidaste tu contraseña?</a>
					<?php
					if($conf->getCfg("registro") == "1"){
					echo '<a class="login-link" href="'.$conf->getCfg("url").'reg">¿No tienes una cuenta? Registrate!</a>';
					}
					?>
					<a class="login-link" href="<?php echo $conf->getCfg('url');?>">Ir a la pagina principal</a>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
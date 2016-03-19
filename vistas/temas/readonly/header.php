<?php
require_once 'classes/config.php';
require_once 'classes/usuarios.php';
require_once 'classes/media.php';
require_once 'classes/sesiones.php';
require_once 'classes/temas.php';
$sesion = new Sesion();
$conf = new Config();
$tema = new Tema();
if(isset($_REQUEST['login'])){
	if(!empty($_REQUEST['pass']) || !empty($_REQUEST['user'])){
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

<section id="header" class="skel-layers-fixed">
	<header>
		<?php
		if($sesion->Verificar() == true){
			$user = new Usuario();
			$imagen = new Media();
			$user->setId($sesion->getId());
			$imagen->setId($user->getImagen());
			$tipo = "Usuario";
			if($user->getPrivilegio() == "1"){
				$tipo = "Administrador";
			}
			echo '<span class="image avatar">
					<div id="imgcont" style="background-image: url('."'".$imagen->getUrl()."')".'"> </div>
				</span>
				<h1 id="logo">
					<a href="">'.$user->getNombre()." ".$user->getApellido().'</a>
				</h1>
				<p>'.$tipo.'<br />'.$user->getUser().'</p>';
		}
		else{
			echo '<h4>Ingresar:</h4>
			<form action="" method="post">
			<div class="row uniform">
			<div class="12u"><input type="text" name="user" placeholder="Usuario" /></div>
			</div>
			<div class="row uniform">
			<div class="12u"><input type="password" name="pass" placeholder="Contraseña" /></div>
			</div>
			<div class="row uniform">
			<div class="12u"><input class="fit" type="submit" name="login" Value="Iniciar Sesión"></div>
			</div>
			</form>
			<p>
			<a href="#">Olvidaste tu contraseña?</a>
			</br>';
			if($conf->getCfg("registro") == "1"){
			echo '<a href="'.$conf->getCfg("url").'reg">¿No tienes una cuenta? Registrate!</a></p>';
			}
					;
		}

		?>
		
	</header>
	<nav id="nav">
		<ul>
			<li><a href="#one" class="active"><?php print $tema->getCfg("page_about"); ?></a></li>
			<li><a href="#three"><?php print $tema->getCfg("page_news"); ?></a></li>
			<li><a href="#four"><?php print $tema->getCfg("page_contact"); ?></a></li>
		</ul>
	</nav>
	<footer>
		<ul class="icons">
			<li><a href="" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
			<li><a href="" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
			<li><a href="" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
			<li><a href="" class="icon fa-github"><span class="label">Github</span></a></li>
			<li><a href="" class="icon fa-envelope"><span class="label">Email</span></a></li>
		</ul>
	</footer>
</section>
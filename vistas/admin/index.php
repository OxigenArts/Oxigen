<!DOCTYPE html>
<html>
<head>
	<?php
	require_once 'classes/media.php';
	require_once 'classes/config.php';
	require_once 'classes/sesiones.php';
	require_once 'classes/usuarios.php';
	require_once 'classes/secadm.php';
	$conf = new Config();
	if(isset($_GET['id'])){//si existe la variable get
		$secid = $_GET['id'];//la almacena aqyui
	}
	else{
		$secid = "1";// sino establece el id 1 por defecto
	}
	$sesion = new Sesion();
	$u = new Usuario();
	$u->setId($sesion->getId());
	if($sesion->Verificar() == true){
		if($u->getPrivilegio() != "1"){//si no es admin
			header("location: ".$conf->getCfg("url"));
		}
	}
	else{
		header("location: ".$conf->getCfg("url")."login");
	}
	$logoimg = new Media();
	$userimg = new Media();
	$seccion = new SeccionAdmin();
	$seccion->setId($secid);
	$allsecs = $seccion->getAll();
	$logoimg->setId($conf->getCfg("logo"));
	$urllogo = $logoimg->getUrl();
	$titulo = $conf->getCfg("nombre");
	$userimg->setId($u->getImagen());
	$urluser = $userimg->getUrl();
	$username = $u->getUser();
	$secuser = "0";
	foreach ($allsecs as $key => $value) {
			if($value['archivo'] == 'users.php'){
				$secuser = $value['id'];
			}
		}
	?>
	<title><?php print $titulo." - Admin"; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<base href="<?php echo $conf->getCfg("url"); ?>vistas/admin/"></base>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	</head>
<body>
<div id="loader">
<div class="loader"></div>
</div>
	<script>
	var loader = document.getElementById('loader');
	var body = document.body;
	body.onload=function(){
		loader.setAttribute("style", "display:none");
    };
	</script>
<header>
	<div id="logo">
	<a href="<?php echo $conf->getCfg("url"); ?>admin">
		<div id="logobg">
			<img src="<?php print $urllogo; ?>">
		</div>
	</a>
	<i class="fa fa-bars"></i>
	</div>

	<ul>
		<a href="<?php echo $conf->getCfg("url"); ?>logout"><li><i class="fa fa-times"></i></li></a>
		<a href="<?php echo $conf->getCfg("url")."admin/".$secuser; ?>"><li><img src="<?php print $urluser; ?>"><h1><?php print $username; ?></h1></li></a>
	</ul>
</header>
<section id="menu">
	<div class="user">
	<a href="<?php echo $conf->getCfg("url")."admin/".$secuser; ?>">
	<div id="imguser" style="background-image: url('<?php print $urluser; ?>');"> </div>
	<h1><?php print $username; ?></h1>
	</a>
	</div>
	<ul>
		<li class="principal">Atajos</li>
		<a href="<?php echo $conf->getCfg("url"); ?>"><li><i class="fa fa-circle-o text-aqua"></i>Pagina Principal</li></a>
		<a href="<?php echo $conf->getCfg("url"); ?>logout"><li><i class="fa fa-circle-o text-rojo"></i>Cerrar Sesion</li></a>
		<li class="principal">Menu Principal</li>
		<?php
		$hijo = false;
		foreach ($allsecs as $key => $value) {
			$activo ="";

			if($value['id'] == 	$secid){
				$activo = "active";
			}
			if($value['padre'] == "1"){
				if(empty($value['archivo'])){
					if($hijo == true){
						echo "</ul>";
						$hijo = false;
					}
					echo'<li class="padre '.$activo.' desplegable"><i class="fa fa-chevron-right"></i>'.$value['titulo'].'</li><ul class="submenu">';
					$hijo = true;
				}
				else{
					if($hijo == true){
						echo "</ul>";
						$hijo = false;
					}
					echo'<a href="'.$conf->getCfg("url").'admin/'.$value['id'].'"><li class="padre shadow '.$activo.'"><i class="fa fa-circle-o"></i>'.$value['titulo'].'</li></a>';
				}
			}
			else{
				echo'<a href="'.$conf->getCfg("url").'admin/'.$value['id'].'"><li class="shadow '.$activo.' hijo"><i class="fa fa-chevron-right"></i>'.$value['titulo'].'</li></a>';
			}
		}
		if($hijo == true){
			echo "</ul>";
			$hijo = false;
		}
		?>

	</ul>
</section>
<section id="body">
	<?php
	$archivoseccion = $seccion->getArchivo();
	if($archivoseccion != ""){
		@include($archivoseccion);
	}

	?>
</section>
</body>
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
	var menu = "#menu";
	$(".submenu").css("display","none");
	$(document).ready(function(){

		$(".desplegable").click(function(){
			if($(this).next(".submenu").css("display") == "none"){
				$(this).next(".submenu").css("display","block");
				$(this).children('i').removeClass("fa-chevron-right");
				$(this).children('i').addClass("fa-chevron-down");
			}
			else{
				$(this).next(".submenu").css("display","none");
				$(this).children('i').removeClass("fa-chevron-down");
				$(this).children('i').addClass("fa-chevron-right");

			}
		});

		$(".active").parent().parent(".submenu").css("display","block");

		$("header #logo i").click(function(){
		if($(menu).css("visibility") == "hidden"){
			$(menu).css("opacity","1");
			$(menu).css("visibility","visible");
		}
		else{
			$(menu).css("opacity","0");
			$(menu).css("visibility","hidden");
		}
		});

	});
	
	$(window).on('resize', function(){
		if($("body").width() > 780){
			$(menu).css("opacity","1");
			$(menu).css("visibility","visible");
		}
	});
</script>
</html>

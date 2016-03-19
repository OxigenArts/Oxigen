<?php
require_once 'classes/imagenes.php';
require_once 'classes/config.php';
$cfg = new Config();
$imagen = new Imagen();
if(isset($_POST['submit'])){
	if(!empty($_REQUEST['titulo']) && !empty($_REQUEST['nombre'])){
		$idimagen = $imagen->Subir($_FILES['imagen']);
		if($idimagen == false){//si la imagen no es false,osea si se subio
			$newimg = $cfg->getCfg("logo");
		}
		else{
			$imagen->setId($cfg->getCfg("logo"));//setea el id de la img con el logo anterior
			$imagen->Delete();//para borrarlo
			$newimg = $idimagen[0];//y mete la img en la variable
		}
		$rq_titulo = $_REQUEST['titulo'];
		$rq_descripcion = $_REQUEST['descripcion'];
		$rq_nombre = $_REQUEST['nombre'];
		if($cfg->setCfg(array("titulo" => $rq_titulo,"descripcion" => $rq_descripcion,"nombre" => $rq_nombre,"logo" => $newimg))){
			echo '<script>window.location.href = window.location.pathname;</script>';
			$mensaje = '<span class="success">Configuracion actualizada correctamente!</span>';

		}
		else{
			echo '<script>window.location.href = window.location.pathname;</script>';
			$mensaje = '<span class="error">Ocurrio un error, intenta nuevamente. Si el problema persiste contacte a un administrador.</span>';
		}
	}
	else{
		$mensaje = '<span class="error">Ocurrio un error, verifique los campos.</span>';
	}

}
else{
	$imagen->setId($cfg->getCfg("logo"));
	$mensaje = "";
}

?>

<h1>Configuracion General</h1>
<p>Rellene el formulario para cambiar la configuracion general del sitio.</p>
<p>Los campos marcados con <span class="red">*</span> son obligatorios</p>
<?php echo $mensaje; ?>
<section id="lista">
	<article>
<form action="" method="post" enctype="multipart/form-data">

	<h2><span class="red">*</span> Titulo de la web:<h2>
	<input required name="titulo" value="<?php echo $cfg->getCfg("titulo"); ?>" type="text">

	<h2> Descripcion de la web:<h2>
	<input required name="descripcion" value="<?php echo $cfg->getCfg("descripcion"); ?>" type="text">

	<h2><span class="red">*</span> Nombre de empresa:<h2>
	<input required name="nombre" value="<?php echo $cfg->getCfg("nombre"); ?>" type="text">
	<h2><span class="red">*</span> Logo:</h2>
	<label for="imagen"><img class="realsize" src="<?php echo $imagen->getUrl(); ?>"></label>
	<input id="imagen" name="imagen" type="file">

	<input class="azul" name="submit" type="submit" value="Guardar">
</form>
</article>
</section>

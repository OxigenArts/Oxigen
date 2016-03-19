<?php
if(isset($_POST['submit'])){
	if(empty($_REQUEST['titulo']) || empty($_REQUEST['contenido'])){
		$mensaje = '<span class="error">Ocurrio un error, verifique los campos.</span>';
	}
	else{
		require_once 'classes/imagenes.php';
		require_once 'classes/usuarios.php';
		require_once 'classes/paginas.php';
		$post = new Pagina();
		$post->setTitulo($_REQUEST['titulo']);
		$post->setContenido($_REQUEST['contenido']);
		if($post->Save()){
			$mensaje = '<span class="success">Pagina agregada correctamente!</span>';
		}	
		else{
			$mensaje = '<span class="error">Ocurrio un error, intenta nuevamente. si el problema persiste contacte a un administrador.</span>';
		}	
	}
}
else{
	$mensaje = "";
}
?>

<h1>Nueva Pagina</h1>
<p>Rellene el formulario para añadir una nueva pagina.</p>
<p>Los campos marcados con <span class="red">*</span> son obligatorios</p>
<?php echo $mensaje; ?>
<section id="lista">
	<article>
<form action="" method="post" enctype="multipart/form-data">
	<h2><span class="red">*</span> Titulo:<h2>
	<input required name="titulo" type="text">
	<h2><span class="red">*</span> Contenido de la publicacion:</h2>
	<textarea required name="contenido"></textarea>
	<input class="azul" name="submit" type="submit" value="Guardar">
</form>
	</article>
</section>

<?php
if(isset($_POST['submit'])){
	if(empty($_REQUEST['titulo']) || empty($_REQUEST['contenido'])){
		$mensaje = '<span class="error">Ocurrio un error, verifique los campos.</span>';
	}
	else{
		require_once 'classes/media.php';
		require_once 'classes/usuarios.php';
		require_once 'classes/posts.php';

		$userid = $_SESSION['id'];
		$imagen = new Media();
		$idimagen = $imagen->Subir($_FILES['imagen'],array('imagen'));
		if($idimagen != false){
			$post = new Post();
			$post->setTitulo($_REQUEST['titulo']);
			$post->setContenido($_REQUEST['contenido']);
			$post->setAutor($userid);
			$post->setFecha(date("Y-m-d"));
			$post->setTags($_REQUEST['tags']);
			$post->setImagen($idimagen[0]);
			if($post->Save()){
				$mensaje = '<span class="success">Post agregado correctamente!</span>';
			}
			else{
				$mensaje = '<span class="error">Ocurrio un error, intenta nuevamente. si el problema persiste contacte a un administrador.</span>';
			}
		}
		else{
			$mensaje = '<span class="error">Ocurrio un error, verifique que la imagen sea válida.</span>';
		}
	}

}
else{
	$mensaje = "";
}
?>
<h1>Nuevo post</h1>
<p>Rellene el formulario para añadir una nueva publicación.</p>
<p>Los campos marcados con <span class="red">*</span> son obligatorios</p>
<?php echo $mensaje; ?>
<section id="lista">
	<article>
		<form action="" method="post" enctype="multipart/form-data">
	<h2><span class="red">*</span> Titulo:<h2>
	<input required name="titulo" type="text">
	<h2><span class="red">*</span> Contenido de la publicacion:</h2>
	<textarea required name="contenido"></textarea>
	<h2><span class="red">*</span> Imagen destacada:</h2>
	<input required name="imagen" type="file">
	<h2> Tags: (separados por comas)</h2>
	<input name="tags" type="text">
	<input class="azul" name="submit" type="submit" value="Guardar">

</form>
	</article>
</section>

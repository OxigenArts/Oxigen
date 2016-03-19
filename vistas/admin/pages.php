<?php
require_once 'classes/media.php';
require_once 'classes/usuarios.php';
require_once 'classes/paginas.php';
$mensaje = "";
if(isset($_POST['eliminar'])){
	$imagen = new Media();
	$post = new Pagina();
	$post->setId($_POST['id']);
	if($post->Eliminar()){
		$mensaje = '<span class="success">Pagina eliminada con exito!</span>';
	}
	else{
		$mensaje = '<span class="error">Ocurrio un problema al eliminar la Pagina.</span>';
	}
	mostrarPosts($mensaje);
}
else if(isset($_POST['editar'])){
	$post = new Pagina();
	$post->setId($_POST['id']);
	echo'<h1>Editar pagina</h1>
	<p>Rellene el formulario para editar la pagina.</p>
	<p>Los campos marcados con <span class="red">*</span> son obligatorios</p>
	<section id="lista">
	<article>
	<form action="" method="post" enctype="multipart/form-data">
	<h2><span class="red">*</span> Titulo:<h2>
	<input value="'.$post->getTitulo().'" required name="titulo" type="text">
	<h2><span class="red">*</span> Contenido de la publicacion:</h2>
	<textarea required name="contenido">'.$post->getContenido().'</textarea>
	<input type="hidden" name="id" value="'.$_POST['id'].'">
	<input name="editsave" class="azul"  type="submit" value="Guardar">
	<?php echo $mensaje;?>
	</form>
	</article>
	</section>';
}
else if(isset($_POST['editsave'])){

	if(empty($_POST['titulo']) || empty($_POST['contenido']) ){
		$mensaje = '<span class="error">Ocurrio un error, verifique los campos.</span>';
	}
	else{
		$posted = new Pagina();
		$posted->setId($_POST['id']);
		$posted->setTitulo($_REQUEST['titulo']);
		$posted->setContenido($_REQUEST['contenido']);
		if($posted->Actualizar()){
			$mensaje = '<span class="success">Pagina guardada correctamente!</span>';
		}
		else{
			$mensaje = '<span class="error">Ocurrio un error, intenta nuevamente. si el problema persiste contacte a un administrador.</span>';
		}
	}
	mostrarPosts($mensaje);
}
else{
	mostrarPosts($mensaje);
}

function mostrarPosts($mensaje){
	echo '<h1>Paginas</h1>
	<p>Aqui puede encontrar una lista de paginas en el sitio.</p>
	<p>'.$mensaje.'</p>
	<section id="lista">';
	$post = new Pagina();
	$allposts = array_reverse($post->getAll());
	$i = 0;
	$max = sizeof($allposts);
	if($allposts == false){
	echo '<article>
	<p style="text-align:center;">Aún no hay paginas creadas</p>
	</article>';
	}
	else{
		while($i < $max){
	echo '<article>
			<h2>'.$allposts[$i]['titulo'].'</h2>
			<h3>Contenido: </h3>
			<p>'.$allposts[$i]['contenido'].'</p>
			<ul>
				<li>
					<form method="post">
					<input type="hidden" name="id" value="'.$allposts[$i]['id'].'">
					<input name="editar" class="azul" value="Editar" type="submit">
					</form>
				</li>
				<li>
					<form method="post">
					<input type="hidden" name="id" value="'.$allposts[$i]['id'].'">
					<input name="eliminar" class="rojo" value="Eliminar" type="submit">
					</form>
				</li>
			</ul>
		</article>';
	$i++;
}
	}

echo '</section>';

}
?>

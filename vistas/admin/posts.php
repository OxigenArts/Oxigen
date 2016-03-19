<?php
require_once 'classes/imagenes.php';
require_once 'classes/usuarios.php';
require_once 'classes/posts.php';
$mensaje = "";
if(isset($_POST['eliminar'])){
	$imagen = new Imagen();
	$post = new Post();
	$post->setId($_POST['id']);
	$imagen->setId($post->getImagen());
	if($post->Eliminar()){
		if($imagen->Eliminar()){
			$mensaje = '<span class="success">Post eliminado con exito!</span>';
		}
		else{
			$mensaje = '<span class="neutro">El post se eliminó, pero ocurrio un problema al intentar eliminar la imagen.</span>';
		}
	}
	else{
		$mensaje = '<span class="error">Ocurrio un problema al eliminar el post.</span>';
	}
	mostrarPosts($mensaje);
}
else if(isset($_POST['editar'])){
	$post = new Post();
	$imagen = new Imagen();
	$post->setId($_POST['id']);
	$imagen->setId($post->getImagen());

	echo'<h1>Editar post</h1>
	<p>Rellene el formulario para editar la publicación.</p>
	<p>Los campos marcados con <span class="red">*</span> son obligatorios</p>
	<section id="lista">
	<article>
	<form action="" method="post" enctype="multipart/form-data">
	<h2><span class="red">*</span> Titulo:<h2>
	<input value="'.$post->getTitulo().'" required name="titulo" type="text">
	<h2><span class="red">*</span> Contenido de la publicacion:</h2>
	<textarea required name="contenido">'.$post->getContenido().'</textarea>
	<h2> Imagen destacada:</h2>
	<label for="imagen"><img class="imgcenter" src="'.$imagen->getUrl().'"></label>
	<input id="imagen" name="imagen" type="file">
	<h2> Tags: (separados por comas)</h2>
	<input value="'.$post->getTags().'" name="tags" type="text">
	<input value="'.$post->getId().'" name="id" type="hidden">
	<input name="editsave" class="azul"  type="submit" value="Guardar">
	<?php echo $mensaje; ?>
	</form>
	</article>
	</section>
	';
}
else if(isset($_POST['editsave'])){

	if(empty($_POST['titulo']) || empty($_POST['contenido']) ){
		$mensaje = '<span class="error">Ocurrio un error, verifique los campos.</span>';
	}
	else{
		$imagen = new Imagen();
		$post = new Post();
		$post->setId($_POST['id']);
		$idimagen = $imagen->Subir($_FILES['imagen']);
		if($idimagen != false){
			$imagen->setId($post->getImagen());
			$imagen->Eliminar();
		}
		$post->setTitulo($_REQUEST['titulo']);
		$post->setContenido($_REQUEST['contenido']);
		$post->setTags($_REQUEST['tags']);
		$post->setImagen($idimagen[0]);
		if($post->Actualizar()){
			$mensaje = '<span class="success">Post guardado correctamente!</span>';
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
	echo '<h1>Publicaciones</h1>
	<p>Aqui puede encontrar una lista de publicaciones</p>
	<p>'.$mensaje.'</p>
	<section id="lista">
	<table>
  <tr>
  	<th><i class="fa fa-pencil"></i><i class="fa fa-times"></i></th>
    <th>ID</th>
    <th>Imagen</th>
    <th>Titulo</th>
    <th>Contenido</th>
    <th>Autor</th>
    <th>Tags</th>
    <th>Fecha</th>
  </tr>';
	$imagen = new Imagen();
	$post = new Post();
	$user = new Usuario();
	$allposts = $post->getAll();
	foreach ($allposts as $value) {
	$imagen->setId($value['img']);
	$urlimg = $imagen->getUrl();
	$user->setId($value['autor']);
		echo'<tr>
			<td>
				<ul>
					<li>
						<form method="post">
						<input type="hidden" name="id" value="'.$value['id'].'">
						<input name="editar" type="hidden">
						<i class="fa fa-pencil" onclick="this.parentNode.submit();"></i>
						</form>
					</li>
					<li>
						<form method="post">
						<input type="hidden" name="id" value="'.$value['id'].'">
						<input name="eliminar" type="hidden">
						<i class="fa fa-times" onclick="this.parentNode.submit();"></i>
						</form>
					</li>
				</ul>
			</td>
    		<td>'.$value['id'].'</td>
    		<td style="background-image: url('."'".$urlimg."'".');"></td>
    		<td>'.$value['titulo'].'</td>
    		<td>'.substr($value['contenido'],0,50).'...</td>
    		<td>'.$user->getUser().'</td>
    		<td>'.$value['tags'].'</td>
    		<td>'.$value['fecha'].'</td>
  		</tr>';
	}

echo '</table></section>';
}
?>

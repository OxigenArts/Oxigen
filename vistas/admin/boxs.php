<?php
require_once 'classes/media.php';
require_once 'classes/usuarios.php';
require_once 'classes/boxs.php';
require_once 'classes/categorias_boxs.php';
$mensaje = "";
if(isset($_POST['eliminar'])){
	$imagen = new Media();
	$box = new Box();
	$box->setId($_POST['id']);
	$imagen->setId($box->getImagen());
	if($box->Eliminar()){
		if($imagen->Eliminar()){
			$mensaje = '<span class="success">Box eliminado con exito!</span>';
		}
		else{
			$mensaje = '<span class="neutro">El box se eliminó, pero ocurrio un problema al intentar eliminar la imagen.</span>';
		}
	}
	else{
		$mensaje = '<span class="error">Ocurrio un problema al eliminar el box.</span>';
	}
	mostrarBoxs($mensaje);
}
else if(isset($_POST['editar'])){
	$box = new Box();
	$categoria = new Categoria_box();
	$categorias = $categoria->getAll();
	$imagen = new Media();
	$box->setId($_POST['id']);
	$imagen->setId($box->getImagen());
	echo'<h1>Editar Box</h1>
	<p>Rellene el formulario para editar la informacion del box.</p>
	<p>Los campos marcados con <span class="red">*</span> son obligatorios</p>
	<section id="lista">
	<article>
	<form action="" method="post" enctype="multipart/form-data">
	<h2><span class="red">*</span> Titulo:<h2>
	<input value="'.$box->getTitulo().'" required name="titulo" maxlength="256" type="text">
	<h2><span class="red">*</span> Link:<h2>
	<input value="'.$box->getLink().'" required name="link" type="text">
	<select name="categoria">';
	if($categorias != false){
		foreach ($categorias as $value) {
			if($value['categoria'] == $box->getCategoria()){
				echo'<option value="'.$value['id'].'" selected >'.$value['titulo'].'</option>';
			}
			else{
				echo'<option value="'.$value['id'].'">'.$value['titulo'].'</option>';
			}
		}
	}
	echo '</select>
	<h2> Imagen:</h2>
	<img class="imgcenter" src="'.$imagen->getUrl().'">
	<input name="imagen" type="file">
	<input value="'.$box->getId().'" name="id" type="hidden">
	<input name="editsave" class="azul" type="submit" value="Guardar">
	</form>
	</article>
	</section>';
}
else if(isset($_POST['editsave'])){

	if(!empty($_POST['titulo']) || !empty($_POST['link']) || !empty($_POST['categoria'])){
		$imagen = new Media();
		$box = new Box();
		$box->setId($_POST['id']);
		$idimagen = $imagen->Subir($_FILES['imagen'],array('imagen'));
		if($idimagen != false){
			$imagen->setId($box->getImagen());
			$imagen->Eliminar();
		}
		$box->setTitulo($_REQUEST['titulo']);
		$box->setLink($_REQUEST['link']);
		$box->setCategoria($_REQUEST['categoria']);
		$box->setImagen($idimagen[0]);
		if($box->Actualizar()){
			$mensaje = '<span class="success">Box guardado correctamente!</span>';
		}
		else{
			$mensaje = '<span class="error">Ocurrio un error, intenta nuevamente. si el problema persiste contacte a un administrador.</span>';
		}
	}
	else{
		$mensaje = '<span class="error">Ocurrio un error, verifique los campos.</span>';
	}
	mostrarBoxs($mensaje);
}
else if(isset($_POST['nuevo'])){
	$categoria = new Categoria_box();
	$categorias = $categoria->getAll();
	echo'<h1>Nuevo Box</h1>
	<p>Rellene el formulario para crear un nuevo usuario.</p>
	<p>Los campos marcados con <span class="red">*</span> son obligatorios</p>
	<section id="lista">
	<article>
	<form action="" method="post" enctype="multipart/form-data">
	<h2><span class="red">*</span> Titulo:<h2>
	<input required name="titulo" maxlength="256" type="text">
	<h2><span class="red">*</span> Link:<h2>
	<input required name="link" type="text">
	<h2><span class="red">*</span> Categoria:<h2>
	<select name="categoria">';
	if($categorias != false){
		foreach ($categorias as $value) {
			echo'<option value="'.$value['id'].'">'.$value['titulo'].'</option>';
		}
	}
	echo'</select>
	<h2><span class="red">*</span> Imagen:</h2>
	<input  required name="imagen" type="file">
	<input name="guardarnuevo" class="azul" type="submit" value="Guardar">
	</form>
	</article>
	</section>';
}
else if(isset($_POST['guardarnuevo'])){
	if(!empty($_POST['titulo']) || !empty($_POST['link']) || !empty($_POST['categoria'])){
		$imagen = new Media();
		$box = new Box();
		$idimagen = $imagen->Subir($_FILES['imagen'],array('imagen'));
		if($idimagen != false){
			$box->setTitulo($_REQUEST['titulo']);
			$box->setLink($_REQUEST['link']);
			$box->setCategoria($_REQUEST['categoria']);
			$box->setImagen($idimagen[0]);
			if($box->Save()){
				$mensaje = '<span class="success">Box guardado correctamente!</span>';
			}
			else{
				$mensaje = '<span class="error">Ocurrio un error, intenta nuevamente. si el problema persiste contacte a un administrador.</span>';
			}
		}
		else{
			$mensaje = '<span class="error">Ocurrio un error, verifique que la imagen sea válida.</span>';
		}
	}
	else{
		$mensaje = '<span class="error">Ocurrio un error, verifique los campos.</span>';
	}
	mostrarBoxs($mensaje);
}
else{
	mostrarBoxs($mensaje);
}

function mostrarBoxs($mensaje){
	echo '<h1>Boxs</h1>
	<p>Aqui puede encontrar una lista de los boxs del sitio</p>
	<p>'.$mensaje.'</p>
	<form method="post">
		<input name="nuevo" class="boton verde" value="Crear Box" type="submit">
	</form>
	<section id="lista">
	<table>
  <tr>
  	<th><i class="fa fa-pencil"></i><i class="fa fa-times"></i></th>
    <th>ID</th>
    <th>Foto</th>
    <th>Titulo<br></th>
    <th>Link</th>
    <th>Categoría</th>
  </tr>';
	$imagen = new Media();
	$box = new Box();
	$categoria = new Categoria_box();
	$boxs = $box->getAll();
	foreach ($boxs as $value) {
		$categoria->setId($value['categoria']);
		$imagen->setId($value['img']);
		$imagenurl = $imagen->getUrl();
		echo'<tr >
			<td width="50px">
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
    		<td width="50px">'.$value['id'].'</td>
    		<td width="50px" style="background-image: url('."'".$imagenurl."'".');"></td>
    		<td>'.$value['titulo'].'</td>
    		<td>'.$value['link'].'</td>
    		<td>'.$categoria->getTitulo().'</td>
  		</tr>';
	}
echo '</table></section>';
}
?>

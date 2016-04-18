<?php
require_once 'classes/categorias_boxs.php';
$mensaje = "";
if(isset($_POST['eliminar'])){
	$categoria = new Categoria_box();
	$categoria->setId($_POST['id']);
	if($categoria->Eliminar()){
		$mensaje = '<span class="success">Categoría eliminada correctamente!</span>';
	}
	else{
		$mensaje = '<span class="error">Ocurrio un problema al eliminar la categoria.</span>';
	}
	mostrarBoxs($mensaje);
}
else if(isset($_POST['editar'])){
	$categoria = new Categoria_box();
	$categoria->setId($_POST['id']);
	echo'<h1>Editar Categoría</h1>
	<p>Rellene el formulario para editar la informacion de la categoria.</p>
	<p>Los campos marcados con <span class="red">*</span> son obligatorios</p>
	<section id="lista">
	<article>
	<form action="" method="post">
	<h2><span class="red">*</span>Titulo:<h2>
	<input value="'.$categoria->getTitulo().'" required name="titulo" maxlength="14" type="text">
	<input value="'.$categoria->getId().'" name="id" type="hidden">
	<input name="editsave" class="azul" type="submit" value="Guardar">
	</form>
	</article>
	</section>';
}
else if(isset($_POST['editsave'])){
	if(!empty($_POST['titulo'])){
		$categoria = new Categoria_box();
		$categoria->setId($_POST['id']);
		$categoria->setTitulo($_REQUEST['titulo']);
		if($categoria->Actualizar()){
			$mensaje = '<span class="success">Categoría guardada correctamente!</span>';
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
	echo'<h1>Nueva Categoria</h1>
	<p>Rellene el formulario para crear una nueva categoría.</p>
	<p>Los campos marcados con <span class="red">*</span> son obligatorios</p>
	<section id="lista">
	<article>
	<form action="" method="post" enctype="multipart/form-data">
	<h2><span class="red">*</span> Titulo:<h2>
	<input required name="titulo" maxlength="256" type="text">
	<input name="guardarnuevo" class="azul" type="submit" value="Guardar">
	</form>
	</article>
	</section>';
}
else if(isset($_POST['guardarnuevo'])){
	if(!empty($_POST['titulo'])){
		$categoria = new Categoria_box();
		$categoria->setTitulo($_REQUEST['titulo']);
		if($categoria->Save()){
			$mensaje = '<span class="success">Categoría guardada correctamente!</span>';
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
else{
	mostrarBoxs($mensaje);
}

function mostrarBoxs($mensaje){
	echo '<h1>Categorias</h1>
	<p>Aqui puede encontrar una lista de las categorias para los boxs del sitio</p>
	<p>'.$mensaje.'</p>
	<form method="post">
		<input name="nuevo" class="boton verde" value="Nueva Categoría" type="submit">
	</form>
	<section id="lista">
	<table>
  <tr>
  	<th><i class="fa fa-pencil"></i><i class="fa fa-times"></i></th>
    <th>ID</th>
    <th>Titulo</th>
  </tr>';
	$categoria = new Categoria_box();
	$categorias = $categoria->getAll();
	foreach ($categorias as $value) {
		echo'<tr>
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
    		<td width="50px" >'.$value['id'].'</td>
    		<td>'.$value['titulo'].'</td>
  		</tr>';
	}
echo '</table></section>';
}
?>

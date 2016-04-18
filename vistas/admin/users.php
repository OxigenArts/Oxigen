<?php
require_once 'classes/media.php';
require_once 'classes/usuarios.php';
require_once 'classes/posts.php';
$mensaje = "";
if(isset($_POST['eliminar'])){
	$imagen = new Media();
	$user = new Usuario();
	$user->setId($_POST['id']);
	$imagen->setId($user->getImagen());
	if($user->getId() == $_SESSION['id']){
		$mensaje = '<span class="error">No puedes eliminar tu propia cuenta.</span>';
	}
	else if($user->getPrivilegio()== "1"){
		$mensaje = '<span class="error">No puedes eliminar a otro Administrador.</span>';
	}
	else{
		if($user->Eliminar()){
			if($imagen->Eliminar()){
				$mensaje = '<span class="success">Usuario eliminado con exito!</span>';
			}
			else{
				$mensaje = '<span class="neutro">El usuario se eliminó, pero ocurrio un problema al intentar eliminar la imagen.</span>';
			}
		}
		else{
			$mensaje = '<span class="error">Ocurrio un problema al eliminar el usuario.</span>';
		}
	}
	mostrarUsers($mensaje);
}
else if(isset($_POST['editar'])){
	$user = new Usuario();
	$imagen = new Media();
	$user->setId($_POST['id']);
	$imagen->setId($user->getImagen());
	echo'<h1>Editar usuario</h1>
	<p>Rellene el formulario para editar la informacion del usuario.</p>
	<p>Los campos marcados con <span class="red">*</span> son obligatorios</p>
	<section id="lista">
	<article>
	<form action="" method="post" enctype="multipart/form-data">
	<h2><span class="red">*</span> Nombre de usuario:<h2>
	<input value="'.$user->getUser().'" required name="user" maxlength="14" type="text">
	<h2>Contraseña:<h2>
	<input name="pass" type="password">
	<h2><span class="red">*</span> Nombre:<h2>
	<input value="'.$user->getNombre().'" required name="nombre" maxlength="64"  type="text">
	<h2><span class="red">*</span> Apellido:<h2>
	<input value="'.$user->getApellido().'" required name="apellido" maxlength="64"  type="text">
	<h2><span class="red">*</span> Email:<h2>
	<input value="'.$user->getEmail().'" required name="email" maxlength="128"  type="text">
	<h2><span class="red">*</span> Privilegio:<h2>
	<select name="privilegio">';
	if($user->getPrivilegio() == "1"){
		echo'<option value="0">Usuario Normal</option><option value="1" selected >Administrador</option>';
	}
	else{
		echo'<option value="0" selected >Usuario Normal</option><option value="1" >Administrador</option>';
	}
	echo'
	</select>
	<h2> Foto de perfil:</h2>
	<img class="imgcenter" src="'.$imagen->getUrl().'">
	<input name="imagen" type="file">
	<input value="'.$user->getId().'" name="id" type="hidden">
	<input name="editsave" class="azul" type="submit" value="Guardar">
	</form>
	</article>
	</section>';
}
else if(isset($_POST['editsave'])){

	if(!empty($_POST['user']) || !empty($_POST['nombre']) || !empty($_POST['apellido']) || !empty($_POST['email']) || !empty($_POST['privilegio']) ){
		$imagen = new Media();
		$user = new Usuario();
		$user->setId($_POST['id']);
		$idimagen = $imagen->Subir($_FILES['imagen'],array('imagen'));
		if($idimagen != false){
			$imagen->setId($user->getImagen());
			$imagen->Eliminar();
		}
		$user->setUser($_REQUEST['user']);
		$user->setNombre($_REQUEST['nombre']);
		$user->setApellido($_REQUEST['apellido']);
		$user->setEmail($_REQUEST['email']);
		if(!empty($_POST['pass'])){
			$user->setPass(sha1($_REQUEST['pass']));
		}
		$user->setPrivilegio($_REQUEST['privilegio']);
		$user->setImagen($idimagen[0]);
		if($user->Actualizar()){
			$mensaje = '<span class="success">Usuario guardado correctamente!</span>';
		}
		else{
			$mensaje = '<span class="error">Ocurrio un error, intenta nuevamente. si el problema persiste contacte a un administrador.</span>';
		}
	}
	else{
		$mensaje = '<span class="error">Ocurrio un error, verifique los campos.</span>';
	}
	if($user->getId() == $_SESSION['id']){
		echo '<script>window.location.href = window.location.pathname;</script>';
	}
	mostrarUsers($mensaje);
}
else if(isset($_POST['nuevo'])){
	$user = new Usuario();
	$imagen = new Media();
	echo'<h1>Nuevo usuario</h1>
	<p>Rellene el formulario para crear un nuevo usuario.</p>
	<p>Los campos marcados con <span class="red">*</span> son obligatorios</p>
	<section id="lista">
	<article>
	<form action="" method="post" enctype="multipart/form-data">
	<h2><span class="red">*</span> Nombre de usuario:<h2>
	<input required name="user" maxlength="14" type="text">
	<h2><span class="red">*</span> Contraseña:<h2>
	<input required name="pass" type="password">
	<h2><span class="red">*</span> Nombre:<h2>
	<input required name="nombre" maxlength="64"  type="text">
	<h2><span class="red">*</span> Apellido:<h2>
	<input required name="apellido" maxlength="64"  type="text">
	<h2><span class="red">*</span> Email:<h2>
	<input required name="email" maxlength="128"  type="text">
	<h2><span class="red">*</span> Privilegio:<h2>
	<select name="privilegio">
	<option value="0" selected >Usuario Normal</option>
	<option value="1" >Administrador</option>
	</select>
	<h2><span class="red">*</span> Foto de perfil:</h2>
	<input  required name="imagen" type="file">
	<input name="guardarnuevo" class="azul" type="submit" value="Guardar">
	</form>
	</article>
	</section>';
}
else if(isset($_POST['guardarnuevo'])){
	if(!empty($_POST['user']) || !empty($_POST['nombre']) || !empty($_POST['apellido']) || !empty($_POST['email']) || !empty($_POST['privilegio']) || !empty($_POST['pass']) ){
		$imagen = new Media();
		$user = new Usuario();
		$idimagen = $imagen->Subir($_FILES['imagen'],array('imagen'));
		if($idimagen != false){
			$user->setUser($_REQUEST['user']);
			$user->setPass(sha1($_REQUEST['pass']));
			$user->setEmail($_REQUEST['email']);
			$user->setImagen($idimagen[0]);
			$user->setNombre($_REQUEST['nombre']);
			$user->setApellido($_REQUEST['apellido']);
			$user->setPrivilegio($_REQUEST['privilegio']);
			if($user->Save()){
				$mensaje = '<span class="success">Usuario guardado correctamente!</span>';
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
	mostrarUsers($mensaje);
}
else{
	mostrarUsers($mensaje);
}

function mostrarUsers($mensaje){
	echo '<h1>Usuarios</h1>
	<p>Aqui puede encontrar una lista de los usuarios del sitio</p>
	<p>'.$mensaje.'</p>
	<form method="post">
		<input name="nuevo" class="boton verde" value="Nuevo Usuario" type="submit">
	</form>
	<section id="lista">
	<table>
  <tr>
  	<th><i class="fa fa-pencil"></i><i class="fa fa-times"></i></th>
    <th>ID</th>
    <th>Foto</th>
    <th>Nombre de Usuario<br></th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Email</th>
    <th>Privilegio</th>
  </tr>';
	$imagen = new Media();
	$user = new Usuario();
	$allusers = $user->getAll();
	$i = 0;
	$max = sizeof($allusers);
	while($i < $max){
		$user->setId($allusers[$i]['id']);
		$userid = $user->getId();
		$username = $user->getUser();
		$usernombre = $user->getNombre();
		$userapellido = $user->getApellido();
		$useremail = $user->getEmail();
		if($user->getPrivilegio() == "1"){
			$userprivilegio = "Administrador";
		}
		else{
			$userprivilegio = "Usuario Normal";
		}
		$imagen->setId($allusers[$i]['img']);
		$imagenurl = $imagen->getUrl();
		echo'<tr>
			<td>
				<ul>
					<li>
						<form method="post">
						<input type="hidden" name="id" value="'.$allusers[$i]['id'].'">
						<input name="editar" type="hidden">
						<i class="fa fa-pencil" onclick="this.parentNode.submit();"></i>
						</form>
					</li>
					<li>
						<form method="post">
						<input type="hidden" name="id" value="'.$allusers[$i]['id'].'">
						<input name="eliminar" type="hidden">
						<i class="fa fa-times" onclick="this.parentNode.submit();"></i>
						</form>
					</li>
				</ul>
			</td>
    		<td>'.$userid.'</td>
    		<td style="background-image: url('."'".$imagenurl."'".');"></td>
    		<td>'.$username.'</td>
    		<td>'.$usernombre.'</td>
    		<td>'.$userapellido.'</td>
    		<td>'.$useremail.'</td>
    		<td>'.$userprivilegio.'</td>
  		</tr>';
		$i++;
	}
echo '</table></section>';
}
?>

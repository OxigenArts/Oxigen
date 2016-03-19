<?php
/*
* Modulo: Sesion
* Version: 0.1A
* Dependencias:
* --Database.
* --Usuarios.
* Manejador de Sesiones de usuario.
* 
*/
class Sesion extends Database {
	private $id, $user, $pass;
	public function __construct() {
		if (session_status() == PHP_SESSION_NONE) {
    		session_start();

		}
	}
	public function setUser($user){
		$this->user = $user;
	}
	public function setPass($pass){
		$this->pass = sha1($pass);
	}
	public function getId(){
		if(isset($_SESSION['id'])){
			return $_SESSION['id'];
		}
		else{
			return false;
		}

	}
	public function Conectar(){
		require_once 'classes/usuarios.php';
		$usr = new Usuario();
		if($reg = parent::Select("id,pass",$usr->getTable(),"usuario",$this->user)){
			if($reg[1] = $this->pass){
				$this->Iniciar($reg[0]);
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}	
	
	public function Iniciar($id){
		$_SESSION['conected'] = true;
		$_SESSION['id'] = $id;
	}
	public function Cerrar(){
		if(isset($_SESSION['conected'])){
			$_SESSION['conected'] = null;
			$_SESSION['id'] = null;
		}
	}
	public function Verificar(){
		if(isset($_SESSION['conected']) && $_SESSION['conected'] == true){
			return true;
		}
		else{
			return false;
		}
	}
}
?>
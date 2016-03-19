<?php
/*
* Modulo: SeccionAdmin
* Version: 0.1A
* Dependencias:
* --Database.
*
* Manejador de Secciones en el panel de Administracion.
*/
class SeccionAdmin extends Database {
	private $id, $titulo, $archivo,$padre;
	private $table;
	private $datos = array();
	public function __construct() {
		$this->table = "secadm";
		if(parent::Create($this->table,
		"id INT UNSIGNED AUTO_INCREMENT, titulo VARCHAR(128), archivo VARCHAR(128), privilegio INT, padre INT, PRIMARY KEY(id)")){
			return true;
		}
		else{
			return false;
		}
	}
	public function getTable(){
		return $this->table;
	}
	public function getAll(){
		return parent::SelectAll("*",$this->table);
	}
	public function setId($id){
		$this->id = $id;
		$this->datos = parent::Select("*",$this->table,"id",$id);
		$this->titulo = $this->datos[1];
		$this->archivo = $this->datos[2];
		$this->padre = $this->datos[3];
	}
	public function getId(){
		if($this->id != null){
			return $this->id;
		}
		else{
			return false;
		}
	}
	public function getTitulo(){
		if($this->titulo != null){
			return ($this->titulo);
		}
		else{
			return false;
		}
	}
	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}
	public function getArchivo(){
		if($this->archivo != null){
			return $this->archivo;
		}
		else{
			return false;
		}
	}
	public function setArchivo($archivo){
		$this->archivo = $archivo;
	}
	public function getPadre(){
		if($this->padre != null){
			return $this->padre;
		}
		else{
			return false;
		}
	}
	public function setPadre($padre){
		$this->padre = $padre;
	}
	public function Save(){
		return parent::Insert($this->table,array("titulo" => $this->titulo, "archivo" => $this->archivo));
	}
	public function Actualizar(){
		if($this->id != null){
			return parent::Update($this->table,array("titulo" =>$this->titulo,"archivo" =>$this->archivo),"id",$this->id);
		}
		else{
			return false;
		}
	}
	public function Eliminar(){
		if($this->id != null){
			return parent::Delete($this->table,"id",$this->id);
		}
		else {
			return flase;
		}
	}
}
?>

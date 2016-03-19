<?php
/*
* Modulo: Pagina
* Version: 0.1A
* Dependencias:
* --Database.
*
* Manejador de Posts.
*/
class Pagina extends Database {
	private $id, $titulo, $contenido;
	private $table;
	private $datos = array();
	public function __construct() {
		$this->table = "paginas";
		if(parent::Create($this->table,
		"id INT UNSIGNED AUTO_INCREMENT,titulo VARCHAR(128),contenido TEXT,PRIMARY KEY(id)")){
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
		if($this->datos != false){
			$this->titulo = $this->datos[1];
			$this->contenido = $this->datos[2];
			return true;
		}
		else{
			return false;
		}
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
			return $this->titulo;
		}
		else{
			return false;
		}
	}
	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}
	public function getContenido(){
		if($this->contenido != null){
			return ($this->contenido);
		}
		else{
			return false;
		}
	}
	public function setContenido($contenido){
		$this->contenido = $contenido;
	}
	public function Save(){
		return parent::Insert($this->table,array("titulo" => $this->titulo,"contenido" => $this->contenido));
	}
	public function Actualizar(){
		if($this->id != null){
			return parent::Update($this->table,array("titulo" =>$this->titulo,"contenido" =>$this->contenido),"id",$this->id);
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

<?php
/*
* Modulo: Comentario_box
* Version: 0.1A
* Dependencias:
* --Box.
* --Usuario.
*
* Manejador de Comentarios en Boxs para Deua.
*/
class Comentario_box extends Database {
	private $id,$contenido, $autor, $box_id;
	private $table;
	private $datos = array();
	public function __construct() {
		$this->table = "comentarios_boxs";
		if(parent::Create($this->table,
		"id INT UNSIGNED AUTO_INCREMENT,contenido TEXT,	autor INT,box_id INT,PRIMARY KEY(id)")){
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
			$this->contenido = $this->datos[1];
			$this->autor = $this->datos[2];
			$this->box_id = $this->datos[3];
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
	public function getContenido(){
		if($this->contenido != null){
			return $this->contenido;
		}
		else{
			return false;
		}
	}
	public function setContenido($contenido){
		$this->contenido = $contenido;
	}
	public function getAutor(){
		if($this->autor != null){
			return $this->autor;
		}
		else{
			return false;
		}
	}
	public function setAutor($autor){
		$this->autor = $autor;
	}
	public function getBox(){
		if($this->box_id != null){
			return $this->box_id;
		}
		else{
			return false;
		}
	}
	public function setBox($box_id){
		$this->box_id = $box_id;
	}
	public function Save(){
		return parent::Insert($this->table,array("contenido" => $this->contenido,"autor" => $this->autor,"box_id" => $this->box_id));
	}
	public function Actualizar(){
		if($this->id != null){
			return parent::Update($this->table,array("contenido" => $this->contenido,"autor" => $this->autor,"box_id" => $this->box_id),"id",$this->id);
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

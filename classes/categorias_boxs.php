<?php
/*
* Modulo: Categoria_box
* Version: 0.1A
* Dependencias:
* --Database.
* --Imagen.
* --Usuario.
*
* Manejador de categorias de boxs para Deuan.
*/
class Categoria_box extends Database {
	private $id, $titulo;
	private $table;
	private $datos = array();
	public function __construct() {
		$this->table = "categorias_boxs";
		if(parent::Create($this->table,
		"id INT UNSIGNED AUTO_INCREMENT,titulo VARCHAR(256),PRIMARY KEY(id)")){
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
	public function Save(){
		return parent::Insert($this->table,array("titulo" => $this->titulo));
	}
	public function Actualizar(){
		if($this->id != null){
			return parent::Update($this->table,array("titulo" =>$this->titulo),"id",$this->id);
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

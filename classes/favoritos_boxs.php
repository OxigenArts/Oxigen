<?php
/*
* Modulo: Favorito_box
* Version: 0.1A
* Dependencias:
* --Box.
* --Usuario.
*
* Manejador de Posts.
*/
class Favorito_box extends Database {
	private $id, $box_id, $user_id;
	private $table;
	private $datos = array();
	public function __construct() {
		$this->table = "favoritos_boxs";
		if(parent::Create($this->table,
		"id INT UNSIGNED AUTO_INCREMENT,box_id INT,user_id INT,PRIMARY KEY(id)")){
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
			$this->box_id = $this->datos[1];
			$this->user_id = $this->datos[2];
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
	public function getUser(){
		if($this->user_id != null){
			return $this->user_id;
		}
		else{
			return false;
		}
	}
	public function setUser($user_id){
		$this->user_id = $user_id;
	}
	public function Save(){
		return parent::Insert($this->table,array("box_id" => $this->box_id,"user_id" => $this->user_id));
	}
	public function Actualizar(){
		if($this->id != null){
			return parent::Update($this->table,array("box_id" => $this->box_id,"user_id" => $this->user_id),"id",$this->id);
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

<?php
/*
* Modulo: Box
* Version: 0.1A
* Dependencias:
* --Database.
* --Imagen.
*
* Manejador de Boxs para Deuan.
*/
class Box extends Database {
	private $id, $titulo, $link,$categoria,$img;
	private $table;
	private $datos = array();
	public function __construct() {
		$this->table = "boxs";
		if(parent::Create($this->table,
		"id INT UNSIGNED AUTO_INCREMENT,titulo VARCHAR(128),link VARCHAR(512), categoria INT,img INT,PRIMARY KEY(id)")){
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
			$this->link = $this->datos[2];
			$this->categoria = $this->datos[3];
			$this->img = $this->datos[4];
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
	public function getLink(){
		if($this->link != null){
			return $this->link;
		}
		else{
			return false;
		}
	}
	public function setLink($link){
		$this->link = $link;
	}
	public function getCategoria(){
		if($this->categoria != null){
			return $this->categoria;
		}
		else{
			return false;
		}
	}
	public function setCategoria($categoria){
		$this->categoria = $categoria;
	}
	public function getImagen(){
		if($this->img != null){
			return $this->img;
		}
		else{
			return false;
		}
	}
	public function setImagen($img){
		if(!empty($img)){
			$this->img = $img;
		}
	}
	public function Save(){
		return parent::Insert($this->table,array("titulo" => $this->titulo,"link" => $this->link,"categoria" => $this->categoria,"img" => $this->img));
	}
	public function Actualizar(){
		if($this->id != null){
			return parent::Update($this->table,array("titulo" => $this->titulo,"link" => $this->link,"categoria" => $this->categoria,"img" => $this->img),"id",$this->id);
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

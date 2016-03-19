<?php
/*
* Modulo: Config
* Version: 0.1A
* Dependencias:
* --Database.
*
* Manejador para configuraciones generales del sitio.
*/
class Config extends Database {
	private $id;
	private $table;
	private $datos = array();
	public function __construct() {
		$this->table = "config";
		if(parent::Create($this->table,"id INT UNSIGNED AUTO_INCREMENT,cfg_name VARCHAR(128),cfg_value LONGTEXT,PRIMARY KEY(id)")){
			return true;
		}
		else{
			return false;
		}

	}
	public function getTable(){
		return $this->table;
	}
	public function getCfg($cfg_name){
		return parent::Select("cfg_value",$this->table,"cfg_name",$cfg_name)[0];
	}
	public function setCfg($cfgs){
		foreach ($cfgs as $name => $value) {
			if(!parent::Update($this->table,array("cfg_value" => $value),"cfg_name",$name)){
				return false;
			}
		}
		return true;
	}
	public function newCfg($cfgs){
		return parent::Insert($this->table,$cfgs);
	}
	public function Actualizar(){//a los nuevos metodos
		if($this->id != null){
			return parent::Update($this->table,array("titulo" =>$this->titulo,"nombre" =>$this->nombre,"img" =>$this->logo,"descripcion" =>$this->descripcion,"tema" =>$this->tema,"url" =>$this->url),"id",$this->id);
		}
		else{
			return false;
		}
	}
}
?>

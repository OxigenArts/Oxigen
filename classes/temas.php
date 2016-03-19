<?php
/*
* Modulo: Tema
* Version: 0.1A
* Dependencias:
* --Database.
* --
* Manejador de Temas.
*/
class Tema extends Database {
	private $id, $titulo, $descripcion, $autor,$fecha, $carpeta;
	private $table,$tablecfg;
	private $datos = array();
	public function __construct() {
		$this->table = "temas";
		$this->tablecfg = "cfgtemas";
		$create1 = parent::Create($this->table,"id INT UNSIGNED AUTO_INCREMENT,titulo VARCHAR(128),descripcion VARCHAR(128),autor VARCHAR(128),fecha DATE,carpeta VARCHAR(64),PRIMARY KEY(id),UNIQUE KEY `carpeta` (`carpeta`)");
		$create2 = parent::Create($this->tablecfg,"id INT UNSIGNED AUTO_INCREMENT,tema_id VARCHAR(128),cfg_name VARCHAR(128),cfg_value LONGTEXT,PRIMARY KEY(id)");
		if($create1 != true || $create2 != true){
			return false;
		}
		else{
			return true;
		}
	}
	public function getTable(){
		return $this->table;
	}
	public function getTableCfg(){
		return $this->tablecfg;
	}
	public function getAll(){
		return parent::SelectAll("*",$this->table);
	}
	public function setId($id){
		$this->id = $id;
		$this->datos = parent::Select("*",$this->table,"id",$id);
		$this->titulo = $this->datos[1];
		$this->descripcion = $this->datos[2];
		$this->autor = $this->datos[3];
		$this->fecha = $this->datos[4];
		$this->carpeta = $this->datos[5];
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
	public function getDescripcion(){
		if($this->descripcion != null){
			return ($this->descripcion);
		}
		else{
			return false;
		}
	}
	public function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	public function getAutor(){
		if($this->autor != null){
			return ($this->autor);
		}
		else{
			return false;
		}
	}
	public function setAutor($autor){
		$this->autor = $autor;
	}
	public function getFecha(){
		if($this->fecha != null){
			return $this->fecha;
		}
		else{
			return false;
		}
	}
	public function setFecha($fecha){
		$this->fecha = $fecha;
	}
	public function getCarpeta(){
		if($this->carpeta != null){
			return ($this->carpeta);
		}
		else{
			return false;
		}
	}
	public function setCarpeta($carpeta){
		$this->carpeta = $carpeta;
	}
	public function getCfg($cfg_name){
		require_once 'classes/config.php';
		$conf = new Config();
		$tema_actual = $conf->getCfg("tema");
		return parent::Select("cfg_value",$this->tablecfg,"cfg_name",$cfg_name,"=","tema_id",$tema_actual)[0];
	}
	public function setCfg($cfgs){
		return parent::Update($this->tablecfg,$cfgs);
	}
	public function newCfg($cfgs){
		return parent::Insert($this->tablecfg,$cfgs);
	}
	public function Save(){
		return parent::Insert($this->table,array("titulo" => $this->titulo,"descripcion" => $this->descripcion,"autor" => $this->autor,"fecha" => $this->fecha,"carpeta" => $this->carpeta));
	}
	public function Update(){
		if($this->id != null){
			return parent::Update($this->table,array("titulo" =>$this->titulo,"descripcion" =>$this->descripcion,"autor" =>$this->autor,"fecha" =>$this->fecha,"carpeta" =>$this->carpeta),"id",$this->id);
		}
		else{
			return false;
		}
	}
	public function Delete(){
		if($this->id != null){
			if(parent::Delete($this->table,"id",$this->id) && parent::Delete($this->tablecfg,"tema_id",$this->id)){
				if(!empty($this->carpeta)){
					$ruta = "vistas/temas/".$this->carpeta;
					if(file_exists($ruta)){
						require_once('classes/archivos.php');
						if(Archivos::eliminarDir($ruta)){
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
				else{
					return false;
				}
			}
			else{
				return false;
			}
		}
		else {
			return flase;
		}
	}
	public function Instalar($file){
		require_once 'classes/archivos.php';
		Archivos::eliminarDir("temp/");
		Archivos::descomprimir($file,"temp/");
		if(file_exists('temp/config.csv')){
			$configs = Archivos::csvArray("temp/config.csv");
			$carpeta = $configs["tema_carpeta"];
			if(!file_exists("vistas/temas/$carpeta")){
				try{
					Archivos::moverDir("temp/","vistas/temas/$carpeta");
					$this->setTitulo($configs['tema_titulo']);
					$this->setAutor($configs['tema_autor']);
					$this->setDescripcion($configs['tema_descripcion']);
					$this->setFecha($configs['tema_fecha']);
					$this->setCarpeta($carpeta);
					$this->Save();
					$tema_id = parent::Select("id",$this->table,"carpeta",$carpeta)[0];
					unset($configs['tema_titulo']);
					unset($configs['tema_autor']);
					unset($configs['tema_descripcion']);
					unset($configs['tema_fecha']);
					unset($configs['tema_carpeta']);
					foreach ($configs as $key => $value) {
						parent::Insert($this->tablecfg,array("tema_id" => $tema_id,"cfg_name" => $key,"cfg_value" => $value));
					}
					return true;
				}
				catch(Exception $e){
					Archivos::eliminarDir("temp/");
					return false;
				}
			}
			else{
				Archivos::eliminarDir("temp/");
				return false;
			}
		}
		else{
			Archivos::eliminarDir("temp/");
			return false;
		}
	}
}
?>

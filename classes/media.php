<?php
/*
* Modulo: Imagen
* Version: 0.2A
* Dependencias:
* --Database.
* --Config.
* Manejador de archivos multimedia.
*/
class Media extends Database {
	private $id, $ruta;
	private $table;
	private $datos = array();
	public function __construct() {
		$this->table = "media";
		if(parent::Create($this->table,
		"id INT UNSIGNED AUTO_INCREMENT,url VARCHAR(512),PRIMARY KEY(id)")){
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
		$this->ruta = $this->datos[1];
	}
	public function getId(){
		return $this->id;
	}
	public function getUrl(){
		require_once 'classes/config.php';
		$c = new Config();
		if($this->ruta != null){
			return $c->getCfg("url").$this->ruta;
		}
		else{
			return false;
		}
	}
	public function getType($file) {
		$av = array('imagen' => array("image/jpg", "image/jpeg", "image/gif", "image/png"), 'video' => array("video/x-flv", "video/mp4", "	video/3gpp"), 'audio' => array("audio/mpeg"));
		$type = $file['type'];
		if (in_array($type, $av['imagen'])) {
			return "imagen";
		} else if (in_array($type, $av['video'])) {
			return "video";
		} else if (in_array($type, $av['audio'])) {
			return "audio";
		}
		return false;
	}
	public function Subir($file){
		if ($file["error"] > 0){
			return false;
		}
		else {
			$permitidos = array('imagen', 'video', 'audio');
			$limite_kb = 10;//MB//tamaño
			$type = $this->getType($file);
			if (in_array($type, $permitidos)) {
				$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
				$newname = sha1($file['name'].rand()).".$ext";
				if (in_array($file['size'] <= $limite_kb_img * 1024000){
					$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
					$newname = sha1($file['name'].rand()).".$ext";
					$ruta = "media/$type/$newname";
					if (@move_uploaded_file($file["tmp_name"], $ruta)){
						if(parent::Insert($this->table,array("url" => $ruta))){
							$datos = parent::Select("*",$this->table,"url",$ruta);
							if($datos != false){
								$this->id = $datos[0];
								$this->ruta = $datos[1];
								return array($this->getId(),$this->getUrl(), $type);
						}
					}
				}
			}
		}
	}
	return false;
}
	public function Eliminar(){
		if($this->id != null){
			if(parent::Delete($this->table,"id",$this->id)) {
				unlink($this->ruta);
				return true;
			} else {
				return false;
			}
		}
		else {
			return flase;
		}
	}
}
?>

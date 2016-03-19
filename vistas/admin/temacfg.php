<?php
require_once 'classes/temas.php';
require_once 'classes/config.php';
$cfg = new Config();
$tema = new Tema();
$tema->setId($cfg->getCfg("tema"));
$file = "vistas/temas/".$tema->getCarpeta()."/cfg.php";
if(file_exists($file)){
	include $file;
}
else{
	echo'<span class="error">Este tema no tiene archivo de configuración.</span>';
}

?>
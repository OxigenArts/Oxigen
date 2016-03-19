<?php
require_once 'classes/config.php';
require_once 'classes/sesiones.php';
$sesion = new Sesion();
$conf = new Config();
$sesion->Cerrar();
header("location: ".$conf->getCfg("url")."login");
?>
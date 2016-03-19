<?php
require_once 'classes/sesiones.php';
$sesion = new Sesion();
$sesion->Cerrar();
$sesion->setUser("demo");
$sesion->setPass("demo");
$sesion->Conectar();
?>
<a href="http://localhost/poo/admin">INGRESAR</a>
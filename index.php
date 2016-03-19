<?php
require_once 'classes/mysql.php';
require_once 'classes/enrutador.php';
require_once 'classes/config.php';
require_once 'classes/temas.php';
if(isset($_REQUEST['route'])){
	$route_get = $_REQUEST['route'];
}
else{
	$route_get = "";
}
$cfg = new Config();
$t = new Tema();
$t->setId($cfg->getCfg("tema"));
$tema = $t->getCarpeta();
$r = new Rutas($route_get);
$r->agregarRuta("admin","admin/index");
$r->agregarRuta("admin/$","admin/index");
$r->agregarRuta("","temas/".$tema."/index");
$r->agregarRuta("post","temas/".$tema."/index");
$r->agregarRuta("post/$","temas/".$tema."/post");
$r->agregarRuta("page","temas/".$tema."/index");
$r->agregarRuta("page/$","temas/".$tema."/page");
$r->agregarRuta("login","admin/login");
$r->agregarRuta("logout","logout");
$r->agregarRuta("reg","admin/reg");
$r->Start();
?>

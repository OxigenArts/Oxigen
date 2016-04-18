<?php
require_once 'classes/config.php';
require_once 'classes/temas.php';
$cfg = new Config();
$t = new Tema();
$t->setId($cfg->getCfg("tema"));
return array(
    ""      =>"temas/".$tema."/index",
    "post"      =>"temas/".$tema."/index",
    "post/$"      =>"temas/".$tema."/post"
    );
?>

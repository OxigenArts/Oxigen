<?php
/*
* Modulo: Rutas
* Version: 0.1A
* Dependencias:
* --Sin dependencias.
* 
* Enrutador.
*/
class Rutas{
	private $g_route;
	private $rutas = array();
	function __construct($route){
		$this->g_route = $route;
	}
	function agregarRuta($ruta,$vista){
		$this->rutas[$ruta] = $vista;
	}
	function Start(){
		$b = false;
		foreach ($this->rutas as $ruta => $vista) {
			if(strpos($ruta,"$") !== false){
				$rutawo = preg_split("/[$]+/", $ruta, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE)[0];
				if(strpos($this->g_route,$rutawo) === 0){
				$rutaid = split($rutawo,$this->g_route)[1];
					$this->mostrarVistaGet($vista,$rutaid);
					$b= true;
					break;
				}
			}

			if($this->g_route == $ruta || $this->g_route == $ruta.'/'){
				$this->mostrarVista($vista);
				$b= true;
				break;
			}
		}
		if(!$b){
			$this->mostrarVista("404");
		}
	}
	function mostrarVista($vista){
		include("vistas/".$vista.".php");
	}
	function mostrarVistaGet($vista,$get){
		$_GET['id'] = $get;
		include("vistas/".$vista.".php");
	}
}
?>
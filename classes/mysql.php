<?php
/*
* Modulo: Database
* Version: 0.1A
* Dependencias:
* --Sin dependencias.
* 
* Manejador de Mysqli.
*/
class Database {
	private $host, $user, $pass, $database;
	public function __construct() {	
	}
	public function conexion(){
		$db_cfg = require 'config/database.php';
		$this->host=$db_cfg['host'];
		$this->user=$db_cfg['user'];
		$this->pass=$db_cfg['pass'];
		$this->database=$db_cfg['database'];
		$con = new mysqli($this->host,$this->user,$this->pass,$this->database);
		$con->query("SET NAMES 'utf8'");
		return $con;
	}
	public function SelectAll($select, $from,$where = "1", $where2 = "1",$condicion = "=") {
		$con = $this->conexion();
		$select = $con->real_escape_string($select);
		$from = $con->real_escape_string($from);
		$where = $con->real_escape_string($where);
		$where2 = $con->real_escape_string($where2);
		$result = $con->query("SELECT $select FROM $from WHERE $where $condicion '$where2'");
		$i = 0;
		$datos = array();
		while($row = $result->fetch_assoc()) 
		{
			$datos[$i] = $row;
			$i++;
		}
		if($i>0){
			return $datos;
		}
		else{
			return false;
		}
		mysqli_close($con);
	}
	public function Select($select, $from, $where = "1", $where2 = "1",$condicion = "=",$where3 = "1",$where4 = "1",$condicion2 = "=") {
		$con = $this->conexion();
		$select = $con->real_escape_string($select);
		$from = $con->real_escape_string($from);
		$where = $con->real_escape_string($where);
		$where2 = $con->real_escape_string($where2);
		if($where3 == "1"){
		$result = $con->query("SELECT $select FROM $from WHERE $where $condicion '$where2'");
		}
		else{
		$result = $con->query("SELECT $select FROM $from WHERE $where $condicion '$where2' AND $where3 $condicion2 '$where4'");
		}
		if($reg = $result->fetch_row()){
			mysqli_close($con);
			return $reg;
		}
		else{
			mysqli_close($con);
			return false;
		}
		mysqli_close($con);
	}
	public function Create($table, $campos) {
		$con = $this->conexion();
		$table = $con->real_escape_string($table);
		$campos = $con->real_escape_string($campos);
		$result = $con->query("show tables like '$table'");
		if($result->fetch_row() == false){
			if($con->query(
			"CREATE TABLE $table ($campos)")){
				mysqli_close($con);
				return true;
			}
			else{
				mysqli_close($con);
				return false;
			}
		}
		else{
			mysqli_close($con);
			return false;
		}
	}
	public function Insert($table, $values) {
		$con = $this->conexion();
		$table = $con->real_escape_string($table);
		$q_keys = "";//esto es para almacenar esto
		$q_values = "";//y esto para almacenar esto
		foreach ($values as $key => $value) {
			$key = $con->real_escape_string($key);
			$value = $con->real_escape_string($value);
			$q_keys.= $key.',';
			$q_values.="'".htmlentities($value)."',";
		}
		$q_keys = trim($q_keys, ',');
		$q_values = trim($q_values, ',');
		
		if($con->query("INSERT INTO $table ($q_keys) values ($q_values)")){
			mysqli_close($con);
			return true;
		}
		else{
			mysqli_close($con);
			return false;
		}
	}
	public function Update($update, $values, $where = "1", $where2 = "1") {
		$con = $this->conexion();
		$update = $con->real_escape_string($update);
		$where = $con->real_escape_string($where);
		$where2 = $con->real_escape_string($where2);
		$q_values = "";
		foreach ($values as $key => $value) {
			$key = $con->real_escape_string($key);
			$value = $con->real_escape_string($value);
			$q_values.=$key."='".htmlentities($value)."',";
		}
		$q_values = trim($q_values, ',');

		if($con->query("UPDATE $update SET $q_values WHERE $where = '$where2'")){
			mysqli_close($con);
			return true;
		}
		else{
			mysqli_close($con);
			return false;
		}
	}
	public function Delete($from, $where = "1", $where2 = "1") {
		$con = $this->conexion();
		$from = $con->real_escape_string($from);
		$where = $con->real_escape_string($where);
		$where2 = $con->real_escape_string($where2);
		if($con->query("DELETE FROM $from WHERE $where = '$where2'")){
			mysqli_close($con);
			return true;
		}
		else{
			mysqli_close($con);
			return false;
		}
	}
}
?>

<?php
session_start();
require_once("../../conexion.php");


$cliente1=$_POST["cliente1"];
$ci_nit1=$_POST["ci_nit1"];
$telefono1=$_POST["telefono1"];
$direccion1=$_POST["direccion1"];
$residencia1=$_POST["residencia1"];

$reg = array();
$reg["empresaID"] = 1;
$reg["cliente"] = $cliente1;
$reg["ci_nit"] = $ci_nit1;
$reg["telefono"] = $telefono1;
$reg["direccion"] = $direccion1;
$reg["residencia"] = $residencia1;



$reg["_fec_insercion"] = date("Y-m-d H:i:s");
$reg["_estado"] = 'A';
$reg["_usuario"] = $_SESSION["sesion_id_usuario"];   
$rs1 = $db->AutoExecute("clientes", $reg, "INSERT"); 
?>
<?php
session_start();
require_once("../../conexion.php");
// require_once("../../libreria_menu.php"); por si acaso

// Recibir los datos del formulario
$paqueteID = $_POST["paqueteID"];
$tiposervicioID = $_POST["tiposervicioID"];
$clienteID = $_POST["clienteID"];
$remitente = $_POST["remitente"];
$telefono_remitente = $_POST["telefono_remitente"];
$origen = $_POST["origen"];
$destinatario = $_POST["destinatario"];
$telefono_destino = $_POST["telefono_destino"];
$destino = $_POST["destino"];
$direccion_destino = $_POST["direccion_destino"];
$peso = $_POST["peso"];
$fecha = $_POST["fecha"];
$precio = $_POST["precio"];
$descripcion = $_POST["descripcion"];
$num_guia = $_POST["num_guia"];


$reg = array();
$reg["tiposervicioID"] = $tiposervicioID;
$reg["clienteID"] = $clienteID;
$reg["remitente"] = $remitente;
$reg["telefono_remitente"] = $telefono_remitente;
$reg["origen"] = $origen;
$reg["destinatario"] = $destinatario;
$reg["telefono_destino"] = $telefono_destino;
$reg["destino"] = $destino;
$reg["direccion_destino"] = $direccion_destino;
$reg["peso"] = $peso;
$reg["fecha"] = $fecha;
$reg["precio"] = $precio;
$reg["descripcion"] = $descripcion;
$reg["num_guia"] = $num_guia;
$reg["_usuario"] = $_SESSION["sesion_id_usuario"];


$rs1 = $db->AutoExecute("paquetes", $reg, "UPDATE", "paqueteID='".$paqueteID."'");


header("Location: paquetes.php");
exit();
?>

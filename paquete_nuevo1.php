<?php
session_start();
require_once("../../conexion.php");

$db->debug = true;

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";

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
$reg["_fec_insercion"] = date("Y-m-d H:i:s");
$reg["_estado"] = 'A';
$reg["_usuario"] = $_SESSION["sesion_id_usuario"];

$rs1 = $db->AutoExecute("paquetes", $reg, "INSERT");

header("Location: paquetes.php");
exit();

echo "</body>
      </html>";
?>

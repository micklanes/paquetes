<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$cliente = $_POST["cliente"];
$ci_nit = $_POST["ci_nit"];


//$db->debug=true;

if ($cliente || $ci_nit) {
    $sql3 = $db->Prepare("SELECT    *
                          FROM      clientes
                          WHERE     cliente LIKE ?
                          AND       ci_nit LIKE ?
                          AND       _estado <> 'X'
                          ");
    $rs3 = $db->GetAll($sql3, array($cliente."%", $ci_nit."%"));
    if ($rs3) {
        echo "<center>
              <table width='60%' border='1'>
              <tr>
                  <th>CLIENTE</th></ br><th>C.I. o N.I.T.</th>
              </tr>";
        foreach ($rs3 as $k => $fila) {
            $str1 = $fila["cliente"];
            $str2 = $fila["ci_nit"];

            echo "<tr>

                  <td >".resaltar($cliente, $str1)."</td>
                  <td>".resaltar($ci_nit, $str2)."</td>

                  <td align='center'>
                      <input type='radio' name='opcion' value='' onClick='buscar_persona(".$fila["clienteID"].")'>
                  </td> 
              </tr>";
        }
        echo "</table>
              </center>";
    } else {
        echo "<center><b> LA PERSONA NO EXISTE!!</b></center><br>";
        echo "<center>
              <table class='listado'>
              <tr>
                  <td><b>(*)Cliente:</b></td>
                  <td><input type='text' name='cliente1' value='' placeholder='CARNET DE IDENTIDAD' size='20' onkeyup='this.value=this.value.toUpperCase()'></td>
              </tr>
              <tr>
                  <td><b>C.I. o N.I.T.:</b></td>
                  <td><input type='text' name='ci_nit1' value='' placeholder='PATERNO' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
              </tr>
              <tr>
                  <td><b>Telefono:</b></td>
                  <td><input type='text' name='telefono1' value='' placeholder='MATERNO' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
              </tr>
              <tr>
                  <td><b>Dirección:</b></td>
                  <td><textarea name='direccion1' rows='4' cols='20' onkeyup='this.value=this.value.toUpperCase()'></textarea></td>
              </tr>
              <tr>
                  <td><b>Residencia:</b></td>
                  <td><input type='text' name='residencia1' value='' placeholder='DIRECCIÓN' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
              </tr>
              <tr>
                  <td align='center' colspan='2'>
                      <input type='button' value='AGREGAR PERSONA' onClick='insertar_persona()'>
                  </td>
              </tr>
              </table>
              </center>";
    }
}
?>

<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$clienteID=$_POST["clienteID"];


$sql3=$db->Prepare("SELECT  *
                    FROM    clientes
                    WHERE   clienteID = ?
                    AND     _estado <> 'X'
                ");
$rs3=$db->GetAll($sql3, array($clienteID));

echo"<center>
        <table width='60%'' border='1'>
            <tr>
                <th colspan='4'>Cliente</th>
            </tr>
    ";
foreach($rs3 as $k=>$fila){
    echo "<tr>
            <td>".$fila['cliente']."</td>
            <td>".$fila['ci_nit']."</td>
           </tr>";
}
echo"</table>
    </center>";

$sql4=$db->Prepare("SELECT  *
                    FROM    paquetes
                    WHERE   clienteID = ?
                    AND     _estado <> 'X'
                    ");
$rs4=$db->GetAll($sql4, array($clienteID));

echo"<center>
        <table width='60%'' border='1'>
            <tr>
                <th colspan='4'>Paquetes</th>
            </tr>
    ";
    if($rs4){
        foreach($rs4 as $k  =>$fila ){
            echo"<tr>
                    <td align='center'>".$fila["remitente"]."</td>
                </tr>";
        }}else
        echo"</tr>
                <td align='center'>NO TIENE PAQUETES</td>
            </tr>";
echo"</table>
</center>";

?>
    
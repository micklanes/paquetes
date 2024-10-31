<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$num_guia = $_POST["num_guia"];
$destinatario = $_POST["destinatario"];
$destino = $_POST["destino"];
$estado = $_POST["estado"];

//$db->debug=true;
if ($num_guia or $destinatario or $destino or $estado){
    $sql3 = $db->Prepare("      SELECT  *
                                FROM    paquetes 
                                WHERE   num_guia LIKE ?
                                AND     destinatario LIKE ?
                                AND     destino LIKE ?
                                AND     estado LIKE ?
                                AND     _estado <> 'X'
    ");
    $rs3 = $db->GetAll($sql3, array($num_guia."%", $destinatario."%", $destino."%", $estado."%"));
    if ($rs3) {
        echo"<div class='table-responsive'>
         <table class='table table-striped'>
              <thead>
            <tr>
                <th scope='col'>N° Guia</th>
                <th scope='col'>DESTINATARIO</th>
                <th scope='col'>DESTINO</th>
                <th scope='col'>ESTADO</th>
                <th scope='col'><img src='../../imagenes/modificar.gif'></th>
                <th scope='col'><img src='../../imagenes/borrar.jpeg'></th>
            </tr>
            </thead>
            <tbody>";
        foreach ($rs3 as $k => $fila) {
            $str1 = $fila["num_guia"];
            $str2 = $fila["destinatario"];
            $str3 = $fila["destino"];
            $str4 = $fila["estado"];

            echo"<tr>
                <td>".resaltar($num_guia, $str1)."</td>
                <td>".resaltar($destinatario, $str2)."</td>
                <td>".resaltar($destino, $str3)."</td>
                <td>".resaltar($estado, $str4)."</td>
                <td>
                    <form name='formModif".$fila["paqueteID"]."' method='post' action='paquete_modificar.php' style='display:inline;'>
                        <input type='hidden' name='paqueteID' value='".$fila['paqueteID']."'>
                        <a href='javascript:document.formModif".$fila['paqueteID'].".submit();' title='Modificar Paquete Sistema'>
                            Modificar>>
                        </a>
                    </form>
                </td>
                <td align='center'>
                    <form name='formElimi".$fila["paqueteID"]."' method='post' action='paquete_eliminar.php' style='display:inline;'>
                        <input type='hidden' name='paqueteID' value='".$fila["paqueteID"]."'>
                        <a href='javascript:document.formElimi".$fila['paqueteID'].".submit();' title='Eliminar Paquete Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar al paquete ".$fila["num_guia"]." ".$fila["destinatario"]." ?\"))'; 
                        location.href='paquete_eliminar.php''>
                            Eliminar>>
                        </a>
                    </form>
                </td>
            </tr>";
        }
    echo"
    </tbody>
    </table>
    </div>";
} else {
    echo"<center><b> EL PAQUETE NO EXISTE!!</b></center><br>";
}
}
?>

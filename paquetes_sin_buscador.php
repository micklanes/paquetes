<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../libreria_menu.php");

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";
       contarRegistros($db, "paquetes");
       paginacion("paquetes.php?");
       $sql = $db->Prepare("SELECT     
                                      CASE
                                         WHEN cli.tipo = 'NATURAL' THEN CONCAT(cli.apellidos, ' ', cli.nombres)
                                         WHEN cli.tipo = 'JURIDICA' THEN cli.razon_social
                                       END as cliente, paq.*,cli.*,tip.*
                            FROM       clientes cli, paquetes paq, tipo_servicios tip
                            WHERE      paq.clienteID= cli.clienteID
                            AND        paq.tiposervicioID=tip.tiposervicioID
                            AND        tip._estado <> 'X'
                            AND        cli._estado <> 'X' 
                            AND        paq._estado <> 'X' 
                            ORDER BY   paq.paqueteID ASC
                           LIMIT ? OFFSET ?");
$rs = $db->GetAll($sql, array($nElem, $regIni));
if ($rs) {
    echo "<center>
              <h1>LISTA DE PAQUETES</h1>
              <b><a href='paquete_nuevo.php'>Nuevo Paquete>>>></a></b><br>
              <table align='right' class='listado'>
                <tr>
                  <th>N°</th><th>CLIENTE</th><th>DESTINATARIO</th><th>ENVIO</th><th>PRECIO</th><th>N° GUIA</th><th>ESTADO</th><th>SERVICIO</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
    $b = 0;
    $total = $pag - 1;
    $a = $nElem * $total;
    $b = $b + 1 + $a;
    foreach ($rs as $k => $fila) {                                       
        echo "<tr>
                <td align='center'>".$b."</td>
                <td>".$fila['cliente']."</td>                        
                <td>".$fila['destinatario']."</td>
                <td>".$fila['fecha']."</td>
                <td align='center'>".$fila['precio']."</td>
                <td align='center'>".$fila['num_guia']."</td>
                <td>".$fila['estado']."</td>
                <td>".$fila['tipo']."</td>
                <td align='center'>
                  <form name='formModif".$fila["paqueteID"]."' method='post' action='paquete_modificar.php'>
                    <input type='hidden' name='paqueteID' value='".$fila['paqueteID']."'>
                    <input type='hidden' name='clienteID' value='".$fila['clienteID']."'>
                     <input type='hidden' name='tiposervicioID' value='".$fila['tiposervicioID']."'>
                    <a href='javascript:document.formModif".$fila['paqueteID'].".submit();' title='Modificar Paquete Sistema'>
                      Modificar>>
                    </a>
                  </form>
                </td>
                <td align='center'>  
                  <form name='formElimi".$fila["paqueteID"]."' method='post' action='llamada_eliminar.php'>
                    <input type='hidden' name='paqueteID' value='".$fila["paqueteID"]."'>
                    <a href='javascript:document.formElimi".$fila['paqueteID'].".submit();' title='Eliminar Llamada Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar al cliente ".$fila["cliente"]." ?\"))'; location.href='paquete_eliminar.php''> 
                      Eliminar>>
                    </a>
                  </form>                        
                </td>
             </tr>";
        $b = $b + 1;
    }
    echo "</table>
          </center>";
}
mostrar_paginacion();
echo "</body>
      </html>";
?>
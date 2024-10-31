<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
//$db->debug=true;

echo "<html> 
       <head>
       <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       <script type='text/javascript' src='../js/expresiones_regulares.js'></script>
       <script type='text/javascript' src='js/validacion_paquetes.js'></script>
       <script type='text/javascript' src='../../ajax.js'></script>
       <script type='text/javascript'>
            function buscar() {
                var d1, contenedor, url;
                contenedor = document.getElementById('personas');
                contenedor2 = document.getElementById('persona_seleccionado');
                contenedor3 = document.getElementById('persona_insertada');
                d1 = document.formu.cliente.value;
                d2 = document.formu.ci_nit.value;
                ajax = nuevoAjax();
                url = 'ajax_buscar_persona.php';
                param = 'cliente='+d1+'&ci_nit='+d2;
                ajax.open('POST', url, true);
                ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                ajax.onreadystatechange = function() {
                    if (ajax.readyState == 4) {
                        contenedor.innerHTML = ajax.responseText;
                        contenedor2.innerHTML = '';
                        contenedor3.innerHTML = '';
                    }
                }
                ajax.send(param);
            }
            function buscar_persona(clienteID) {
                var d1, contenedor, url;
                contenedor = document.getElementById('persona_seleccionado');
                contenedor2 = document.getElementById('personas');
                document.formu.clienteID.value = clienteID;
                d1 = clienteID;
                
                ajax = nuevoAjax();
                url = 'ajax_buscar_persona1.php';
                param = 'clienteID='+d1;
                ajax.open('POST', url, true);
                ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                ajax.onreadystatechange = function() {
                    if (ajax.readyState == 4) {
                        contenedor.innerHTML = ajax.responseText;
                        contenedor2.innerHTML = '';
                    }
                }
                ajax.send(param);
            }

            function insertar_persona() {
                var d1, contenedor, url;
                contenedor = document.getElementById('persona_seleccionado');
                contenedor2 = document.getElementById('personas');
                contenedor3 = document.getElementById('persona_insertada');
                d1 = document.formu.cliente1.value;
                d2 = document.formu.ci_nit1.value;
                d3 = document.formu.telefono1.value;
                d4 = document.formu.direccion1.value;
                d5 = document.formu.residencia1.value;
                if (d1 == '') {
                    alert('El cliente esta vacio');
                    document.formu.cliente1.focus();
                    return;
                }
                if (d2 == '') {
                    alert('El ci o nit esta vacio');
                    document.formu.ci_nit1.focus();
                    return;
                }
                
                if (d3 == '') {
                    alert('El telefono esta vacio');
                    document.formu.telefono1.focus();
                    return;
                }
                if (d4 == '') {
                  alert('La dirección esta vacia');
                  document.formu.direccion1.focus();
                  return;
                }
                  if (d5 == '') {
                  alert('La residencia esta vacía');
                  document.formu.residencia1.focus();
                  return;
                }
       
        ajax=nuevoAjax();
        url='ajax_inserta_persona.php';
          param='cliente1='+d1+'&ci_nit1='+d2+'&telefono1='+d3+'&direccion1='+d4+'&residencia1='+d5;
          ajax.open('POST',url,true);
          ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          alert('llega');
          ajax.onreadystatechange=function(){
              if(ajax.readyState==4){
                  contenedor.innerHTML='';
                  contenedor2.innerHTML='';
                  contenedor3.innerHTML=ajax.responseText;
                  
              }
          }
          ajax.send(param);
        }
        </script>
       
       </head>
       <body>
       <p> &nbsp;</p>
         <h1 align='center'>AGREGAR PAQUETE</h1>";

$sql1 = $db->Prepare("SELECT tipo, tiposervicioID
                     FROM tipo_servicios
                     WHERE _estado = 'A'");
$rs1 = $db->GetAll($sql1);

$sql = $db->Prepare("SELECT   cliente, clienteID
                     FROM     clientes
                     WHERE    _estado = 'A'");
$rs = $db->GetAll($sql);

echo "<form action='paquete_nuevo1.php' method='post' name='formu'>";
echo "<center>
        <table class='listado'>
          <tr>
            <th>(*)Cliente</th>
              <td>
                  <table>
                    <tr>
                      <td>
                        <b>Cliente</b><br />
                        <input type='text' name='cliente' size='20' value='' placeholder='CLIENTE '  size='10' onKeyUp='buscar()'>
                      </td>
                      <td>
                        <b>C.I. o N.I.T.</b><br />
                        <input type='text' name='ci_nit' value='' size='10' onKeyUp='buscar()'>
                      </td>
                    </tr>
                  </table>
              </td>
          </tr>";
          echo"<tr>
              <td colspan='6' align='center'>
                <table width='100%'>
                  <tr>
                    <td colspan='3' align='center'>
                      <div id='personas'></div>
                    </td>
                  </tr>
                </table>
              </td>
          </tr>
          <tr>
              <td colspan='6' align='center'>
                <table width='100%'>
                  <tr>
                    <td colspan='3'>
                      <div id='persona_seleccionado'></div>
                    </td>
                  </tr>
                </table>
              </td>
          </tr>
          <tr>
              <td colspan='6' align='center'>
                <table width='100%'>
                  <tr>
                    <td colspan='3'>
                      <input type='hidden' name='clienteID'>
                      <div id='persona_insertada'></div>
                    </td>
                  </tr>
                </table>
              </td>
          </tr>";
echo "<tr>
        <th>(*)Tipo servicio</th>
        <td>
          <select name='tiposervicioID'>
            <option value=''>--Seleccione--</option>";
foreach ($rs1 as $k => $fila) {
    echo "<option value='" . $fila['tiposervicioID'] . "'>" . $fila['tipo'] . "</option>";
}
echo "</select>
        </td>
      </tr>";
echo "
      <tr>
        <th><b>(*)Remitente</b></th>
        <td><input type='text' name='remitente' size='30' onkeyup='this.value=this.value.toUpperCase()'></td>
    </tr>
      <tr>
        <th><b>(*)Telefono</b></th>
        <td><input type='text' name='telefono_remitente' size='20'></td>
      </tr>
      <tr>
        <th><b>(*)Origen</b></th>
        <td><input type='text' name='origen' size='30' onkeyup='this.value=this.value.toUpperCase()'></td>
      </tr>
      <tr>
        <th><b>(*)Destinatario</b></th>
        <td><input type='text' name='destinatario' size='20' onkeyup='this.value=this.value.toUpperCase()'></td>
      </tr>
      <tr>
        <th><b>(*)Telefono Destino</b></th>
        <td><input type='text' name='telefono_destino' size='15'></td>
      </tr>
      <tr>
        <th><b>(*)Departamento Destino</b></th>
        <td><input type='text' name='destino' size='30' onkeyup='this.value=this.value.toUpperCase()'></td>
    </tr>
      <tr>
        <th><b>(*)Direccion destino</b></th>
        <td><input type='text' name='direccion_destino' size='20' onkeyup='this.value=this.value.toUpperCase()'></td>
      </tr>
      <tr>
        <th><b>(*)Peso</b></th>
        <td><input type='text' name='peso'></td>
      </tr>
      <tr>
        <th><b>(*)Fecha</b></th>
        <td><input type='date' name='fecha'></td>
    </tr>
      <tr>
        <th><b>(*)Precio</b></th>
        <td><input type='text' name='precio'></td>
      </tr>
      <tr>
        <th><b>(*)Descripcion</b></th>
        <td><textarea name='descripcion' rows='4' cols='30' onkeyup='this.value=this.value.toUpperCase()'></textarea></td>
      </tr>
      <tr>
        <th><b>(*)N° Guia</b></th>
        <td><input type='text' name='num_guia'></td>
      </tr> 
      <tr>
        <td align='center' colspan='2'>  
          <input type='button' value='ACEPTAR' onclick='validar()'>
          <input type='reset' value='BORRAR'>
          <br>
          (*)Datos Obligatorios
        </td>
      </tr>
    </table>
    </center>";
echo "</form>";

echo "</body>
      </html>";
?>

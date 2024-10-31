<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../libreria_menu.php");

// Contar registros y configurar la paginación
contarRegistros($db, "paquetes");
paginacion("paquetes.php?");

// Consulta para obtener los paquetes con los datos correspondientes
$sql = $db->Prepare("SELECT paq.*, cli.*, tip.*
                     FROM clientes cli
                     JOIN paquetes paq ON paq.clienteID = cli.clienteID
                     JOIN tipo_servicios tip ON paq.tiposervicioID = tip.tiposervicioID
                     WHERE tip._estado <> 'X'
                     AND cli._estado <> 'X'
                     AND paq._estado <> 'X'
                     ORDER BY paq.paqueteID ASC
                     LIMIT ? OFFSET ?");
$rs = $db->GetAll($sql, array($nElem, $regIni));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Paquetes</title>
    <style>
        thead {
            color: black;
            background: #b5b5b5;
        }
        .card {
            margin: 20px;
        }
        tr {
            color: black;
        }
        .form-control {
            border-color: black;
        }
        .formita {
            padding: 25px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h3>GESTIÓN PAQUETES</h3>
        </div>
        <div class="card-body">
            <!-- INICIO BUSCADOR -->
            <div class="formita">
                <form action="#" method="post" name="formu">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="num_guia" class="form-label">N° GUIA</label>
                            <input type="text" class="form-control" name="num_guia" id="num_guia" size="10" onKeyUp="buscar_personas()">
                        </div>
                        <div class="col-md-3">
                            <label for="destinatario" class="form-label">Destinatario</label>
                            <input type="text" class="form-control" name="destinatario" id="destinatario" size="10" onKeyUp="buscar_personas()">
                        </div>
                        <div class="col-md-3">
                            <label for="destino" class="form-label">Destino</label>
                            <input type="text" class="form-control" name="destino" id="destino" size="10" onKeyUp="buscar_personas()">
                        </div>
                        <div class="col-md-3">
                            <label for="estado" class="form-label">Estado</label>
                            <input type="text" class="form-control" name="estado" id="estado" size="10" onKeyUp="buscar_personas()">
                        </div>
                    </div>
                </form>
            </div>
            <!-- FIN BUSCADOR -->

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="paquete_nuevo.php" class="btn btn-success" role="button">Nuevo Paquete</a>
            </div>
            <p></p>
            <div id="paquetes1">
                <?php if ($rs): ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">CLIENTE</th>
                                <th scope="col">DESTINATARIO</th>
                                <th scope="col">ENVIO</th>
                                <th scope="col">PRECIO</th>
                                <th scope="col">N° GUIA</th>
                                <th scope="col">ESTADO</th>
                                <th scope="col">SERVICIO</th>
                                <th scope="col"><img src='../../imagenes/modificar.gif'></th>
                                <th scope="col"><img src='../../imagenes/borrar.jpeg'></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $b = 0;
                            $total = $pag - 1;
                            $a = $nElem * $total;
                            $b = $b + 1 + $a;
                            foreach ($rs as $fila): ?>
                                <tr>
                                    <td><?php echo $b; ?></td>
                                    <td><?php echo $fila['cliente']; ?></td>
                                    <td><?php echo $fila['destinatario']; ?></td>
                                    <td><?php echo $fila['fecha']; ?></td>
                                    <td><?php echo $fila['precio']; ?></td>
                                    <td><?php echo $fila['num_guia']; ?></td>
                                    <td><?php echo $fila['estado']; ?></td>
                                    <td><?php echo $fila['tipo']; ?></td>
                                    <td>
                                        <form name="formModif<?php echo $fila['paqueteID']; ?>" method="post" action="paquete_modificar.php" style="display:inline;">
                                            <input type="hidden" name="paqueteID" value="<?php echo $fila['paqueteID']; ?>">
                                            <input type="hidden" name="clienteID" value="<?php echo $fila['clienteID']; ?>">
                                            <input type="hidden" name="tiposervicioID" value="<?php echo $fila['tiposervicioID']; ?>">
                                            <button type="submit" class="btn btn-sm btn-primary btn-accion">Modificar</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form name="formElimi<?php echo $fila['paqueteID']; ?>" method="post" action="paquete_eliminar.php" style="display:inline;">
                                            <input type="hidden" name="paqueteID" value="<?php echo $fila['paqueteID']; ?>">
                                            <button type="submit" class="btn btn-sm btn-danger btn-accion" onclick="return confirm('¿Desea realmente eliminar el paquete <?php echo $fila['cliente']; ?>?');">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php $b++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>

                <?php mostrar_paginacion(); ?>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../../ajax.js"></script>
    <script type="text/javascript" src="js/buscar_paquetes.js"></script>
</body>
</html>

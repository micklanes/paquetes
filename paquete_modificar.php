<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

// Obtener el ID del paquete a modificar
$paqueteID = $_POST["paqueteID"];

// Consultar los datos del paquete
$sql = $db->Prepare("SELECT * FROM paquetes WHERE paqueteID = ?");
$fila = $db->GetRow($sql, array($paqueteID));

// Consultar tipos de servicio
$sql1 = $db->Prepare("SELECT tipo, tiposervicioID FROM tipo_servicios WHERE _estado = 'A'");
$rs1 = $db->GetAll($sql1);

// Consultar clientes
$sql2 = $db->Prepare("SELECT cliente, clienteID FROM clientes WHERE _estado = 'A'");
$rs2 = $db->GetAll($sql2);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Paquete</title>

    <style>
        .form-control {
            border-color: black;
        }
        .card-body {
            padding: 25px;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <h2 class="text-center">MODIFICAR PAQUETE</h2>
                    <form class="needs-validation" novalidate action="paquete_modificar1.php" method="post">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tiposervicioID" class="form-label">(*) Tipo Servicio</label>
                                <select name="tiposervicioID" class="form-control" id="tiposervicioID" required>
                                    <option value="">--Seleccione--</option>
                                    <?php foreach ($rs1 as $fila1) { ?>
                                        <option value="<?php echo $fila1['tiposervicioID']; ?>" <?php echo ($fila['tiposervicioID'] == $fila1['tiposervicioID']) ? 'selected' : ''; ?>>
                                            <?php echo $fila1['tipo']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Seleccione un tipo de servicio.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="clienteID" class="form-label">(*) Cliente</label>
                                <select name="clienteID" class="form-control" id="clienteID" required>
                                    <option value="">--Seleccione--</option>
                                    <?php foreach ($rs2 as $fila2) { ?>
                                        <option value="<?php echo $fila2['clienteID']; ?>" <?php echo ($fila['clienteID'] == $fila2['clienteID']) ? 'selected' : ''; ?>>
                                            <?php echo $fila2['cliente']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Seleccione un cliente.
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="remitente" class="form-label">(*) Remitente</label>
                                <input type="text" class="form-control" name="remitente" id="remitente" size="30" value="<?php echo $fila['remitente']; ?>" required onkeyup="this.value=this.value.toUpperCase()">
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="telefono_remitente" class="form-label">(*) Teléfono Remitente</label>
                                <input type="text" class="form-control" name="telefono_remitente" id="telefono_remitente" size="15" value="<?php echo $fila['telefono_remitente']; ?>" required>
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="origen" class="form-label">(*) Origen</label>
                                <input type="text" class="form-control" name="origen" id="origen" size="30" value="<?php echo $fila['origen']; ?>" required onkeyup="this.value=this.value.toUpperCase()">
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="destinatario" class="form-label">(*) Destinatario</label>
                                <input type="text" class="form-control" name="destinatario" id="destinatario" size="20" value="<?php echo $fila['destinatario']; ?>" required onkeyup="this.value=this.value.toUpperCase()">
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="telefono_destino" class="form-label">(*) Teléfono Destino</label>
                                <input type="text" class="form-control" name="telefono_destino" id="telefono_destino" size="15" value="<?php echo $fila['telefono_destino']; ?>" required>
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="destino" class="form-label">(*) Departamento Destino</label>
                                <input type="text" class="form-control" name="destino" id="destino" size="30" value="<?php echo $fila['destino']; ?>" required onkeyup="this.value=this.value.toUpperCase()">
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="direccion_destino" class="form-label">(*) Dirección Destino</label>
                                <input type="text" class="form-control" name="direccion_destino" id="direccion_destino" size="100" value="<?php echo $fila['direccion_destino']; ?>" required onkeyup="this.value=this.value.toUpperCase()">
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="peso" class="form-label">(*) Peso</label>
                                <input type="text" class="form-control" name="peso" id="peso" value="<?php echo $fila['peso']; ?>" required>
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fecha" class="form-label">(*) Fecha</label>
                                <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $fila['fecha']; ?>" required>
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="precio" class="form-label">(*) Precio</label>
                                <input type="text" class="form-control" name="precio" id="precio" value="<?php echo $fila['precio']; ?>" required>
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="descripcion" class="form-label">(*) Descripción</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" rows="4" required onkeyup="this.value=this.value.toUpperCase()"><?php echo $fila['descripcion']; ?></textarea>
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="num_guia" class="form-label">(*) N° Guía</label>
                                <input type="text" class="form-control" name="num_guia" id="num_guia" value="<?php echo $fila['num_guia']; ?>" required>
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="estado" class="form-label">(*) Estado</label>
                                <input type="text" class="form-control" name="estado" id="estado" value="<?php echo $fila['estado']; ?>" required onkeyup="this.value=this.value.toUpperCase()">
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary" type="submit">Modificar Paquete</button>
                                <input type="hidden" name="paqueteID" value="<?php echo $fila['paqueteID']; ?>">
                                <br>
                                <small>(*) Datos Obligatorios</small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/validacion_obligatorios.js"></script>
</body>
</html>

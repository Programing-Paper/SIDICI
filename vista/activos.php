<?php

include('header.php');
include('controller.php');
include('alerts.php');

$usuario = $_GET['usu'];


echo $usuario;

?>

<div class='main-principal'></div>
<div class="subcontent">
    <nav class="containernav-activos">
        <h1>Activos</h1>
        <div class='opcionesnav-activos'>
            <a href="../pdf/pdfActivos.php" target="_blank"><img src="..\Imagenes\pdf.png"></a>
            <a href="../excel/excelActivos.php"><img src="..\Imagenes\excel1.png"></a>
            <!-- Button trigger modal asignar activos-->
            <button type="button" class="botoncolor" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                Asignar activo
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content modal_asignar" style="height: 360px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Asignar activo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="insertarDatos.php?guardar=actualizaractivo&usu=<?php echo $_GET['usu'] ?>" method="POST">
                            <div class="modal-body form-activos">
                                <label for="idactivo">Activos</label>
                                <select required name="idactivo" id="idactivo" class='form-control' style="width: 92%;margin-left: 15px;">
                                    <option value="0">Seleccione...</option>
                                    <?php
                                    $sentenciaAct = $db->query("SELECT idactivo FROM activos WHERE estado = 'Creado'");
                                    $resultAct = $sentenciaAct->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($resultAct as $res) { ?>
                                        <option value="<?php echo $res->idactivo ?>"><?php echo $res->idactivo ?></option>
                                    <?php } ?>
                                </select>
                                <label for="asig-empl">Empleado</label>
                                <select required name="idempleado" id="idempleado" class='form-control' style="width: 92%;margin-left: 15px;">
                                    <option value="0">Seleccione...</option>
                                    <?php
                                    $sentenciaEmp = $db->query("SELECT * FROM empleados");
                                    $resultEmp = $sentenciaEmp->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($resultEmp as $res) { ?>
                                        <option value="<?php echo $res->idempleado ?>"><?php echo $res->nombre ?></option>
                                    <?php } ?>
                                </select>
                                <label for="fecha">Fecha asignación</label>
                                <input type="date" class='form-control w-50' required name='fecha' />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Asignar</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
            <!-- Button trigger modal registrar activos -->
            <button type="button" class="botoncolor" data-bs-toggle="modal" data-bs-target="#registro-activos">
                Registrar activos
            </button>

            <!-- Modal -->
            <div class="modal fade" id="registro-activos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content modalregistro-activos">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Registrar activos</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="insertarDatos.php?guardar=activo&usu=<?php echo $_GET['usu'] ?>" method="POST">
                                <div class="form-activos">
                                    <label for="activo">Id activo</label>
                                    <input type="number" placeholder="Ingrese Activo" minlength="2" maxlength="4" class='form-control' required name='activo' />
                                    <input hidden type="number" name='idempleado' value='22222222'></input>
                                    <label for="estado">Estado</label>
                                    <select required name="estado" id="estado" class='form-control' style="width: 92%; margin-left: 15px;">
                                        <option value="0">Seleccione...</option>
                                        <?php
                                        $sentencia = $db->query("SELECT * FROM estado_activos");
                                        $result1 = $sentencia->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result1 as $res) { ?>
                                            <option value="<?php echo $res->id_estadoact ?>"><?php echo $res->nombre ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="marca">Marca</label>
                                    <input type="text" placeholder="Ingrese marca" minlength="2" maxlength="25" class='form-control' required name='marca' />
                                    <label for="serie">Serial</label>
                                    <input type="text" placeholder="Ingrese serial" minlength="4" maxlength="25" class='form-control' required name='serie' />
                                    <label for="so">Sistema Operativo</label>
                                    <input type="text" placeholder="Sistema Operativo" minlength="4" maxlength="10" class='form-control' required name='so' />
                                    <label for="tipo">Tipo de Dispositivo</label>
                                    <input type="text" placeholder="Ingrese Tipo" minlength="4" maxlength="10" class='form-control' required name='tipo' />
                                    <label for="fecha">Fecha de Ingreso</label>
                                    <input type="date" class='form-control' required name='fecha' />
                                </div>
                                <div class="form-textarea">
                                    <label for="caract">Características</label>
                                    <textarea placeholder="Información del Activo" minlength="7" maxlength="2000" class='form-control' required name='caract'></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="container-main">
        <!--  -->
        <div class="tables-sidici container-fluid">
            <table id="tableactivos" class="table table-striped table-sm">
                <thead>
                    <tr class='textwhite'>
                        <th>ID</th>
                        <th>ESTADO</th>
                        <th>RESPONSABLE</th>
                        <th>TIPO</th>
                        <th>SERIAL</th>
                        <th>MARCA</th>
                        <th>FECHA</th>
                        <th>OPCIONES</th>
                    </tr>
                </thead>
                <tbody class='textwhite'></tbody>    
            </table>
        </div>
    </main>
</div>
<?php
include('footer.php');
?>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tableactivos').DataTable({
            dom: 'frtip',
            responsive: true,
            scrollCollapse: false,
            ordering: false,
            info: false,
            "paging": true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'POST',
            'ajax': {
                'url': 'datosactivos.php',
            },
            'columns': [{
                    data: 'idactivo'
                },
                {
                    data: 'estado'
                },
                {
                    data: 'empleado'
                },
                {
                    data: 'tipo'
                },
                {
                    data: 'serial'
                },
                {
                    data: 'marca'
                },
                {
                    data: 'fecha'
                },
                {
                    data: 'editar'
                },
            ],
            // "pageLength": 10,
            order: [[3, 'desc']],

            "language": {
                "decimal": "",
                "emptyTable": "No hay registros",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    });
</script>
<?php

include('header.php');
include('controller.php');
include('alerts.php');

$usuario = $_GET['usu'];

?>

<div class='main-principal'></div>
<div class="subcontent">
    <nav class="containernav-nov">
        <h1>Novedades</h1>
        <div class="opcionesnav-nov">
            <a href="../pdf/pdfNovedades.php" target="_blank"><img src="..\Imagenes\pdf.png"></a>
            <a href="../excel/excelNovedades.php"><img src="..\Imagenes\excel1.png"></a>
            <input class="botoncolor" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" value="Registrar novedades">

            <!-- Button trigger modal -->
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content modal-novedades">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Registrar novedades</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="insertarDatos.php?guardar=novedad&usu=<?php echo $_GET['usu'] ?>" method="POST">
                                <div class="form-novedades">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" class='form-control' required name='fecha' />
                                    <label for="idempleado">Usuario afectado</label>
                                    <select required name="idempleado" id="idempleado" class='form-control' style="width: 92%; margin-left: 15px;">
                                        <option value="0">Seleccione...</option>
                                        <?php
                                        $sentencia0 = $db->query("SELECT * FROM empleados");
                                        $result0 = $sentencia0->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result0 as $res) { ?>
                                            <option value="<?php echo $res->idempleado ?>"><?php echo $res->nombre ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="idactivo">Activo</label>
                                    <select required name="idactivo" id="idactivo" class='form-control' style="width: 92%; margin-left: 15px;">
                                        <option value="0">Seleccione...</option>
                                        <?php
                                        $sentencia0 = $db->query("SELECT a.*,e.nombre as empleado FROM activos a, empleados e where a.idempleado = e.idempleado");
                                        $result0 = $sentencia0->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result0 as $res) { ?>
                                            <option value="<?php echo $res->idactivo ?>"><?php echo $res->marca . "-" . $res->tipo .  "-------" . $res->empleado ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="contentform-nov">
                                    <div class="formtextarea-nov">
                                        <label for="descripcion">Descripción</label>
                                        <textarea placeholder="Información del Activo" class='form-control' required name='descripcion'></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
        <!-- Tabla server-side novedades  -->
        <div class="tables-sidici container-fluid">
            <table id="tablenovedades" class="table table-striped table-sm">
                <thead>
                    <tr class='textwhite'>
                        <th>ID</th>
                        <th>DESCRIPCION</th>
                        <th>AFECTADO</th>
                        <th>FECHA</th>
                        <th>ACTIVO</th>
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
        $('#tablenovedades').DataTable({
            dom: 'frtip',
            responsive: true,
            scrollCollapse: false,
            ordering: false,
            info: false,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'POST',
            'ajax': {
                'url': 'datosnovedades.php',
            },
            'columns': [{
                    data: 'id_novedad'
                },
                {
                    data: 'descripcion'
                },
                {
                    data: 'nombre'
                },
                {
                    data: 'fecha'
                },
                {
                    data: 'activo'
                },
                {
                    data: 'editar'
                },
            ],
            // "pageLength": 2,
            // order: [[3, 'desc']],

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
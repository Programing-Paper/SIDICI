<?php
include('header.php');
include('controller.php');
include('alerts.php');

$usuario = $_GET['usu'];
?>

<div class='main-principal'></div>
<div class="subcontent">
    <nav class="containernav-users">
        <h1>Empleados</h1>
        <div class='opcionesnav-users'>
            <a href="../pdf/pdfUsuarios.php" target="_blank"><img src="..\Imagenes\pdf.png"></a>
            <a href="../excel/excelUsuarios.php"><img src="..\Imagenes\excel1.png"></a>
            <!-- Button trigger modal -->
            <button type="button" class="botoncolor" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Registrar empleados
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content modal-users">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Registrar empleados</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="insertarDatos.php?guardar=usuarios&usu=<?php echo $_GET['usu'] ?>" method="POST">
                                <div class="form-users">
                                    <label for="idempleado">Documento</label>
                                    <input type="text" placeholder="Ingrese documento" class='form-control' required name='idempleado' />
                                    <label for="nombre">Nombre</label>
                                    <input type="text" placeholder="Ingrese nombre" class='form-control' required name='nombre' />
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" placeholder="Ingrese Teléfono" class='form-control' required name='telefono' />
                                    <label for="direccion">Dirección</label>
                                    <input type="text" placeholder="Ingrese Dirección" class='form-control' required name='direccion' />
                                    <label for="cargo">Cargo</label>
                                    <select required name="id_cargo" id="cargo" class='form-control' style="width: 92%; margin-left: 15px;">
                                        <option value="0">Seleccione...</option>
                                        <?php
                                        $sentencia0 = $db->query("SELECT * FROM cargo");
                                        $result0 = $sentencia0->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result0 as $res) { ?>
                                            <option value="<?php echo $res->id_cargo ?>"><?php echo $res->nomcargo ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="id_compania">Ciudad</label>
                                    <select required name="id_compania" id="id_compania" class='form-control' style="width: 92%; margin-left: 15px;">
                                        <option value="0">Seleccione...</option>
                                        <?php
                                        $sentencia = $db->query("SELECT * FROM ciudad");
                                        $result1 = $sentencia->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result1 as $res) { ?>
                                            <option value="<?php echo $res->id_compania ?>"><?php echo $res->ciudad ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="id_estadoemp">Estado</label>
                                    <select required name="id_estadoemp" id="id_estadoemp" class='form-control' style="width: 92%; margin-left: 15px;">
                                        <option value="0">Seleccione...</option>
                                        <?php
                                        $sentencia = $db->query("SELECT * FROM estado_empleados");
                                        $result1 = $sentencia->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result1 as $res) { ?>
                                            <option value="<?php echo $res->id_estadoemp ?>"><?php echo $res->nombre ?></option>
                                        <?php } ?>
                                    </select>
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
    </nav>
    <main class="container-main">
        <!-- Tabla server-side empleados  -->
        <div class="tables-sidici container-fluid">
            <table id="tableempleados" class="table table-striped table-sm">
                <thead>
                    <tr class='textwhite'>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>CARGO</th>
                        <th>ESTADO</th>
                        <th>SEDE</th>
                        <th>TELEFONO</th>
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
        $('#tableempleados').DataTable({
            dom: 'frtip',
            responsive: true,
            scrollCollapse: false,
            ordering: false,
            info: false,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'POST',
            'ajax': {
                'url': 'datosempleados.php',
            },
            'columns': [{
                    data: 'idempleado'
                },
                {
                    data: 'nombre'
                },
                {
                    data: 'nomcargo'
                },
                {
                    data: 'esnombre'
                },
                {
                    data: 'ciudad'
                },
                {
                    data: 'telefono'
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


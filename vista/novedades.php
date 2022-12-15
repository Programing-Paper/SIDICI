<?php 

include('header.php');
include('controller.php');
include('alerts.php');

$usuario = $_GET['usu'];

$sql = $db->query("SELECT count(*) from novedades");
$res_count = $sql->fetchColumn();

$activosPage = $res_count / 8;
$activosPage = ceil($activosPage);

$inicio = ($_GET['pag'] - 1) * 8;
$fin = 8;

$sentencia = $db->query("SELECT n.*,e.nombre,a.marca,a.tipo FROM novedades n, empleados e, activos a 
WHERE n.idempleado = e.idempleado AND n.idactivo = a.idactivo order by id_novedad LIMIT $fin offset $inicio");
$result = $sentencia->fetchAll(PDO::FETCH_OBJ);

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
                                    <!-- <label for="id_novedad">Id Novedad</label>
                                <input type="text" placeholder="Ingrese ID" class='form-control' required name='id_novedad' /> -->
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
    </nav>
    <main class="containermain-nov" style="height: 71vh;">
        <!--  -->
        <div class="tables-sidici container-fluid">
            <table id="example" class="table table-striped position-relative table-sm" style="width:100%">
                <thead>
                    <tr class='textwhite'>
                        <th>ID NOVEDAD</th>
                        <th>DESCRIPCIÓN</th>
                        <th>USUARIO AFECTADO</th>
                        <th>FECHA</th>
                        <th>NOMBRE</th>
                        <th>EDITAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $res) { ?>
                        <tr class='textwhite'>
                            <td><?php echo $res->id_novedad ?></td>
                            <td><?php echo $res->descripcion ?></td>
                            <td><?php echo $res->nombre ?></td>
                            <td><?php echo $res->fecha ?></td>
                            <td><?php echo $res->marca . "-" . $res->tipo ?></td>
                            <?php if ($res->resuelto == 'SI' ) { ?>
                                <td>Cerrado</td>
                            <?php } else { ?>
                                <td><a href="<?php echo "editarNovedad.php?page=editarNovedad&id=" . $res->id_novedad . "&usu=" . $usuario ?>"><i class="bi bi-pencil-square textwhite"></i></a></td>
                            <?php }
                             ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
            <script src='..\Javascript\datatables.js'></script>
        </div>
        <div id="paginacion">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?php echo $_GET['pag'] <= 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="novedades.php?page=novedades&usu=<?php echo $usuario; ?>&pag=<?php echo $_GET['pag'] - 1; ?>">
                            Anterior
                        </a>
                    </li>
                    <?php for ($i = 0; $i < $activosPage; $i++) { ?>
                        <li class="page-item <?php echo $_GET['pag'] == $i + 1 ? 'active' : ''; ?>">
                            <a class="page-link" href="novedades.php?page=novedades&usu=<?php echo $usuario; ?>&pag=<?php echo $i + 1; ?> ">
                                <?php echo $i + 1; ?>
                            </a>
                        <?php }  ?>
                        <li class="page-item <?php echo $_GET['pag'] >= $activosPage ? 'disabled' : ''; ?>">
                            <a class="page-link" href="novedades.php?page=novedades&usu=<?php echo $usuario; ?>&pag=<?php echo $_GET['pag'] + 1; ?>">
                                Siguiente</a>
                        </li>
                </ul>
            </nav>
        </div>
    </main>
</div>
<?php include("footer.php"); ?>
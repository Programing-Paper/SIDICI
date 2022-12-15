    <?php
    include('header.php');
    include('controller.php');
    include('alerts.php');

    $sql = $db->query("SELECT count(*) from empleados");
    $res_count = $sql->fetchColumn();

    $activosPage = $res_count / 8;
    $activosPage = ceil($activosPage);

    $inicio = ($_GET['pag'] - 1) * 8;
    $fin = 8;

    $sentencia = $db->query("SELECT e.*,c.nomcargo,d.ciudad, emp.nombre as esnombre FROM empleados e, cargo c, ciudad d, estado_empleados emp
WHERE e.id_cargo = c.id_cargo AND e.id_compania = d.id_compania and e.id_estadoemp = emp.id_estadoemp LIMIT $fin offset $inicio ");
    $result = $sentencia->fetchAll(PDO::FETCH_OBJ);

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
        <main class="containermain-users" style="height: 70vh;">
            <!--  -->
            <div class="tables-sidici container-fluid">
                <table id="example" class="table table-striped position-relative table-sm" style="width:100%">
                    <thead>
                        <tr class='textwhite'>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>CARGO</th>
                            <th>ESTADO</th>
                            <th>SEDE</th>
                            <th>EDITAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $res) { ?>
                            <tr class='textwhite'>
                                <td><?php echo $res->idempleado ?></td>
                                <td><?php echo $res->nombre ?></td>
                                <td><?php echo $res->nomcargo  ?></td>
                                <td><?php echo $res->esnombre  ?></td>
                                <td><?php echo $res->ciudad  ?></td>
                                <td><a href="<?php echo "editarUsuario.php?page=editarUsuario&id=" . $res->idempleado . "&usu=" . $usuario ?>"><i class="bi bi-pencil-square textwhite"></i></a></td>
                                <!-- <td><a class="btn btn-danger" href="<?php echo "eliminar.php?id=" . $mascota->id ?>">Eliminar ???</a></td> -->
                            </tr>
                        <?php } ?>
                        </tr>
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
                            <a class="page-link" href="usuarios.php?page=usuarios&usu=<?php echo $usuario; ?>&pag=<?php echo $_GET['pag'] - 1; ?>">
                                Anterior
                            </a>
                        </li>
                        <?php for ($i = 0; $i < $activosPage; $i++) { ?>
                            <li class="page-item <?php echo $_GET['pag'] == $i + 1 ? 'active' : ''; ?>">
                                <a class="page-link" href="usuarios.php?page=usuarios&usu=<?php echo $usuario; ?>&pag=<?php echo $i + 1; ?> ">
                                    <?php echo $i + 1; ?>
                                </a>
                            <?php }  ?>
                            <li class="page-item <?php echo $_GET['pag'] >= $activosPage ? 'disabled' : ''; ?>">
                                <a class="page-link" href="usuarios.php?page=usuarios&usu=<?php echo $usuario; ?>&pag=<?php echo $_GET['pag'] + 1; ?>">
                                    Siguiente</a>
                            </li>
                    </ul>
                </nav>
            </div>
        </main>
    </div>
    <?php

    include('footer.php');

    ?>
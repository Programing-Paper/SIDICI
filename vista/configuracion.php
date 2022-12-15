<?php
include('header.php');
include('alerts.php');

$sql = $db->query("SELECT count(*) from admin");
$res_count = $sql->fetchColumn();

$configPage = $res_count / 5;
$configPage = ceil($configPage);

$inicio = ($_GET['pag'] - 1) * 5;
$fin = 5;

$sentencia = $db->query("SELECT idadmin, correo, perfil, id_estadoemp from admin order by idadmin LIMIT $fin offset $inicio");
$resultc = $sentencia->fetchAll(PDO::FETCH_OBJ);


?>

<div class='main-principal'></div>
<div class="subcontent">
  <section class="content-section">
    <div class='content-perfil'>
      <div class="config-name">
        <div>
          <img class='config-perfil' src="../uploads/<?= $_SESSION['profile'] ?>" data-bs-toggle="modal" data-bs-target="#editphoto">
        </div>
        <h1><?php echo $result->correo; ?></h1>
      </div>
      <div class="config-informacion">
        <div class="editadmin">
          <!-- Button trigger modal -->
          <button type="button" class="botoncolor" data-bs-toggle="modal" data-bs-target="#editprofile">
            Editar perfil
          </button>

          <!-- Modal -->
          <div class="modal fade" id="editprofile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content colormodals">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar perfil</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method='POST' action='update.php?' enctype="multipart/form-data">
                    <div class='formperfil'>
                      <img src="../uploads/<?= $user['perfil'] ?>" class='img-fluid rounded-circle' width="100px">
                    </div>
                    <input type="file" class="form-control mt-3" placeholder="" name='newimg'>
                    <input hidden type="text" value="<?= $user['perfil'] ?>" name='nameimg' />
                    <label for="correo">Correo actual</label>
                    <input hidden type="text" name='idadmin' value="<?php echo $idadmin; ?>" />
                    <input type="email" readonly class="form-control" name='correo' value="<?php echo $result->correo; ?>">
                    <label for="correo">Nuevo correo</label>
                    <input type="email" class="form-control" name='updatecorreo' placeholder='Ingrese correo' />
                    <label for="password">Contraseña actual</label>
                    <input type="password" class="form-control mb-3" name="password" placeholder='Ingrese contraseña' autocomplete="of">
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <button type="input" class="btn btn-primary" name='cambiar'>Cambiar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Button trigger modal -->
          <button type="button" class="botoncolor" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Registrar administrador
          </button>

          <!-- Modal -->
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content colormodals">
                <div class="modal-header">
                  <h1 class="modal-title fs-5 textwhite" id="staticBackdropLabel">Registrar administrador</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class='textwhite' action='update.php' method="POST" enctype="multipart/form-data">
                  <div class="modal-body">
                    <input type="file" class="form-control mb-3" aria-label="Example text with button addon" aria-describedby="button-addon1" name='perfil'>
                    <div class="mb-3">
                      <label for="idempleado">Empleado</label>
                      <select required name="idempleado" id="idempleado" class='form-control'>
                        <option value="0">Seleccione...</option>
                        <?php
                        $sentenciaEmp = $db->query("SELECT * FROM empleados");
                        $resultEmp = $sentenciaEmp->fetchAll(PDO::FETCH_OBJ);
                        foreach ($resultEmp as $res) { ?>
                          <option value="<?php echo $res->idempleado ?>"><?php echo $res->nombre ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="correo" class="form-label">Correo</label>
                      <input type="text" class="form-control" id="correo" name='correo' placeholder="Ingrese correo" required>
                    </div>
                    <div class="mb-3">
                      <label for="contraseña" class="form-label">Ingrese contraseña</label>
                      <input type="password" class="form-control" id="contraseña" name='clave' placeholder="Ingrese clave" autocomplete="of" required>
                    </div>
                    <div class="mb-3">
                      <label for="confirmpass" class="form-label">Confirmar contraseña</label>
                      <input type="password" class="form-control" id="confirmpass" name='confirClave' placeholder="Confirmar clave" autocomplete="of" required>
                    </div>
                    <div class="mb-3">
                      <label for="activo">Activo</label>
                      <input type="radio" id="activo" name="activo" value="1" checked>
                      <label for="inactivo">Inactivo</label>
                      <input type="radio" id="inactivo" name="activo" value="0">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <button type="input" class="btn btn-primary" name='registrar'>Registrar</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <a href="respaldo.php">
        <button type="submit" class="botoncolor mx-1 mt-2">Copia de seguridad</button>
      </a>
    </div>
</div>
<div class="table-admin container-fluid">
  <table id="example" class="table table-striped table-sm">
    <thead>
      <tr class='textwhite'>
        <th>ID</th>
        <th>Correo</th>
        <th>Imagen</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($resultc as $res) { ?>
        <tr class='textwhite'>
          <?php $state = $res->id_estadoemp == 1 ? 'Activo' : 'Inactivo'; ?>
          <td><?= $res->idadmin ?></td>
          <td><?= $res->correo ?></td>
          <td>
            <div class='config-img'><img src="../uploads/<?php echo $res->perfil ?>"></div>
          </td>
          <td>
            <?php $mostrar = $res->id_estadoemp == 1 ? 'checked disabled' : 'cheked'; ?>
            <div class="form-check form-switch">
              <form action="update.php" method='POST'>
                <input hidden value='<?= $res->idadmin; ?>' name='iduser'></input>
                <input hidden value='<?= $res->id_estadoemp; ?>' name='estado'></input>
                <input class="form-check-input mt-2" id='checked' type="checkbox" role="switch" <?= $mostrar; ?>></input>
                <label class="form-check-label mt-4" for="cheked"></label>
                <input type='submit' class="form-check-input mt-2" value=''><?= $state ?></input>
              </form>
            </div>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <script defer src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script defer src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script defer src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script defer src='..\Javascript\datatables.js'></script>
</div>
<div class="pagadmin">
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item <?php echo $_GET['pag'] <= 1 ? 'disabled' : ''; ?>">
        <a class="page-link" href="#">Anterior</a>
      </li>
      <?php for ($i = 0; $i < $configPage; $i++) { ?>
        <li class="page-item <?php echo $_GET['pag'] == $i + 1 ? 'active' : ''; ?>">
          <a class="page-link" href="configuracion.php?page=configuracion&usu=<?php echo $usuario; ?>&pag=<?php echo $i + 1; ?>">
            <?php echo $i + 1; ?>
          </a>
        </li>
      <?php }  ?>
      <li class="page-item <?php echo $_GET['pag'] >= $configPage ? 'disabled' : ''; ?>">
        <a class="page-link" href="#">Siguiente</a>
      </li>
    </ul>
  </nav>
</div>
</section>
</div>
<div class='footer-solo'>
  <h1> SIDICI. todos los derechos reservados @Amovil &#169 2016 - 2022 </h1>
</div>

</body>

</html>

<script>
  function confirmacion() {
    var respuesta = confirm("Estas seguro de eliminar el registro?");
    if (respuesta == true) {
      return true;
    } else {
      return false;
    }
  }
</script>

<script>
  function cambiar(idadmin, estado) {

    // var estatus = $(this).prop('checked') == true ? 1 : 0;
    // var idadmin = $(this).data('estadoUsuario');

    $.ajax({
      type: "POST",
      data: "estado=" + estado + "&id=" + idadmin,
      url: "update2.php",
      success: function(respuesta) {
        respuesta = respuesta.trim();
        if (respuesta == 1) {

          $.toast({
            heading: 'Correcto!',
            text: 'Se activo el usuario',
            icon: 'succes',
            transition: 'plain',
            position: 'top-right',
            loaderBg: 'white'
          })
        } else {
          $.toast({
            heading: 'Correcto',
            text: 'Se desactivo el usuario!',
            icon: 'error',
            transition: 'plain',
            position: 'top-right',
            loaderBg: 'white'
          })
        }
      }
    });
  }

  onclick = 'cambiar(<?php echo $res->idadmin ?>,<?php echo $res->id_estadoemp ?>)'
</script>
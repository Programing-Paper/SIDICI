<?php include('header.php');

include('controller.php');

if (!isset($_GET['id'])) {
    exit();
}

$id=$_GET['id'];

$sql = $db->prepare("SELECT * FROM empleados WHERE  idempleado= ?");
$sql->execute([$id]);
$result = $sql->fetchObject();
if (!$result) {
    echo "¡No existe algún usuario con ese Documento!";
    exit();
}
$usuario = $_GET['usu'];
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<div class="main-principal"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="contentupdate">
            <form method="POST" class="form">
                <h1>Editar empleado</h1>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" hidden name="id" value="<?php echo $result->idempleado; ?>">
                        <label for="nombre">Documento del usuario</label>
                        <p class="border p-1 form-control " readonly ><?php echo $result->idempleado; ?></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_estadoemp">Estado</label>
                        <select required name="id_estadoemp" id="id_estadoemp" class='form-control' >
                            <?php
                            $sentencia = $db->query("SELECT * FROM estado_empleados");
                            $result1 = $sentencia->fetchAll(PDO::FETCH_OBJ);
                            foreach($result1 as $res){ ?>
                            <option value="<?php echo $res->id_estadoemp ?>" <?php
                            if($result->id_estadoemp == $res->id_estadoemp){echo "selected";} ?>>
                            <?php echo $res->nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="nombre">Nombre</label>
                        <input type="text" value='<?php echo $result->nombre;?>' required name="nombre" 
                        id="nombre" placeholder="Nombre" class="form-control" minlenght="10" maxlength="20">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="direccion">Dirección</label>
                        <input value="<?php echo $result->direccion; ?>" required name="direccion" 
                        type="text" id="direccion" placeholder="Direccion" class="form-control" minlenght="10" maxlength="150">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="telefono">Teléfono</label>
                        <input value="<?php echo $result->telefono; ?>" required name="telefono" 
                        type="text" id="telefono" placeholder="Telefono" class="form-control" minlenght="10" maxlength="20">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="id_compania">Ciudad</label>
                        <select required name="id_compania" id="id_compania" class='form-control'>
                            <?php
                            $sentencia = $db->query("SELECT * FROM ciudad");
                            $result1 = $sentencia->fetchAll(PDO::FETCH_OBJ);
                            foreach($result1 as $res){ ?>
                            <option value="<?php echo $res->id_compania ?>"<?php
                            if($result->id_compania == $res->id_compania){echo "selected";} ?>>
                            <?php echo $res->ciudad ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cargo">Cargo</label>
                        <select required name="id_cargo" id="cargo" class='form-control'>
                            <?php
                             $sentencia0 = $db->query("SELECT * FROM cargo");
                            $result0 = $sentencia0->fetchAll(PDO::FETCH_OBJ);
                            foreach($result0 as $res){ ?>
                            <option value="<?php echo $res->id_cargo ?>" <?php
                            if($result->id_cargo == $res->id_cargo){echo "selected";} ?>>
                            <?php echo $res->nomcargo ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                    <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
                    <a href="<?php echo "usuarios.php?page=usuarios&usu=".$usuario."&pag=1"?>" class="btn btn-dark volver">Volver</a>
            </form>
        </div>
    </div>
</div>
<div class='footer-solo'>
  <h1> SIDICI. todos los derechos reservados @Amovil &#169 2016 - 2022 </h1>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>
<?php

if (!isset($_POST['nombre']) || !isset($_POST['telefono']) ||
    !isset($_POST['id_cargo']) || !isset($_POST['id_compania']) || !isset($_POST['direccion']) ||
    !isset($_POST['id_estadoemp']) ) {
exit();
}
    
    $id = $_POST["id"];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $id_cargo=$_POST['id_cargo'];
    $id_compania = $_POST['id_compania'];
    $direccion=$_POST['direccion'];
    $id_estadoemp = $_POST['id_estadoemp'];
    $usuario = $_GET['usu'];

 if (isset($_POST['guardar'])) {
    include_once"controller.php";

    $sql = $db->prepare("UPDATE empleados SET nombre = ?, telefono = ?, id_cargo = ?, id_compania = ?, 
                        direccion = ?, id_estadoemp = ? WHERE idempleado = ?;");
    $res = $sql->execute([$nombre,$telefono,$id_cargo,$id_compania,$direccion,$id_estadoemp,$id]);
     if (!$res) {
         #No existe
         echo "<script>alert('Error, por favor valide que el usuario es correcto')</script>";
         exit();
     }else {
          $_SESSION['alertsucces'] = "Se actualizó el empleado correctamente";
          echo "<script>window.location.href='usuarios.php?page=usuario&usu=$usuario&pag=1'</script>";
     }
 }

?> 
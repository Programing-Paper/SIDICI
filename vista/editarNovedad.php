<?php include('header.php'); ?>

<?php
if (!isset($_GET['id'])) {
    exit();
}


$id = $_GET['id'];
include('controller.php');

$sql = $db->prepare("SELECT * FROM novedades WHERE  id_novedad = ?");
$sql->execute([$id]);
$result = $sql->fetchObject();
if (!$result) {
    echo "¡No existe algun usuario con ese Documento!";
    exit();
}
$usuario = $_GET['usu'];
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<div class="main-principal"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="contentupdate">
            <form method="POST" class='form'>
                <h1>Editar Novedades</h1>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" hidden name="id_novedad" value="<?php echo $result->id_novedad; ?>">
                        <p>Documento del Activo: </p>
                        <p class="border p-1 "><?php echo $result->id_novedad; ?></p>
                    </div>
                    <div class="form-group col-md-6">
                        <p>Estado de la Novedad: </p>
                        <label>Resuelto: <input type="checkbox" name="resuelto" value="SI" style="width: 50px;"></label><br>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="idactivo">Empleado</label>
                        <select required name="idempleado" id="idempleado" class='form-control'>
                            <?php
                            $sentencia0 = $db->query("SELECT * FROM empleados");
                            $result0 = $sentencia0->fetchAll(PDO::FETCH_OBJ);
                            foreach ($result0 as $res) { ?>
                                <option value="<?php echo $res->idempleado ?>" <?php
                                                                                if ($result->idempleado == $res->idempleado) {
                                                                                    echo "selected";
                                                                                } ?>>
                                    <?php echo $res->nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="idactivo">Activo</label>
                        <select required name="idactivo" id="idactivo" class='form-control'>
                            <?php
                            $sentencia0 = $db->query("SELECT * FROM activos");
                            $result0 = $sentencia0->fetchAll(PDO::FETCH_OBJ);
                            foreach ($result0 as $res) { ?>
                                <option value="<?php echo $res->idactivo ?>" <?php
                                                                                if ($result->idactivo == $res->idactivo) {
                                                                                    echo "selected";
                                                                                } ?>>
                                    <?php echo $res->marca . "-" . $res->tipo ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha">Fecha</label>
                        <input value="<?php echo $result->fecha; ?>" required name="fecha" type="date" id="fecha" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="descripcion">Descripcion</label>
                        <textarea placeholder="Información del Activo" class='form-control' required name='descripcion'><?php echo $result->descripcion ?></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
                <a href="<?php echo "novedades.php?page=novedades&usu=" . $usuario . "&pag=1" ?>" class="btn btn-dark volver">Volver</a>
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

if (
    !isset($_POST['id_novedad']) ||
    !isset($_POST['descripcion']) || !isset($_POST['fecha']) ||
    !isset($_POST['idempleado']) || !isset($_POST['idactivo'])
) {
    exit();
}
$id_novedad = $_POST['id_novedad'];
$fecha = $_POST['fecha'];
$descripcion = $_POST['descripcion'];
$idempleado = $_POST['idempleado'];
$idactivo = $_POST['idactivo'];
$usuario = $_GET['usu'];
if ($_POST['resuelto']== 'SI') {
    $resuelto = $_POST['resuelto'];
}else{$resuelto = 'NO';}


if (isset($_POST['guardar'])) {
    include_once "controller.php";
    
    $sql = $db->prepare("UPDATE novedades SET descripcion = ?, fecha = ?, idactivo = ?, idempleado = ?, resuelto = ? WHERE id_novedad = ?;");
    $res = $sql->execute([$descripcion, $fecha, $idactivo, $idempleado, $resuelto, $id_novedad]);
    
    if (!$res) {
        #No existe
        echo "<script>alert('Error, por favor valide que el usuario es correcto')</script>";
        exit();
    } else {
        $_SESSION['alertsucces'] = "Se actualizó la novedad correctamente";
        echo "<script>window.location.href='novedades.php?page=novedades&usu=$usuario&pag=1'</script>";
    }
}

?>
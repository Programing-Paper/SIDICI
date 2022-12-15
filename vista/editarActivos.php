<?php 

include('header.php');
include('controller.php');

if (!isset($_GET['id'])) {
    exit();
}

$id = $_GET['id'];

$sql = $db->prepare("SELECT * FROM activos WHERE  idactivo= ?");
$sql->execute([$id]);
$result = $sql->fetchObject();
if (!$result) {
    echo "¡No existe algún usuario con ese documento!";
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
                <h1>Editar activo</h1>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" hidden name="id" value="<?php echo $result->idactivo;  ?>">
                        <p>Documento del activo: </p>
                        <p class="border p-1 "><?php echo $result->idactivo; ?></p>
                    </div>
                    <div class="form-group col-md-6">
                        <p>Id empleado: </p>
			<select required name="idempleado" id="idempleado" class='form-control' style="width: 100%;">
                        <?php
                        $sentencia0 = $db->query("SELECT * FROM empleados ");
                        $result0 =  $sentencia0->fetchAll(PDO::FETCH_OBJ);
                         foreach ($result0 as $res0) { ?>
                                <option value="<?php echo $res0->idempleado ?>" <?php
                                           if ($result->idempleado == $res0->idempleado) {
                                          echo "selected";
                                          } ?>>
                                    <?php echo $res0->nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="estado">Estado</label>
                        <select required name="estado" id="estado" class='form-control' style="width: 100%;">
                            <option value="0">Seleccione...</option>
                            <?php
                            $sentencia = $db->query("SELECT * FROM estado_activos");
                            $result1 = $sentencia->fetchAll(PDO::FETCH_OBJ);
                            foreach ($result1 as $res) { ?>
                                <option value="<?php echo $res->id_estadoact ?>" <?php
                                                                                    if ($result->id_estadoact == $res->id_estadoact) {
                                                                                        echo "selected";
                                                                                    } ?>>
                                    <?php echo $res->nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="marca">Marca</label>
                        <input value="<?php echo $result->marca; ?>" required name="marca" type="text" id="marca" placeholder="Numero" class="form-control" minlength="4" maxlength="25">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="so">Sistema operativo</label>
                        <input value="<?php echo $result->so; ?>" required name="so" type="text" id="so" placeholder="Software" class="form-control" minlength="4" maxlength="10">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="serie">Serial</label>
                        <input value="<?php echo $result->serial; ?>" required name="serie" type="text" id="serie" placeholder="serie" class="form-control" minlength="4" maxlength="25">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="tipo">Tipo</label>
                        <input value="<?php echo $result->tipo; ?>" required name="tipo" type="text" id="tipo" placeholder="Tipo" class="form-control" pattern="[a-zA-Z]{2,10}" minlenght='4' maxlenght='10'>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fecha">Fecha</label>
                        <input value="<?php echo $result->fecha; ?>" required name="fecha" type="date" id="fecha" class="form-control" minlength="4" maxlength="8" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="caract">Características</label>
                        <textarea placeholder="Informacion del Activo" class='form-control' required name='caract' style='resize: none;' minlenght="10" maxlength="200" ><?php echo $result->observaciones ?></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mx-3" name="guardar">Guardar</button>
                <a href="<?php echo "activos.php?page=activos&usu=" . $usuario . "&pag=1" ?>" class="btn btn-dark volver">Volver</a>
            </form>
        </div>
    </div>
</div>
<div class='footer-solo'>
    <h1> SIDICI. Todos los derechos reservados @Amovil &#169 2016 - 2022 </h1>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>

<?php

if (
    !isset($_POST['estado']) || !isset($_POST['serie']) ||
    !isset($_POST['so']) || !isset($_POST['marca']) || !isset($_POST['tipo']) ||
    !isset($_POST['fecha']) || !isset($_POST['caract'])
) {
    exit();
}

echo "entra aqui afuera <br>";
$id = $_POST["id"];
$idempleado = $_POST["idempleado"];
$estado = $_POST['estado'];
$serie = $_POST['serie'];
$so = $_POST['so'];
$marca = $_POST['marca'];
$tipo = $_POST['tipo'];
$fecha = $_POST['fecha'];
$caract = $_POST['caract'];
$usuario = $_GET['usu'];
if (isset($_POST['guardar'])) {
    include_once "controller.php";

    $disp= '';
    if ($idempleado=='22222222') {
        $disp='Creado';
    }else{$disp='Asignado';}

    $sql = $db->prepare("UPDATE activos SET idempleado = ?, id_estadoact = ?, serial = ?, so = ?, marca = ?, tipo = ?, 
                        fecha = ?, observaciones = ?, estado = ? WHERE idactivo = ?;");
    $res = $sql->execute([$idempleado,$estado, $serie, $so, $marca, $tipo, $fecha, $caract,$disp, $id]);
    if (!$res) {
        #No existe
        echo "<script>alert('Error, por favor valide que el usuario es correctos')</script>";
        exit();
    } else {
        $_SESSION['alertsucces'] = "Se actualizó el activo correctamente";
        echo "<script>window.location.href='activos.php?page=activos&usu=$usuario&pag=1'</script>";
    }
}

?>
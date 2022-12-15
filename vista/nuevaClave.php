<?php
if (!isset($_GET['id']) || !isset($_GET['tokenUser']) ){
  exit();
  }
else {
$idadmin = $_GET['id'];
$tokenUser = $_GET['tokenUser'];

include_once "controller.php";

$sentencia = $db->prepare("SELECT * FROM admin WHERE idadmin = ? and tokenUser = ?;");
$sentencia->execute([$idadmin, $tokenUser]);
$res = $sentencia->fetchObject();

}
if (!$res) {
  #No existe
  echo "<script>alert('Error, La contraseña ya fue modificada, vuelva a ingresar a ¿Olvidaste tu contraseña?.'); window.location.href= '../index.php'</script>";
  exit();
}else {

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <link rel="stylesheet" href="../estilos/newpass.css?php">
  <link rel="icon" href="..\Imagenes\Imagen74.png"/> 
  <title>Nueva clave</title>
</head>

<body>
  <div class="div_contenedor">
    <div class="text-center div_centrado">
      <div>
        <div class="content-img">
          <img src="../Imagenes/amovil123.png" alt="bien" class="img-fluid well">
        </div>
        <p>Hola Bienvenido, escribe tu nueva clave aquí</p>
        <hr>
        <form action="actualizaClave.php" method="POST">
          <input type="text" name="idadmin" value="<?php echo $res->idadmin; ?>" hidden="true">
          <input type="text" name="tokenUser" value="<?php echo $res->tokenuser; ?>" hidden="true">
          <div class="form-group mb-3">
            <label for="password" style="float: left; font-weight:bold;">Nueva Clave</label>
            <input type="password" name="clave" class="form-control" required>
            <label for="password1" style="float: left; font-weight:bold;">Confirmar Clave</label>
            <input type="password" required name="confirClave" class="form-control">
            <br>
            <input type="submit" value="Recuperar Ahora" class="btn btn-primary  btn-block" name='recuperar' />
          </div>
        </form>
      </div>
    </div>

  </div>

</body>

</html>
<?php
}
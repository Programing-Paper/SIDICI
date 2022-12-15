<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar Contraseña</title>
  <link href="../estilos/restablecer.css" rel='stylesheet' />
  <link rel="icon" href="Imagenes\Imagen74.png" />
  <!-- alertas -->
  <script src='../jquery/jquery.js'></script>
  <script src='../Javascript/jquery.toast.js'></script>
  <link rel="stylesheet" href="../estilos/jquery.toast.css">
</head>

<body>
  <div class='restablcont'>
    <div class="imgamovil">
      <img src="../Imagenes/amovil123.png" alt="imgamovil">
    </div>
    <form action="recuperarClave.php" method='POST'>
      <div class='textemail'>
        <label for="correo">Ingrese su correo electrónico, un enlace para reestablecer su contraseña va a ser enviado a su correo.</label>
      </div>
      <div class="contenedor">
        <input type='email' maxlength="50" minlength="10" placeholder="Correo Electronico" required id='formemail' name='correo' />
        <input type="submit" value="Recuperar Contraseña" class='posbutrec' name='recuperar' />
        <h3 id="optionreturn">--¿Desea regresar al inicio del aplicativo?--</h3>
        <div class='regresar'>
          <a href="../index.php" id='posbutreg'>Regresar</a>
        </div>
      </div>
    </form>
  </div>
</body>

</html>

<?php 
    session_start();
    include('alerts.php');
?>
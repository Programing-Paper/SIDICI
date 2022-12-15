<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIDICI</title>
    <link rel="icon" href="Imagenes/Imagen74.png" />
    <link rel="stylesheet" href="estilos/Index.css?php">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src='jquery/jquery.js'></script>
    <script src='Javascript/jquery.toast.js'></script>
    <link rel="stylesheet" href="estilos/jquery.toast.css">
</head>

<body class="fondo">
    <div>
        <div id='marcologin'>
            <div class="content">
                <img src="Imagenes/Imagen74.png" alt='Logo Amovil' />
                <h1>Iniciar Sesión</h1>
                <strong>Por favor ingrese el nombre de Usuario y Contraseña.</strong>
            </div>
            <div class="form">
                <form action="vista/Logout.php" method='POST'>
                    <div class="mb-3 item">
                        <label for="DatUsaurio" class="form-label">Usuario:</label>
                        <input type="email" class="form-control" id="DatUsaurio" placeholder="Ingrese el correo" required autocomplete="on" name='usuario'>
                    </div>
                    <div class="mb-3 item">
                        <label for="Datpasworrd" class="form-label">Contraseña:</label>
                        <input type="password" class="form-control" id="Datpasworrd" placeholder="Ingrese la contraseña" required name='contrasena' autocomplete="of">
                    </div>
                    <div class="item-boton">
                        <input class='boton' type="submit" value="Ingresar" name='ingresar' />
                    </div>
                </form>
            </div>
            <div class="formpass mt-5">
                <a href="vista\recuperar-contra.php">-----------------¿Olvidaste tu contraseña?.-----------------</a>
                <div class="termcondicion">
                    <p> Al continuar, usted confirma que ha leído y aceptado nuestros:
                        <a href="https://web.amovil.co/" target="_blank">Terminos y condiciones.</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <img id="imgamovil" src="Imagenes/Logo_white.png" alt='Logo_Amovil' />
</body>

</html>

<?php

session_start();
if (isset($_SESSION['erroruser'])) {
    $respuesta = $_SESSION['erroruser']; ?>
    <script>
        $.toast({
            heading: 'Error!',
            text: '<?php echo $respuesta ?>',
            icon: 'error',
            loaderBg: 'white',
            transition: 'plain',
            position: 'top-left'
        })
    </script>
<?php
    unset($_SESSION['erroruser']);
} else if (isset($_SESSION['correoenviado'])) {
    $respuesta = $_SESSION['correoenviado']; ?>
    <script>
      $.toast({
        heading: 'Bien!',
        text: '<?php echo $respuesta ?>',
        icon: 'success',
        transition: 'plain',
        position: 'top-left',
        bgColor: '#0f76bc',
        loaderBg: 'white'
      })
    </script>
  <?php
    unset($_SESSION['correoenviado']);
  } ?>

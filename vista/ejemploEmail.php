<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link href="../estilos/restablecer.css" rel='stylesheet'/>
    <link rel="icon" href="/Imagenes/Imagen74.png"/>
</head>
<body>
  <div id='restablcont'>
      <form action="recuperar-contra.php" method='POST'>
      <div class="item1">
        <label id="textemail" for="correo">Ingrese su correo electrónico, un enlace para reestablecer su contraseña va a ser enviado a su correo.</label>
      </div>
      <div class="contenedor">
        <input type='email' maxlength="50" minlength="10" 
        placeholder="Correo Electronico" required id='formemail' name='correo'/>
        <input type="submit" value="Recuperar Contraseña" class='posbutrec' name='recuperar'/>
        
      </div>
      <h3 id="optionreturn" >--¿Desea regresar al inicio del aplicativo?--</h3>
      <br><br>
      <a href="../index.php" id="posbutreg">Regresar</a>
     </form>
  </div> 
</body>
</html>

<?php
  
if (isset($_POST['recuperar'])) {

  include_once"controller.php";
  $correo = $_POST['correo'];

  $sentencia = $db->prepare("SELECT * FROM admin WHERE correo = ?;");
  $sentencia->execute([$correo]);
  $res = $sentencia->fetchObject();

  if (!$res) {
      echo "<script>alert('Error, ¡el correo ingresado no existe!')</script>";
      exit();
  }else{
      
        //para crear un token de seguridad
    function generandoTokenClave($length = 20) {
        return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklymopkz', ceil($length/strlen($x)) )),1,$length);
    }
    $miTokenClave     = generandoTokenClave();
    
    
    //Agregando Token en la tabla BD
    $sql = $db->prepare("UPDATE admin SET tokenUser = ? WHERE correo = ?;");
    $result = $sql->execute([$miTokenClave,$correo]);
    
    
    $linkRecuperar = "http://localhost/SIDICI0/vista/nuevaClave.php?id=".$res->idadmin."&tokenUser=".$miTokenClave;
    
    $destinatario = $correo; 
    $asunto       = "Recuperando Clave ";
    $cuerpo = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <title>Recuperar Clave de Usuario</title>';
    $cuerpo .= ' 
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: "Roboto", sans-serif;
            font-size: 16px;
            font-weight: 300;
            color: #888;
            background-color:rgba(230, 225, 225, 0.5);
            line-height: 30px;
            text-align: center;
        }
        .contenedor{
            width: 80%;
            min-height:auto;
            text-align: center;
            margin: 0 auto;
            background: #ececec;
            border-top: 3px solid #E64A19;
        }
        .btnlink{
            padding:15px 30px;
            text-align:center;
            background-color:#cecece;
            color: crimson !important;
            font-weight: 600;
            text-decoration: blue;
        }
        .btnlink:hover{
            color: #fff !important;
        }
        .imgBanner{
            width:100%;
            margin-left: auto;
            margin-right: auto;
            display: block;
            padding:0px;
        }
        .misection{
            color: #34495e;
            margin: 4% 10% 2%;
            text-align: center;
            font-family: sans-serif;
        }
        .mt-5{
            margin-top:50px;
        }
        .mb-5{
            margin-bottom:50px;
        }
        </style>
    ';
    
    $cuerpo .= '
    </head>
    <body>
        <div class="contenedor">
        <img class="imgBanner" src="https://permutasalcuadrado.com/Como-recuperar-clave-de-usuario-usando-PHP-y-MYSQL/assets/images/banner2.png">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
        <table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
        <tr>
            <td style="padding: 0">
                <img style="padding: 0; display: block" src="https://permutasalcuadrado.com/Como-recuperar-clave-de-usuario-usando-PHP-y-MYSQL/assets/images/banner.jpg" width="100%">
            </td>
        </tr>
        
        <tr>
            <td style="background-color: #ffffff;">
                <div class="misection">
                    <h2 style="color: red; margin: 0 0 7px">Hola, '.$res->correo.'</h2>
                    <p style="margin: 2px; font-size: 18px">entra en el link para que puedas recuperar tu clave </p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <a href='.$linkRecuperar.' class="btnlink">Recuperar mi clave</a>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <img style="padding: 0; display: block" src="https://permutasalcuadrado.com/Como-recuperar-clave-de-usuario-usando-PHP-y-MYSQL/assets/images/work.gif" width="100%">
                    <p>&nbsp;</p>
                </div>
            </td>
        </tr>
        <tr>
            <td style="background-color: #ffffff;">
            <div class="misection">
                <h2 style="color: red; margin: 0 0 7px">Visitar Canal de Youtube</h2>
                <img style="padding: 0; display: block" src="https://permutasalcuadrado.com/Como-recuperar-clave-de-usuario-usando-PHP-y-MYSQL/assets/images/canal.png" width="100%">
            </div>
            
            <div class="mb-5 misection">  
              <p>&nbsp;</p>
                <a href="https://www.youtube.com/channel/UCodSpPp_r_QnYIQYCjlyVGA" class="btnlink">Visitar Canal </a>
            </div>
            </td>
        </tr>
        <tr>
            <td style="padding: 0;">
                <img style="padding: 0; display: block" src="https://permutasalcuadrado.com/Como-recuperar-clave-de-usuario-usando-PHP-y-MYSQL/assets/images/footer.png" width="100%">
            </td>
        </tr>
    </table>'; 
    
    $cuerpo .= '
          </div>
        </body>
      </html>';
        
        $headers  = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        $headers .= "From: CIDICI\r\n"; 
        $headers .= "Reply-To: "; 
        $headers .= "Return-path:"; 
        $headers .= "Cc:"; 
        $headers .= "Bcc:";
        if(mail($destinatario,$asunto,$cuerpo,$headers)){
          echo "<script>alert('Se Envio a tu correo el Link de restablecimiento para la clave')</script>";
          echo "correo = ".$destinatario."<br>";
          echo "asunto = ".$asunto."<br>";
          echo "headers = ".$headers."<br>";
          exit();
        }
    
    }
    
}
?>
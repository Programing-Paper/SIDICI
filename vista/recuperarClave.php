<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../SMTP/Exception.php';
require '../SMTP/PHPMailer.php';
require '../SMTP/SMTP.php';

include_once"controller.php";
$correo = $_POST['correo'];

$sentencia = $db->prepare("SELECT * FROM admin WHERE correo = ?;");
$sentencia->execute([$correo]);
$res = $sentencia->fetchObject();

$empleado = $db->prepare("SELECT * FROM empleados WHERE idempleado = ?;");
$empleado ->execute([$res->idempleado]);
$resEmpleado  = $sentencia->fetchObject();

if (!$res) {
    session_start();
    $_SESSION['alerterror'] = "¡el correo ingresado no existe!";
    header('location: recuperar-contra.php');
    // echo "<script>alert('Error, ¡el correo ingresado no existe!')</script>";
    exit();
}else{
    
      //para crear un token de seguridad
  function generandoTokenClave($length = 20) {
      return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklymopkz', ceil($length/strlen($x)) )),1,$length);
  }
  $miTokenClave = generandoTokenClave();

  
  //Agregando Token en la tabla BD
  $sql = $db->prepare("UPDATE admin SET tokenUser = ? WHERE correo = ?;");
  $result = $sql->execute([$miTokenClave,$correo]);
  
  $linkRecuperar = "https://sidici.mservers.ovh/vista/nuevaClave.php?id=".$res->idadmin."&tokenUser=".$miTokenClave;
  
  $destinatario = $correo; 
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = 0;                      // debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.intrustservices.co';                     // SMTP server to send through
    $mail->SMTPAuth   = true;                                   // SMTP authentication
    $mail->Username   = 'noreply@amovil.com.co';                     //SMTP username
    $mail->Password   = 'Amovil.2021$';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('noreply@amovil.com.co', 'SIDICI');
    $mail->addAddress($correo, 'SIDICI');     //Add a recipient              //Name is optional
    $mail->addReplyTo('noreply@amovil.com.co', 'Pruebas');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Recuperando Clave ";
    $cuerpo = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <title>Recuperar Clave de Usuario</title>';
    $cuerpo .= '
    <style>
    *{
        padding: 0px;
        margin: 0px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
    
    .contentpadre{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100vh;
        background: #373B44; 
        background: -webkit-linear-gradient(to right, #4286f4, #373B44);
        background: linear-gradient(to right, #4286f4, #373B44);
    }
    
    .contenthijo{
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        width: 60%;
        height: 100vh;
        background-color: rgba(224, 234, 239, 0.8);
    }
       
    .contenthijo div {
        margin-top: 3%;
    }
    
    .btncorreo {
        margin-top: 20%;
    }
    
    .btncorreo a{
        padding: 10px;
        font-size: 20px;
        border-radius: 5px;
        color: rgb(255, 255, 255);
        text-decoration: none;
        background-color: #1d8ee5;
    }
    
    
    .btncorreo a:hover{
        background-color: #001b53;
    }
    
    @media (max-width: 600px) {
        .contenthijo{
            width: 100%;
        }
    
    }
    </style>
    ';
    
    $cuerpo .= '
    </head>
    <body class="contentpadre">
    <div class="contenthijo">
        <h1>Recuperar cuenta SIDICI</h1><br>
        <h2>Hola '.$res->correo.'</h2>
        <p>Te enviamos este correo porque olvidaste tu clave
            si no fuiste tu ignora este mensaje. <strong>Para cambiar la clave presiona en cambiar clave.</strong></p><br>
        <div class="btncorreo">
            <a href='.$linkRecuperar.'>Cambiar clave </a>
        </div><br>
        <h2>Ingresa a nuestra web</h2>
        <div class="btncorreo">
            <a href="https://web.amovil.co/">Pagina web Amovil</a>
        </div>'; 
    
    $cuerpo .= '
        </div>
        </body>
      </html>';
    $mail->Body    = $cuerpo;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    session_start();
    $_SESSION['correoenviado'] = "!Mensaje enviado, revisa tu correo para que realices la restauracion de tu clave¡";
    header("location: ../index.php");

} catch (Exception $e) {
    echo "!Ponte en contacto con el administrador!. Error: {$mail->ErrorInfo}";
}

}


//aca esta lo que no queria
  // <tr>
        //     <td style="padding: 0;">
        //         <img style="padding: 0; display: block" src="https://permutasalcuadrado.com/Como-recuperar-clave-de-usuario-usando-PHP-y-MYSQL/assets/images/footer.png" width="100%">
        //     </td>
        // </tr>

<?php

include('controller.php');

if (!empty($_POST['iduser'])) { 

  echo 'entro aqui';

  session_start();

  $estado = $_POST['estado'];
  $idadmin = $_POST['iduser'];
  

  $data = $db->query("SELECT * from admin where idadmin='$idadmin'");
  $rows = $data->fetch(PDO::FETCH_OBJ);
  
  if($estado == 1){
    $estado= 0;
  }else if($estado == 0){
    $estado = 1;
  }

  $update = $db->prepare("UPDATE admin set id_estadoemp = :name where idadmin = '$idadmin'");
  $update->execute([':name' => $estado]);

  $_SESSION['alertsucces'] = "Se actualizo el estado del administrador";
  header('location: configuracion.php?page=configuracion&pag=1');

}

?>

<?php

if (isset($_POST['idadmin'])) {

  session_start();

  $idadmin = $_POST['idadmin'];
  $perfil = $_FILES['newimg'];
  $nameimg = $_POST['nameimg'];
  $correo = $_POST["correo"];

  if (isset($_FILES['newimg']['name']) AND !empty($_FILES['newimg']['name'])){
    
    echo'entro aqui';
    $img_name = $_FILES['newimg']['name'];
    $img_size = $_FILES['newimg']['size'];
    $tmp_name = $_FILES['newimg']['tmp_name'];
    $error = $_FILES['newimg']['error'];

    if ($error === 0) {
      $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
      $img_ex_to_ic = strtolower($img_ex);

      $allowed_exs = array('jpg', 'jpeg', 'png');
      if (in_array($img_ex_to_ic, $allowed_exs)) {
        $new_img_name = uniqid($correo, true) . '.' . $img_ex_to_ic;
        $img_upload_path = '../uploads/' . $new_img_name;
        // eliminar antigua imagen
        $antiguaimg = "../uploads/$nameimg";
      
        if($nameimg != "gestion.jpg"){

          if (unlink($antiguaimg)) {
            // solo eliminar
            move_uploaded_file($tmp_name, $img_upload_path);
          } else {
            // error o ya borrado
            move_uploaded_file($tmp_name, $img_upload_path);
          }
        } else {
          // error o ya borrado
          move_uploaded_file($tmp_name, $img_upload_path);
        }


        include_once "controller.php";

        $sql = $db->prepare("UPDATE admin set perfil = ? where idadmin = '$idadmin';");
        $result = $sql->execute([$new_img_name]);

        $_SESSION['alertsucces'] = "Se cambio la imagen correctamente";
        header('location: configuracion.php?page=configuracion&pag=1');

        $data = $db->query("SELECT * from admin where idadmin='$idadmin'");
        $rows = $data->fetch(PDO::FETCH_OBJ);

        $correoActual = $_POST["correo"];
        $updateCorreo = $_POST["updatecorreo"];
        $passActual = $rows->pass;
        $password = $_POST["password"];

        $sentence = $db->query("SELECT correo FROM admin where correo = '$updateCorreo'");
        $resultado = $sentence->fetchObject();
    
        if(!empty($resultado)) {

          $_SESSION['alerterror'] = "El correo por el que intenta cambiar ya esta registrado!";
          header('location: configuracion.php?page=configuracion&pag=1');
          exit();

        } else {

          if ($correoActual == $rows->correo and $password == $passActual) {

            include_once "controller.php";
            $update = $db->prepare("UPDATE admin set correo = :name where idadmin = '$idadmin'");
  
            $update->execute([':name' => $updateCorreo]);
  
            $_SESSION['alertsucces'] = "Se actualizaron los datos correctamente";
            header('location: configuracion.php?page=configuracion&pag=1');
          } 
        }
      }      
    } 
  } else {

    if ( empty($_POST['password']) and empty($_POST['updatepass']) and empty($_POST['confirmpass'])){

      $_SESSION['alerterror'] = "Los campos estan vacios!";
      header('location: configuracion.php?page=configuracion&pag=1');
      
    } else {

      $data = $db->query("SELECT * from admin where idadmin='$idadmin'");
      $rows = $data->fetch(PDO::FETCH_OBJ);
  
      $correoActual = $_POST["correo"];
      $updateCorreo = $_POST["updatecorreo"];
      $passActual = $rows->pass;
      $password = $_POST["password"];

      $sentence = $db->query("SELECT correo FROM admin where correo = '$updateCorreo'");
      $resultado = $sentence->fetchObject();
  
      if(!empty($resultado)) {

        $_SESSION['alerterror'] = "El correo por el que intenta cambiar ya esta registrado!";
        header('location: configuracion.php?page=configuracion&pag=1');
        exit();

      } else {

        if ($correoActual == $rows->correo and $password == $passActual) {
  
          $update = $db->prepare("UPDATE admin set
                  correo = :name where idadmin = '$idadmin'");
    
          $update->execute([':name' => $updateCorreo]);
    
          $_SESSION['alertsucces'] = "Se actualizo el correo correctamente";
          header('location: configuracion.php?page=configuracion&pag=1');
          exit();   
        } else {
          $_SESSION['alerterror'] = "Verifica los campos y vuelve a intentarlo";
          header('location: configuracion.php?page=configuracion&pag=1');
        }
      }
    }
  }
} else {

  if (isset($_POST['registrar'])) {

    session_start();
  
    $perfil = $_FILES['perfil'];
    $activo = $_POST['activo'];
    $correo = strtolower($_POST["correo"]);
    $idempleado = $_POST['idempleado'];
    $idadmin = $_POST['adminid'];
    $clave = $_POST['clave'];
    $confirClave = $_POST['confirClave'];
  
    if (strlen($correo) > 50 || strlen($correo) < 10) {
      $_SESSION['alerterror'] = "Error, el correo debe tener un minimo de 10 caracteres o un maximo de 50";
      header('location: configuracion.php?page=configuracion&pag=1');
      exit();

    } elseif (strlen($clave) > 30 || strlen($clave) < 4) {
      $_SESSION['alerterror'] = "Error, la clave debe tener un minimo de 4 caracteres o un maximo de 30";
      header('location: configuracion.php?page=configuracion&pag=1');
      exit();
    }
    if ($confirClave != $clave) {
      $_SESSION['alerterror'] = "Error, por favor valide que la clave y la confirmacion sean iguales";
      header('location: configuracion.php?page=configuracion&pag=1');
      exit();

    } else {
      if (isset($_FILES['perfil']['name'])) {
  
        $img_name = $_FILES['perfil']['name'];
        $img_size = $_FILES['perfil']['size'];
        $tmp_name = $_FILES['perfil']['tmp_name'];
        $error = $_FILES['perfil']['error'];
  
        if ($error === 0) {
          $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_ex_to_ic = strtolower($img_ex);
  
          $allowed_exs = array('jpg', 'jpeg', 'png');
          if (in_array($img_ex_to_ic, $allowed_exs)) {
            $new_img_name = uniqid($correo, true) . '.' . $img_ex_to_ic;
            $img_upload_path = '../uploads/' . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            $sentence = $db->query("SELECT correo FROM admin where correo = '$correo'");
            $resultado = $sentence->fetchObject();
        
            if(!empty($resultado)) {

                #No existe
                $_SESSION['alerterror'] = "El correo que intenta Registrar ya existe!";
                header('location: configuracion.php?page=configuracion&pag=1');
                exit();

            } else {

              include_once "controller.php";
              $sql = $db->prepare("INSERT INTO admin(idempleado,correo,pass,id_estadoemp,perfil) 
                                  VALUES(?,?,?,?,?);");
              $result = $sql->execute([$idempleado, $correo, $clave, $activo, $new_img_name]);
    
              if (!$result) {
                #No existe
                $_SESSION['alerterror'] = "Porfavor valide que los datos son correctos";
                header('location: configuracion.php?page=configuracion&pag=1');
                exit();
              } else {
                $_SESSION['alertsucces'] = "Registro exitoso";
                header('location: configuracion.php?page=configuracion&pag=1');
              }
            }
          }
        } else {

          $sentence = $db->query("SELECT correo FROM admin where correo = '$correo'");
          $resultado = $sentence->fetchObject();
      
          if(!empty($resultado)) {

            $_SESSION['alerterror'] = "El correo que intenta Registrar ya existe!";
            header('location: configuracion.php?page=configuracion&pag=1');
            exit();

          } else {

            include_once "controller.php";
  
            $sql = $db->prepare("INSERT INTO admin(idadmin,idempleado,correo,pass,id_estadoemp) 
                                VALUES(default,?,?,?,?);");
            $result = $sql->execute([$idempleado, $correo, $clave, $activo]);
      
            $_SESSION['alertsucces'] = "Se registro el usuario correctamente";
            header('location: configuracion.php?page=configuracion&pag=1');

          }
        }
      } else {
        $_SESSION['alerterror'] = "no se pudo hacer el registro, vuelve a intentarlo";
        header('location: configuracion.php?page=configuracion&pag=1');
        exit();
      }
    }
  }
}


?>
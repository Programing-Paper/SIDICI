<?php
$idadmin = $_POST['idadmin'];
  $tokenUser = $_POST['tokenUser'];
  $clave = $_POST['clave'];
  $confirClave = $_POST['confirClave'];
  if ($confirClave != $clave) {
      echo "<script>alert('Error, por favor valide que la clave y la confirmacion sean iguales');
      window.location.href= 'nuevaClave.php?id=$idadmin&tokenUser=$tokenUser'</script>";
      exit();
  }
  else{
      include_once"controller.php";
      $sql = $db->prepare("UPDATE admin SET pass  = ?, tokenUser = ''  WHERE idadmin = ?;");
      $res = $sql->execute([$clave,$idadmin]);
      if (!$res) {
          #No existe
          echo "<script>alert('Error, por favor valide que los datos son correctos')</script>";
          exit();
      }else {
        echo "<script>alert('!Restauracion exitosa¡'); window.location.href= '../index.php'</script>";
      }

   }
?>
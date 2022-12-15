<?php
    
    $idadmin = $_POST['idadmin'];
    $correo = $_POST["correo"];
    $updatecorreo = $_POST['updatecorreo'];
    $pass = $_POST['password'];

        include_once"controller.php";
        $sql = $db->query("SELECT * from admin where correo = '$correo' and pass = '$pass'");
        $result = $sql->fetchAll(PDO::FETCH_OBJ);

        if (!$result) {
            $usuario = $_GET['usu'];
            echo "<script>alert('Error, por favor valide que los datos son correctos');
            window.location.href='configuracion.php?page=configuracion&id=$idadmin&usu=$usuario'</script>";
            exit();
        }else {
            $sql = $db->prepare("UPDATE admin SET correo  = ?  WHERE idadmin = ?;");
            $res = $sql->execute([$updatecorreo,$idadmin]);
            echo "<script>alert('Registro exitoso'); window.location.href= '../index.php'</script>";
            
        }
    

    


?>
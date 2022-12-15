<?php
$tipo = $_GET['guardar'];
if ($tipo=='novedad') {
    
    session_start();

    if (
    !isset($_POST['descripcion']) || !isset($_POST['fecha']) ||
    !isset($_POST['idempleado']) || !isset($_POST['idactivo'])) {
    exit();
    }
    include_once"controller.php";

    // $id_novedad = $_POST['id_novedad'];
    $fecha = $_POST['fecha'];
    $descripcion=$_POST['descripcion'];
    $idempleado=$_POST['idempleado'];
    $idactivo = $_POST['idactivo'];
    $usuario = $_GET['usu'];
    $resuelto = 'NO';

    $sql= $db->prepare("INSERT INTO novedades(descripcion,fecha,idactivo,idempleado,resuelto) 
                    VALUES(?,?,?,?,?);");
    $result= $sql->execute([$descripcion,$fecha,$idactivo,$idempleado,$resuelto]);
    if (!$result) {
        #No existe
        $_SESSION['alerterror'] = "Porfavor valide que los datos son correctos";
        header("Location: novedades.php?page=novedades&usu=".$usuario."&pag=1");
        exit();
    }else {
        $sql= $db->prepare("INSERT INTO movimientos(idempleado,idactivo,fechaint,fechaout,descripcion) 
        VALUES(?,?,?,?,?);");
        $result= $sql->execute([$idempleado,$idactivo,$fecha,$fecha,$descripcion]);

        $_SESSION['alertsucces'] = "Se registro la novedad correctamente";
        header("Location: novedades.php?page=novedades&usu=".$usuario."&pag=1");
        
    }
}elseif ($tipo=='activo') { 
    
    session_start();

    if (!isset($_POST['activo']) || !isset($_POST['estado']) || !isset($_POST['serie']) ||
        !isset($_POST['so']) || !isset($_POST['marca']) || !isset($_POST['tipo']) ||
        !isset($_POST['fecha']) || !isset($_POST['caract']) || !isset($_POST['idempleado'])) {
    exit();
    }
    include_once"controller.php";

    $activo = $_POST['activo'];
    $idempleado = $_POST['idempleado'];
    $estado = $_POST['estado'];
    $serie=$_POST['serie'];
    $so=$_POST['so'];
    $marca = $_POST['marca'];
    $tipo = $_POST['tipo'];
    $fecha = $_POST['fecha'];
    $caract=$_POST['caract'];
    $usuario = $_GET['usu'];


    $sentence = $db->query("SELECT *FROM activos where idactivo = '$activo'");
    $resultado = $sentence->fetchObject();

    if(!empty($resultado)){

        $_SESSION['alerterror'] = "El activo ingresado ya existe!";
        header("Location: activos.php?page=activos&usu=".$usuario."&pag=1");       
        exit();

    } else {
        
        $sql= $db->prepare("INSERT INTO activos(idactivo,idempleado,id_estadoact,serial,so,marca,tipo,fecha,observaciones,estado) 
                        VALUES(?,?,?,?,?,?,?,?,?,?);");
        $result= $sql->execute([$activo,$idempleado,$estado,$serie,$so,$marca,$tipo,$fecha,$caract,'Creado']);
        if (!$result) {
            #No existe
            $_SESSION['alerterror'] = "Porfavor valide que los datos son correctos";
            header("Location: activos.php?page=activos&usu=".$usuario."&pag=1");
            exit();
        }else {
            $sql= $db->prepare("INSERT INTO movimientos(idempleado,idactivo,fechaint,fechaout,descripcion) 
            VALUES(?,?,?,?,?);");
            $result= $sql->execute([$idempleado,$activo,$fecha,$fecha,$caract]);

            $_SESSION['alertsucces'] = "Se registró el activo correctamente";
            header("Location: activos.php?page=activos&usu=".$usuario."&pag=1");
        
        }
    }

}elseif ($tipo=='usuarios') {

    session_start();

    if (!isset($_POST['idempleado']) || !isset($_POST['nombre']) || !isset($_POST['telefono']) ||
        !isset($_POST['id_cargo']) || !isset($_POST['id_compania']) || !isset($_POST['direccion']) ||
        !isset($_POST['id_estadoemp']) ) {
            echo "entro aca";
    exit();
    }
    include_once"controller.php";

    $idempleado = $_POST['idempleado'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $id_cargo=$_POST['id_cargo'];
    $id_compania = $_POST['id_compania'];
    $direccion=$_POST['direccion'];
    $id_estadoemp = $_POST['id_estadoemp'];
    $usuario = $_GET['usu'];

    $sentence = $db->query("SELECT *FROM empleados where idempleado = '$idempleado'");
    $resultado = $sentence->fetchObject();

    if(!empty($resultado)) {
        #No existe
        $_SESSION['alerterror'] = "Ya existe un empleado con ese documento!";
        header("Location: usuarios.php?page=usuarios&usu=".$usuario."&pag=1");
        exit();
    } else {

        $sql= $db->prepare("INSERT INTO empleados(idempleado,nombre,telefono,id_cargo,id_compania,direccion,id_estadoemp) 
                        VALUES(?,?,?,?,?,?,?);");
        $result= $sql->execute([$idempleado,$nombre,$telefono,$id_cargo,$id_compania,$direccion,$id_estadoemp]);
        if (!$result) {
            #No existe
            $_SESSION['alerterror'] = "por favor valide que el usuario es correctos";
            header("Location: usuarios.php?page=usuarios&usu=".$usuario."&pag=1");
            exit();
        }else {
            $_SESSION['alertsucces'] = "Se registro el empleado correctamente";
            header("Location: usuarios.php?page=usuarios&usu=".$usuario."&pag=1");        
        }
    }
    
}elseif($tipo== "actualizaractivo"){
    
    session_start();

    echo "<script>alert('si ingresa')</script>";
    $idactivo = $_POST["idactivo"];
    $idempleado = $_POST['idempleado'];
    $fecha = $_POST['fecha'];
    $usuario = $_GET['usu'];

    include_once"controller.php";

    $sql = $db->prepare("UPDATE activos SET idempleado = ?,fecha = ?,estado = ? WHERE idactivo = ?;");
    $res = $sql->execute([$idempleado,$fecha,'Asignado',$idactivo]);
     if (!$res) {
         #No existe
         $_SESSION['alerterror'] = "Error, por favor valide que el usuario es correctos";
         header('location: activos.php?page=activos&usu=$usuario&pag=1');
         exit();
     }else {
        $_SESSION['alertsucces'] = "Se asigno el activo correctamente";
        header("location: activos.php?page=activos&usu=$usuario&pag=1");
     }
}

?>
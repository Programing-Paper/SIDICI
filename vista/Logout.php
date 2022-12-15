<?php

# Limpiar cadenas de texto #
function limpiar_cadena($cadena){
	$cadena=trim($cadena);
	$cadena=stripslashes($cadena);
	$cadena=str_ireplace("<script>", "", $cadena);
	$cadena=str_ireplace("</script>", "", $cadena);
	$cadena=str_ireplace("<script src", "", $cadena);
	$cadena=str_ireplace("<script type=", "", $cadena);
	$cadena=str_ireplace("SELECT * FROM", "", $cadena);
	$cadena=str_ireplace("DELETE FROM", "", $cadena);
	$cadena=str_ireplace("INSERT INTO", "", $cadena);
	$cadena=str_ireplace("DROP TABLE", "", $cadena);
	$cadena=str_ireplace("DROP DATABASE", "", $cadena);
	$cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
	$cadena=str_ireplace("SHOW TABLES;", "", $cadena);
	$cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
	$cadena=str_ireplace("<?php", "", $cadena);
	$cadena=str_ireplace("?>", "", $cadena);
	$cadena=str_ireplace("--", "", $cadena);
	$cadena=str_ireplace("^", "", $cadena);
	$cadena=str_ireplace("<", "", $cadena);
	$cadena=str_ireplace("[", "", $cadena);
	$cadena=str_ireplace("]", "", $cadena);
	$cadena=str_ireplace("==", "", $cadena);
	$cadena=str_ireplace(";", "", $cadena);
	$cadena=str_ireplace("::", "", $cadena);
	$cadena=trim($cadena);
	$cadena=stripslashes($cadena);
	return $cadena;
}


if (!isset($_POST['usuario']) || !isset($_POST['contrasena'])) {
    exit();
}

include_once "controller.php";

$usuario = strtolower($_POST['usuario']);
$contrasena = limpiar_cadena($_POST['contrasena']);
$ingresar = limpiar_cadena($_POST['ingresar']);
 


if (isset($_POST['ingresar'])) {

    session_start();

    $sentencia = $db->prepare("SELECT * FROM admin WHERE correo = ? and pass = ?;");
    $sentencia->execute([$usuario, $contrasena]);
    $res = $sentencia->fetchObject();

	$estado= $res->id_estadoemp;

	if (!$res) { 
		//  No existe 
		  $_SESSION['erroruser'] = "Porfavor valide que el usuario o contraseña son correctos.";
		  header('location: ../index.php');
		exit();
	} else if($estado == 1){
		$_SESSION['id'] = $res->idadmin;
		$_SESSION['correo'] = $res->correo;
		$_SESSION['password'] = $res->pass;
		$_SESSION['perfil'] = $res->perfil;

		if (headers_sent()) {
			echo "<script>window.location.href=' principal.php?page=principal&usu=$res->correo'</script>";
		} else {
			header('location: principal.php');
		}
	} else {
		$_SESSION['erroruser'] = "El usuario esta desactivado.";
		header('location: ../index.php');
	}
}


?>
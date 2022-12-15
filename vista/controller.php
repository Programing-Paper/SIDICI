<?php

$usuario="Jrodriguez";
$host= "ssh.mservers.ovh";
$port="5432";
$dbname="SIDICI";
$passw="Amovil.2022$";
try {
    $db= new PDO("pgsql:host=$host;port=$port;dbname=$dbname",$usuario,$passw);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "conexion exitosa";
} catch (Exception $th) {
    echo "error en la conexion".$th;
}

?>
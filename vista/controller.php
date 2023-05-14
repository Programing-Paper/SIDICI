<?php

$usuario="postgres";
$host= "localhost";
$port="5432";
$dbname="SIDICI";
$passw="origami123";
try {
    $db= new PDO("pgsql:host=$host;port=$port;dbname=$dbname",$usuario,$passw);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "conexion exitosa";
} catch (Exception $th) {
    echo "error en la conexion".$th;
}

?>
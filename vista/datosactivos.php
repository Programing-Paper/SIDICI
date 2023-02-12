<?php
// Datos de conexión a la base de datos
$host = 'localhost';
$user = 'postgres';
$password = 'origami123';
$dbname = 'SIDICI';

// Establecemos la conexión a la base de datos
$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

// Verificamos si la conexión fue exitosa
if (!$conn) {
    // La conexión falló, mostramos un mensaje de error
    echo 'Error de conexión a la base de datos.';
    exit;
}

// Si la conexión fue exitosa, continuamos con nuestro script

// Obtenemos los parámetros que nos envía DataTables
$start = $_POST['start'];
$length = $_POST['length'];
$search = $_POST['search']['value'];

// Creamos la consulta SQL
$query = "SELECT a.*,e.nombre,em.nombre as empleado FROM activos a, estado_activos e, empleados em WHERE a.id_estadoact = e.id_estadoact and a.idempleado = em.idempleado and concat(a.idactivo, ' ', e.nombre, ' ', a.serial, ' ', a.marca, ' ', a.so, ' ', a.tipo, ' ', a.fecha,  ' ', a.estado) ILIKE '%$search%' LIMIT $length OFFSET $start";

// Ejecutamos la consulta y guardamos el resultado en una variable
$result = pg_query($conn, $query);

// Verificamos si la consulta fue exitosa
if (!$result) {
    // La consulta falló, mostramos un mensaje de error
    echo 'Error en la consulta.';
    exit;
}

// Si la consulta fue exitosa, obtenemos el total de filas que cumplen la condición
$totalFilas = pg_fetch_row(pg_query($conn, "SELECT COUNT(*) FROM activos WHERE idactivo LIKE '%$search%'"))[0];

// Obtenemos todos los resultados de la consulta en un array

$data = pg_fetch_all($result);

$usuario='';
if (isset($_GET['usu'])) {
    $usuario= $_GET['usu'];
}

foreach ($data as &$fila) {

    $fila['editar'] = '<a href="editarActivos.php?page=editaractivo&id=' . $fila['idactivo'] . '&usu='.$usuario.'"><i class="bi bi-pencil-square textwhite"></i></a>';
}

// Creamos el array de respuesta que devolveremos a DataTables
$response = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $totalFilas,
    'recordsFiltered' => $totalFilas,
    'data' => $data
);

// Convertimos el array de respuesta a formato JSON
$json = json_encode($response);

// Devolvemos la respuesta a DataTables
echo $json;

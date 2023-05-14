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
$query = "SELECT n.*,e.nombre,a.marca,a.tipo FROM novedades n, empleados e, activos a 
WHERE n.idempleado = e.idempleado AND n.idactivo = a.idactivo and concat(n.id_novedad, ' ', n.descripcion, ' ', e.nombre, ' ', n.fecha, ' ', a.marca, ' ', a.tipo) ILIKE '%$search%' LIMIT $length OFFSET $start";

// Ejecutamos la consulta y guardamos el resultado en una variable
$result = pg_query($conn, $query);

// Verificamos si la consulta fue exitosa
if (!$result) {
    // La consulta falló, mostramos un mensaje de error
    echo 'Error en la consulta.';
    exit;
}

// Si la consulta fue exitosa, obtenemos el total de filas que cumplen la condición
$totalFilas = pg_fetch_row(pg_query($conn, "SELECT COUNT(*) FROM novedades WHERE id_novedad LIKE '%$search%'"))[0];

// Obtenemos todos los resultados de la consulta en un array

$data = pg_fetch_all($result);

$usuario='';
if (isset($_GET['usu'])) {
    $usuario= $_GET['usu'];
}


foreach ($data as &$fila) {

    // $cerrado = $fila['resuelto'] == 'SI' ? 'Resuelto' : 'Editar';
    // $views = $fila['resuelto'] == 'SI' ? 'disabled' : '';
    $views = $fila['resuelto'] == 'SI' ? '' : 'href=';
    $icon = $fila['resuelto'] == 'SI' ? 'bi bi-check-square textwhite' : 'bi bi-pencil-square textwhite';
    $fila['activo'] = $fila['marca'] . '-' . $fila['tipo'];

    $fila['editar'] = '<a '.$views.'"editarNovedad.php?page=editaractivo&id=' . $fila['id_novedad'] . '&usu='.$usuario.'"><i class="'.$icon.'"></i></a>';
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

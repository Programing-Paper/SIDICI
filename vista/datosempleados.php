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
$query = "SELECT e.*,c.nomcargo,d.ciudad, emp.nombre as esnombre FROM empleados e, cargo c, ciudad d, estado_empleados emp
WHERE e.id_cargo = c.id_cargo AND e.id_compania = d.id_compania and e.id_estadoemp = emp.id_estadoemp and concat(e.idempleado, ' ', e.nombre, ' ', c.nomcargo, ' ', emp.nombre, ' ', d.ciudad, ' ', e.telefono) ILIKE '%$search%' LIMIT $length OFFSET $start";

// Ejecutamos la consulta y guardamos el resultado en una variable
$result = pg_query($conn, $query);

// Verificamos si la consulta fue exitosa
if (!$result) {
    // La consulta falló, mostramos un mensaje de error
    echo 'Error en la consulta.';
    exit;
}

// Si la consulta fue exitosa, obtenemos el total de filas que cumplen la condición
$totalFilas = pg_fetch_row(pg_query($conn, "SELECT COUNT(*) FROM empleados WHERE idempleado LIKE '%$search%'"))[0];

// Obtenemos todos los resultados de la consulta en un array

$data = pg_fetch_all($result);

$usuario='';
if (isset($_GET['usu'])) {
    $usuario= $_GET['usu'];
}

foreach ($data as &$fila) {
  
    $fila['editar'] = '<form action="editarUsuario.php?page=editarusuarios&usu="'.$usuario.'"" method="POST">
                        <button type="submit" value="'.$fila['idempleado'].'" name="id" class="btn btn-primary btn-sm">editar</button>
                       </form>';
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

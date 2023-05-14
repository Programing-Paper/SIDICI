
<?php

function obtener_registros(){
    include('controller.php');
    $stmt = $db->prepare("SELECT * FROM activos");
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $stmt->fetchColumn();
}


?>

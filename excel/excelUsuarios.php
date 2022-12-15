<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Reporte_Usuarios.xls");

require_once('../vista/controller.php');

$sentencia = $db->query("SELECT e.*,c.nomcargo,d.ciudad, emp.nombre as esnombre FROM empleados e, cargo c, ciudad d, estado_empleados emp
WHERE e.id_cargo = c.id_cargo AND e.id_compania = d.id_compania and e.id_estadoemp = emp.id_estadoemp");
$result = $sentencia->fetchAll(PDO::FETCH_OBJ);

$back = 'style="background: gray;"';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Documento sin titulo</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
        <table style="width:1000px;" border="1" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="100" <?php echo $back ?>><div align="center">IDENTIFICACION DEL EMPLEADO</div></td>
                    <td width="200" <?php echo $back ?>><div align="center">NOMBRE </div></td>
                    <td width="100" <?php echo $back ?>><div align="center">TELEFONO</div></td>
                    <td width="200" <?php echo $back ?>><div align="center">CARGO</div></td>
                    <td width="100" <?php echo $back ?>><div align="center">CIUDAD</div></td>
                    <td width="200" <?php echo $back ?>><div align="center">DIRECCION</div></td>
                    <td width="100" <?php echo $back ?>><div align="center">ESTADO</div></td>
                </tr>
            <?php foreach($result as $res){ ?>
            <tr class="sc_texto">
            <td><div align="center"><?php echo $res->idempleado?></div></td>
            <td><div align="center"><?php echo $res->nombre?></div></td>
            <td><div align="center"><?php echo $res->telefono?></div></td>
            <td><div align="center"><?php echo $res->nomcargo?></div></td>
            <td><div align="center"><?php echo $res->ciudad?></div></td>
            <td><div align="center"><?php echo $res->direccion?></div></td>
            <td><div align="center"><?php echo $res->esnombre?></div></td>
            </tr>
            <?php } ?>
        </table>
</body>
</html>
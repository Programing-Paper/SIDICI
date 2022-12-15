<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Reporte_Novedades.xls");

require_once('../vista/controller.php');

$sentencia = $db->query("SELECT n.*,e.nombre,a.marca,a.tipo FROM novedades n, empleados e, activos a 
WHERE n.idempleado = e.idempleado AND n.idactivo = a.idactivo order by id_novedad");
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
                <td width="100" <?php echo $back ?>><div align="center">ID NOVEDAD</div></td>
                <td width="200" <?php echo $back ?>><div align="center">USUARIO AFECTADO </div></td>
                <td width="100" <?php echo $back ?>><div align="center">FECHA</div></td>
                <td width="100" <?php echo $back ?>><div align="center">NOMBRE ACTIVO</div></td>
                <td width="400" <?php echo $back ?>><div align="center">DESCRIPCIÓN</div></td>
                <td width="100" <?php echo $back ?>><div align="center">ESTADO</div></td>
            </tr>
            <?php foreach($result as $res){ ?>
            <tr class="sc_texto">
            <td><div align="center"><?php echo $res->id_novedad?></div></td>
            <td><div align="center"><?php echo $res->nombre?></div></td>
            <td><div align="center"><?php echo $res->marca."-".$res->tipo?></div></td>
            <td><div align="center"><?php echo $res->fecha?></div></td>
            <td><div align="center"><?php echo $res->descripcion?></div></td>
            <td><div align="center"><?php if ($res->resuelto == 'SI'){echo "Resuelto";}else{ echo "Abierto";} ?></div></td>
            </tr>
            <?php } ?>
        </table>
</body>
</html>
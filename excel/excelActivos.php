<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Reporte_Activos.xls");

require_once('../vista/controller.php');

$sentencia = $db->query("SELECT a.*,es.nombre AS estado,e.nombre FROM activos a, estado_activos es,empleados e 
        where a.id_estadoact = es.id_estadoact AND a.idempleado = e.idempleado order by idactivo ");
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
        <table style="width:1450px;" border="1" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="100" <?php echo $back ?>><div align="center">IDENTIFICACION DEL ACTIVO</div></td>
                    <td width="200" <?php echo $back ?>><div align="center">RESPONSABLE </div></td>
                    <td width="100" <?php echo $back ?>><div align="center">CEDULA</div></td>
                    <td width="100" <?php echo $back ?>><div align="center">ESTADO</div></td>
                    <td width="125" <?php echo $back ?>><div align="center">SERIAL</div></td>
                    <td width="125" <?php echo $back ?>><div align="center">SISTEMA OPERATIVO</div></td>
                    <td width="100" <?php echo $back ?>><div align="center">MARCA</div></td>
                    <td width="100" <?php echo $back ?>><div align="center">TIPO</div></td>
                    <td width="100" <?php echo $back ?>><div align="center">FECHA</div></td>
                    <td width="400" <?php echo $back ?>><div align="center">OBSERVACIONES</div></td>
                </tr>
            <?php foreach($result as $res){ ?>
            <tr>
            <td><div align="center"><?php echo $res->idactivo ?></div></td>
            <td><div align="center"><?php echo $res->nombre ?></div></td>
            <td><div align="center"><?php echo $res->idempleado ?></div></td>
            <td><div align="center"><?php echo $res->estado ?></div></td>
            <td><div align="center"><?php echo $res->serial ?></div></td>
            <td><div align="center"><?php echo $res->so ?></div></td>
            <td><div align="center"><?php echo $res->marca ?></div></td>
            <td><div align="center"><?php echo $res->tipo ?></div></td>
            <td><div align="center"><?php echo $res->fecha ?></div></td>
            <td><div align="center"><?php echo $res->observaciones ?></div></td>
            </tr>
            <?php } ?>
        </table>
</body>
</html>
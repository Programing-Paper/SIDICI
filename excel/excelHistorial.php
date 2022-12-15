<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Historial-Movimientos.xls");

require_once('../vista/controller.php');

$sentencia = $db->query("SELECT mov.*,act.marca,act.tipo,act.estado,ide.nombre FROM movimientos mov LEFT JOIN empleados ide ON mov.idempleado = ide.idempleado LEFT JOIN activos act ON mov.idactivo = act.idactivo");
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
                    <td width="100" <?php echo $back ?>><div align="center">MOVIMIENTO</div></td>
		    <td width="100" <?php echo $back ?>><div align="center">ESTADO</div></td>
                    <td width="200" <?php echo $back ?>><div align="center">NOMBRE </div></td>
                    <td width="100" <?php echo $back ?>><div align="center">CEDULA</div></td>
                    <td width="200" <?php echo $back ?>><div align="center">ACTIVO</div></td>
                    <td width="100" <?php echo $back ?>><div align="center">FECHA</div></td>
                    <td width="200" <?php echo $back ?>><div align="center">DESCRIPCIÓN</div></td>
                </tr>
            <?php foreach($result as $res){ ?>
            <tr class="sc_texto">
            <td><div align="center"><?php echo $res->idmovimiento?></div></td>
 	    <td><div align="center"><?php echo $res->estado?></div></td>
            <td><div align="center"><?php echo $res->nombre?></div></td>
            <td><div align="center"><?php echo $res->idempleado?></div></td>
            <td><div align="center"><?php echo $res->marca."-".$res->tipo?></div></td>
            <td><div align="center"><?php echo $res->fechaint?></div></td>
            <td><div align="center"><?php echo $res->descripcion?></div></td>
            </tr>
            <?php } ?>
        </table>
</body>
</html>
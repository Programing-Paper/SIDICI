<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Grafica novedades</title>

		<style type="text/css">
#container {
    height: 89vh;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

		</style>
	</head>
	<body>
<script src="code/highcharts.js"></script>
<script src="code/highcharts-3d.js"></script>
<script src="code/modules/export-data.js"></script>
<script src="code/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        <i>SIDICI. todos los derechos reservados @Amovil &#169 2016 - 2022 
    </p>
</figure>


		<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        
        text: 'Reporte grafico de Novedades hasta el dia: <?php $DateAndTime = date('d-m-Y'); echo $DateAndTime?>'
    },
    subtitle: {
        text: 'Mas información: ' +
            '<a href="https://web.amovil.co/"' +
            'target="_blank">Amovil</a>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Novedades',
        data: [
            <?php 
                require_once('../vista/controller.php');
                $sentencia = $db->query("SELECT e.nombre,c.nomcargo,n.idempleado FROM empleados e, novedades n, cargo c
                WHERE e.idempleado = n.idempleado AND e.id_cargo = c.id_cargo AND e.id_estadoemp = '1' 
                group by e.nombre, c.nomcargo, n.idempleado");

                while($rows = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                    $idempleado = $rows['idempleado'];
                    $sql = $db->query("SELECT count(*) FROM novedades WHERE idempleado = '$idempleado' ");
                    $novedades = $sql->fetchColumn();
            ?>
            ['<?php echo $rows['nombre']."-".$rows['nomcargo'] ?>', <?php echo $novedades ?>],
                <?php } ?>
        ]
    }],
    credits: {
        enabled: false
    }
});
		</script>
	</body>
</html>

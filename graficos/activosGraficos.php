<?php 
require_once('../vista/controller.php');

$sql = $db->query("SELECT count(*) FROM activos WHERE id_estadoact = '1' ");
$nuevo = $sql->fetchColumn();

$sql = $db->query("SELECT count(*) FROM activos WHERE id_estadoact = '2' ");
$usado = $sql->fetchColumn();

$sql = $db->query("SELECT count(*) FROM activos WHERE id_estadoact = '3' ");
$reparado = $sql->fetchColumn();

$sql = $db->query("SELECT count(*) FROM activos WHERE id_estadoact = '4' ");
$disponible = $sql->fetchColumn();

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Grafica activos</title>

		<style type="text/css">
.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
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
<script src="code/modules/export-data.js"></script>
<script src="code/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
       <i>SIDICI. todos los derechos reservados @Amovil &#169 2016 - 2022     </p>
</figure>



		<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Reporte grafico de Activos hasta el dia: <?php $DateAndTime = date('d-m-Y'); echo $DateAndTime?>'
    },
    subtitle: {
        text: 'Mas información: ' +
            '<a href="https://web.amovil.co/"' +
            'target="_blank">Amovil</a>'
    },
    xAxis: {
        categories: ['Nuevo', 'Usado', 'Reparado', 'Disponible'],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Reporte (Activos)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' Activos'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Nuevo',
        data: [<?php echo $nuevo?>, '', '', '']
    }, {
        name: 'Usado',
        data: ['', <?php echo $usado?>, '', '']
    }, {
        name: 'Reparado',
        data: ['', '', <?php echo $reparado?>, '']
    }, {
        name: 'Disponible',
        data: ['', '', '', <?php echo $disponible?>]
    }],
    credits: {
        enabled: false
    }

});

		</script>
	</body>
</html>

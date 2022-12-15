<?php include('header.php');


$sql = $db->query("SELECT count(*) FROM activos WHERE id_estadoact = '1' ");
$nuevo = $sql->fetchColumn();

$sql = $db->query("SELECT count(*) FROM activos WHERE id_estadoact = '2' ");
$usado = $sql->fetchColumn();

$sql = $db->query("SELECT count(*) FROM activos WHERE id_estadoact = '3' ");
$reparado = $sql->fetchColumn();

$sql = $db->query("SELECT count(*) FROM activos WHERE id_estadoact = '4' ");
$disponible = $sql->fetchColumn();

$sql = $db->query("SELECT count(*) FROM admin");
$admin = $sql->fetchColumn();

$sql = $db->query("SELECT count(*) FROM empleados");
$empleados = $sql->fetchColumn();

$sql = $db->query("SELECT count(*) FROM novedades");
$novedades = $sql->fetchColumn();

$sql = $db->query("SELECT count(*) FROM novedades where resuelto = 'No'");
$pendiente = $sql->fetchColumn();

$sql = $db->query("SELECT count(*) FROM novedades where resuelto = 'SI'");
$resuelto = $sql->fetchColumn();





?>
<div class='main-principal'></div>
<div class="subcontent">
    <nav class="containernav-informes">
        <h1>Informes</h1>
        <a class='botoncolor position-absolute' type="submit" href='..//excel/excelHistorial.php' target="_blank"><i class="bi bi-file-arrow-down"></i> Descargar historial</a>
    </nav>
    <main class="containermain-informes">
        <div class="content-indicador">
            <div class="container">
                <h3>Activos</h3>
                <a href="../graficos/activosGraficos.php" target="_blank">
                    <div>
                        <canvas id="indicador-activos"></canvas>
                    </div>
                </a>
            </div>
        </div>
        <div class="content-indicador">
            <div class="container">
                <h3>Cargos</h3>
                <a href="../graficos/usuariosGraficos.php" target="_blank">
                    <div>
                        <canvas id="indicador-usuarios"></canvas>
                    </div>
                </a>
            </div>
        </div>
        <div class="content-indicador">
            <div class="container">
                <h3>Novedades</h3>
                <a href="../graficos/novedadesGraficos.php" target="_blank">
                    <div>
                        <canvas id="indicador-novedades"></canvas>
                    </div>
                </a>
            </div>
        </div>
    </main>
</div>

<!-- boststrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- libreria chart.js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
    const ctx = document.getElementById('indicador-activos').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Nuevo', 'Usado', 'Reparado','Disponible'],
            datasets: [{
                label: 'Numero de registros',
                data: [<?php echo $nuevo; ?>,<?php echo $usado; ?>,<?php echo $reparado; ?>,<?php echo $disponible; ?>],
                backgroundColor: [
                    'rgba(37, 85, 175, 1)',
                    'rgba(0, 109, 255, 0.58)',
                    'rgba(140, 140, 140, 1)',
                    'rgba(232, 19, 19, 0.68)',
                    
                ],
                borderColor: [
                    'rgba(37, 85, 175, 1)',
                    'rgba(0, 109, 255, 0.58)',
                    'rgba(140, 140, 140, 1)',
                    'rgba(232, 19, 19, 0.68)',          
                ],
                borderWidth: 1
            }]
        },
        respontive: 'true',
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    // indicadores usuarios

    const ctx1 = document.getElementById('indicador-usuarios').getContext('2d');
    const myChart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Empleados', 'Admins', ],
            datasets: [{
                label: '# of Votes',
                data: [<?php echo $empleados; ?>, <?php echo $admin; ?>],
                backgroundColor: [
                    'rgba(0, 109, 255, 0.58)',
                    'rgba(37, 85, 175, 1)',
                ],
                borderColor: [
                    'rgba(0, 109, 255, 0.58)',
                    'rgba(37, 85, 175, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // indicadores reparaciones
    const ctx2 = document.getElementById('indicador-novedades').getContext('2d');
    const myChar2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Novedades', 'Resueltos'],
            datasets: [{
                label: '# of Votes',
                data: [<?= $pendiente ?>,<?= $resuelto ?>],
                backgroundColor: [
                    'rgba(37, 85, 175, 1)',
                    'rgba(0, 109, 255, 0.58)',

                ],
                borderColor: [
                    'rgba(37, 85, 175, 1)',
                    'rgba(0, 109, 255, 0.58)',

                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<?php include("footer.php"); ?>

<script>

</script>
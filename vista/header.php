<?php include('titulos.php');
include('controller.php');

$usuario='';
if (isset($_GET['usu'])) {
    $usuario= $_GET['usu'];
}

session_start();
$idadmin = $_SESSION['id'];
if (empty($idadmin)) {
    header('location: ../index.php');
}

if (isset($_SESSION['id']) && isset($_SESSION['correo'])) {
    include('user.php');
    $user = getUserById($_SESSION['id'], $db);   
}
  
$_SESSION['profile'] = $user['perfil'];


$sql = $db->prepare("SELECT * FROM admin where idadmin = ?");
$sql->execute([$idadmin]);
$result = $sql->fetchObject();
if (!$result) {
    echo "¡No existe algun admin con ese Documento!";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title;?></title>
    <!--bostrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src='../jquery/jquery.js'></script>
    <script src='../Javascript/jquery.toast.js'></script>
    <link rel="stylesheet" href="../estilos/jquery.toast.css">
     <!--termina-->
    <link rel="stylesheet" href="..\estilos\styles.css?php">
    <link rel="icon" href="..\Imagenes\Imagen74.png" />
</head>
<body class="fondo">
    <header class='menu-arriba'>
        <div>
            <p><?php echo $result->correo;?></p>
        </div>
        <div class='amovilimg'><img></div>
        <a href="<?php echo "principal.php?page=principal&usu=" .$usuario?>" title='Principal' class='icon-home'>
            <i class="bi bi-house-door-fill"></i>
        </a>
        <div class='menu-opciones'>
            <li><i class="bi bi-justify" id='icon-justify' title='Opciones'></i>
                <ul>
                    <li><a href="<?php echo "activos.php?page=activos&usu=".$usuario."&pag=1"?>">
                    <i class="bi bi-pc-display-horizontal" title="Activos"></i>Activos</a></li>
                    <li><a href="<?php echo "usuarios.php?page=usuarios&usu=".$usuario."&pag=1"?>">
                    <i class="bi bi-people-fill"></i>Empleados</a></li>
                    <li><a href="<?php echo "novedades.php?page=novedades&usu=".$usuario."&pag=1"?>">
                    <i class="bi bi-tools"></i>Novedades</a></li>
                    <li><a href="<?php echo "informes.php?page=informes&usu=".$usuario?>">
                    <i class="bi bi-bar-chart-line-fill"></i>Informes</a></li>
                    <li id='bdark'><a href="#"><i class="bi bi-eye-fill" title='Accesibilidad'></i>Contraste</a></li>
                </ul>
            </li>
        </div>
        <div class='menu-perfil'>
            <?php if ($user) { ?>
                <li><div class='img-perfil'><img src="../uploads/<?= $_SESSION['profile'] ?>"></div>
                <?php } else {
                header("location: ../index.php");
                exit();
            } ?>
                <ul>
                    <li><a href="../Imagenes/ManualUsuario.pdf" target="_blank" >Información</a></li>
                    <li><a href='<?php echo "configuracion.php?page=configuracion&id=" . $idadmin . "&usu=" . $usuario . "&pag=1" ?>'>Configuración</a></li>
                    <li><a href="cerrar.php">Cerrar sesión</a></li>
                </ul>
            </li>
        </div>
    </header> 

    <script>
        const bdark = document.querySelector('#bdark');
        const body = document.querySelector('body');

        load();

        bdark.addEventListener('click', e => {
            body.classList.toggle('darkmode');
            store(body.classList.contains('darkmode'));
        });

        function load() {
            const darkmode = localStorage.getItem('darkmode');

            if (!darkmode) {
                store('false');
            } else if (darkmode == 'true') {
                body.classList.add('darkmode');
            }
        }

        function store(value) {
            localStorage.setItem('darkmode', value);
        }
    </script>
    
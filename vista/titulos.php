<?php
$page='';
if (isset($_GET['page'])) {
    $page= $_GET['page'];
}else{
    $page= 'principal';
}
switch ($page) {
    case 'principal':        
          $page_title = 'Inicio SIDICI';
    break;
    case 'activos':
          $page_title = 'Activos';
    break;
    case 'usuarios':
        $page_title = 'Usuarios';
    break;
    case 'novedades':
        $page_title = 'Novedades';
    break;
    case 'informes':
        $page_title = 'Informes';
    break;
    case 'editaractivo':
        $page_title = 'Editar Activos';
    break;
    case 'editarUsuario':
        $page_title = 'Editar Usuarios';
    break;
    case 'editarNovedad':
        $page_title = 'Editar Novedades';
    break;
    case 'configuracion':
        $page_title = 'Configuracion de Administrador';
    break;
    default: 
          $page_title = 'Page no Found';
    break;
}
?>
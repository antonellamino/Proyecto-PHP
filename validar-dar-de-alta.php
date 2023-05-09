<?php
require_once "conexionBD.php"; //para el script, error fatal, el include tira un warning y permite continuar
session_start();


if (isset($_POST['submit'])){
    
    $esta_ok = true;

    //chequeo de nombre
    if(empty($_POST['nombre'])){
        $_SESSION['nom-error'] = true;
        $esta_ok = false; 
    }
    $_SESSION['dato-form']['nombre'] = $_POST['nombre'];

    //chequeo de imagen
    if(empty($_FILES['imagen']['tmp_name'])){
        $_SESSION['img-error'] = true;
        $esta_ok = false;
    } else {
        $type = $_FILES['imagen']['type']; //si no es una imagen tiene que redirigir
        if($type != "image/jpg" and $type != "image/jpeg" and $type != "image/png"){
            $_SESSION['img-invalida'] = true;
            $esta_ok = false;
        }
    }

    if(!isset($_SESSION['img-error']) and !isset($_SESSION['img-invalida'])){
        $imgAinsertar = (file_get_contents($_FILES['imagen']['tmp_name']));
        $conv = base64_encode($imgAinsertar);
        if(strlen($conv) > 4294967295){ //tamanio maximo del campo longtext en mysql 
            $_SESSION['img-tamanio-invalido'] = true;
            $esta_ok = false;
        }
    }

    //chequeo descripcion max 255 caracteres
    if (strlen($_POST['descripcion']) > 255) {
        $_SESSION['des-error'] = true;
        $esta_ok = false;
    }
    $_SESSION['dato-form']['descripcion'] = $_POST['descripcion'];

    //chequeo plataforma
    if (empty($_POST['id-plataforma'])){
        $_SESSION['plat-error'] = true;
        $esta_ok = false;
    } else {
        $_SESSION['dato-form']['id-plataforma'] = $_POST['id-plataforma'];
    }

    //chequeo la cant de caracteres de la url (80)
    if(strlen($_POST['url']) > 80){
        $_SESSION['url-error']=true;
        $esta_ok = false;
    }
    $_SESSION['dato-form']['url'] = $_POST['url'];

    //chequeo que se haya seleccionado un genero
    if (empty($_POST['id-genero'])){
        $_SESSION['gen-error']=true;
        $esta_ok = false;
    } else {
        $_SESSION['dato-form']['id-genero'] = $_POST['id-genero'];
    }


    if(!$esta_ok){
        header("Location: altaJuego.php");
        die();
    }
}
    
$tipo = $_FILES['imagen']['type'];//aca ya tengo el tipo en type pero ok
$tipoE = explode("/", $tipo);

$alta = "INSERT INTO juegos (nombre, imagen, tipo_imagen, descripcion, url, id_genero, id_plataforma) 
        VALUES ('{$_POST['nombre']}', '$conv', '$tipoE[1]', '{$_POST['descripcion']}', '{$_POST['url']}', '{$_POST['id-genero']}', '{$_POST['id-plataforma']}')";
$resAlta = $link->query($alta);

$_SESSION['alta-exitosa'] = true;
$_SESSION['dato-form'] = array();
header("Location: index.php");
die();

?>

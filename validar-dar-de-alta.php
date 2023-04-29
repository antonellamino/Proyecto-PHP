<?php
include_once "conexionBD.php";
session_start();


//SI SE CLIQUEA EL BOTON AGREGAR JUEGO, SE VIENEN A HACER LOS CHEQUEOS

if (isset($_POST['submit'])){
    
    $esta_ok = true; //sirve para chequear si hay algun error y redirigir a alta juego

    //chequeo de nombre
    if(empty($_POST['nombre'])){
        $_SESSION['nom-error'] = true;
        $esta_ok = false; 
    }
    else {
        $nombreJuego = $_POST['nombre'];
    }

    //chequeo de imagen
    if(empty($_FILES['imagen'])){
        $_SESSION['img-error'] = true;
        $esta_ok = false;
    }

    //chequeo descripcion max 255 caracteres
    if (strlen($_POST['descripcion']) > 10) { //puse 10 para que sea mas facil de probar
        $_SESSION['des-error'] = true;
        $esta_ok = false;
    }

    //chequeo plataforma
    if (empty($_POST['id-plataforma'])){
        $_SESSION['plat-error'] = true;
        $esta_ok = false;
    }

    //chequeo la cant de caracteres de la url (80)
    if(strlen($_POST['url']) > 10){ //puse 10 para probar
        $_SESSION['url-error']=true;
        $esta_ok = false;
    }

    //chequeo que se haya seleccionado un genero
    if (empty($_POST['id-genero'])){
        $_SESSION['gen-error']=true;
        $esta_ok = false;
    }

    if(!$esta_ok){
        header("Location: altaJuego.php"); //si hay errores redirige
        die();
    }
}
    
//encodear imagen
$imgAinsertar = (file_get_contents($_FILES['imagen']['tmp_name']));
$conv = base64_encode($imgAinsertar);
$tipo = $_FILES['imagen']['type'];
$tipoE = explode("/", $tipo);

$alta = "INSERT INTO juegos (nombre, imagen, tipo_imagen, descripcion, url, id_genero, id_plataforma) 
        VALUES ('{$_POST['nombre']}', '$conv', '$tipoE[1]', '{$_POST['descripcion']}', '{$_POST['url']}', '{$_POST['id-genero']}', '{$_POST['id-plataforma']}')";
$resAlta = $link->query($alta);

$_SESSION['alta-exitosa'] = true; //si no hay errores envia true a index
header("Location: index.php");
die();

?>

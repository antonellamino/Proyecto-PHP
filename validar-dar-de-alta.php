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
    if(empty($_FILES['imagen'])){ //si esta vacio que mande el error, si no, que chequee q sea una img
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
    if (strlen($_POST['descripcion']) > 255) { //puse 10 para que sea mas facil de probar
        $_SESSION['des-error'] = true;
        $esta_ok = false;
    }

    //chequeo plataforma
    if (empty($_POST['id-plataforma'])){
        $_SESSION['plat-error'] = true;
        $esta_ok = false;
    }

    //chequeo la cant de caracteres de la url (80)
    if(strlen($_POST['url']) > 80){ //puse 10 para probar
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

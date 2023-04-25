<?php
include_once "conexionBD.php";


//SI SE CLIQUEA EL BOTON AGREGAR JUEGO, SE VIENEN A HACER LOS CHEQUEOS
//CONSULTAR SI HAY QUE PERSONALIZAR LOS MENSAJES

$mensaje = "";
if (isset($_POST['submit'])){

    //chequeo de nombre
    if(empty($_POST['nombre'])){
        $mensaje .= 'Se debe ingresar un nombre <br/>';
    }
    else {
        $nombreJuego = $_POST['nombre'];
    }

    //chequeo de imagen
    if(empty($_POST['imagen'])){
        $mensaje .= 'Se debe seleccionar una imagen <br/>';
    }

    //chequeo descripcion max 255 caracteres
    if (strlen($_POST['descripcion']) > 10) { //puse 10 para que sea mas facil de probar
        $mensaje .= 'La descripcion no debe tener mas de 255 caracteres <br/>';
    }

    //chequeo plataforma
    if (empty($_POST['plataformas'])){
        $mensaje .= 'Se debe seleccionar una plataforma <br/>';
    } else {
        echo $_POST['plataformas']; //lo puse para ver si efectivamente funcionaba, quiere decir que en "plataformas" esta el valor que se selecciono
    }

    //chequeo la cant de caracteres de la url (80)
    if(strlen($_POST['url']) > 10){ //puse 10 para probar
        $mensaje .= 'La url no debe tener mas de 80 caracteres <br/>';
    }

    //chequeo que se haya seleccionado un genero
    if (empty($_POST['generos'])){
        $mensaje .= 'Se debe seleccionar un genero <br/>';
    } else {
        echo $_POST['generos'] . '<br/>'; //lo puse para ver si efectivamente funcionaba, quiere decir que en "plataformas" esta el valor que se selecciono
    }

    echo $mensaje;
}
$idGenero = SELECT 

if ($mensaje = ""){
    "INSERT INTO 'plataformajuegos' ('nombre', 'descripcion', 'url', 'id_genero', 'id_plataforma')"
    VALUES ('nombre', 'descripcion', 'url', '')
}

?>
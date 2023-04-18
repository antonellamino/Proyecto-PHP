<?php
include_once "conexionBD.php";


//SI SE CLIQUEA EL BOTON SUBMIT, SE VIENEN A HACER LOS CHEQUEOS
//CONSULTAR SI HAY QUE PERSONALIZAR LOS MENSAJES
if (isset($_POST['submit'])){
    $mensaje = "";

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
    //echo '<script language="javascript">alert("'.$mensaje.'");</script>';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estilos.css">
    <title>Document</title>
</head>
<body>
    
<!------- encabezado, logo e imagen tipo banner-------->
<header>
    <div class="titulo">
        <a href="./index.html">
            <img class="logo" src="./logo.svg" alt=""></a>
        <h1>GAMELAND</h1>
    </div>

    <div>
        <img class="fondo-img" src="./banner-videojuegos.png" alt="">
    </div>
</header>  


<!-- formulario para agregar juego -->
<div class="agregar-juego">
    <form class="form-juego" id="form-alta-juego" method="post" action="altaJuego.php">
        <h2>Agregar un juego nuevo</h2>
        <label for="" >Nombre</label>
        <input type="text" id="form-nombre" name="nombre">

        <label for="" id="form-img">Imagen</label>
        <input class="btn-img-form" name="imagen" type="file">

        <label for="">Descripcion</label>
        <textarea name="descripcion" cols="85" rows="6"></textarea>

        <label for="" id="form-genero">Genero</label>
        <select name="generos" id="genero" >
            <option name="seleccionar-genero" value="">Seleccionar</option>
            <option value="terror">Terror</option>
            <option value="RPG">rpg</option>
            <option value="accion">Accion</option>
            <option value="aventura">Aventura</option> <!--dar estilos al menu desplegable-->
        </select>

        <label for="" id="form-plat">Plataforma</label>
        <select name="plataformas" id="plataforma" >Plataforma
            <option name="seleccionar-plataforma" value="">Seleccionar</option>
            <option value="windows">Windows</option>
            <option value="android">Android</option>
            <option value="playstation">PlayStation</option> 
            <option value="macos">MacOS</option><!--dar estilos al menu desplegable-->
        </select>

        <label for="" id="form-url">Ruta</label>
        <input type="text" id="url" name="url">
        <button type="submit" name="submit">Agregar juego</button>
    </form>
    <a class="btn-b" href="./index2.php">Volver</a>

</div>

<!-- <script src="validarAltaJuego.js"></script> -->
<footer>Miño Erika Antonella - Cotignola Griselda Soledad - 2023</footer>

</body>
</html>
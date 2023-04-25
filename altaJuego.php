
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
        <a href="./index2.php">
            <img class="logo" src="./img/logo.svg" alt=""></a>
        <h1>GAMELAND</h1>
    </div>

    <div>
        <img class="fondo-img" src="./img/banner-videojuegos.png" alt="">
    </div>
</header>  


<!-- formulario para agregar juego -->
<div class="agregar-juego">
    <form class="form-juego" id="form-alta-juego" method="post" action="validar_alta_juego.php">
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
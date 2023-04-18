<?php   
require_once "conexionBD.php";


$juegos = "SELECT * FROM juegos";
$resJuegos = $link->query($juegos);
$generos = "SELECT nombre FROM generos";
$resGeneros = $link->query($generos);
$plataformas = "SELECT nombre FROM plataformas";
$resPlataformas = $link->query($plataformas);

if(isset($_POST['filtrar'])){
    $buscar = $_POST['juego_a_buscar']; //para agarrar lo que esta dentro de este input, o sea el nombre introducido
    $juegos .= "WHERE nombre = '{$buscar}'";
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estilos.css">
    <title>Gameland</title>
</head>

<body>


    <!------- encabezado, logo e imagen tipo banner-------->
    <header>
        <div>
            <a href="./index.html">
                <img class="logo" src="./logo.svg" alt=""></a>
            <h1>GAMELAND</h1>
        </div>

        <div>
            <img class="fondo-img" src="./banner-videojuegos.png    " alt="">
        </div>
    </header>

    



    <!--------formulario para filtrar--------->
    <form method="POST" action="index2.php"> 
        <h2>Filtrar juego por: </h2>
        <label for="nombre">Nombre del juego: </label>
        <input type="text" name="juego_a_buscar" id="nombre">
        <label for="genero"> Genero: </label>
            <select name="" id="">
                <option value="">Seleccionar</option>
                <option value="">Terror</option>
                <option value="">Aventura</option>
                <option value="">RPG</option>
                <option value="">Accion</option>
            </select>
        <label for="">Plataforma</label>
        <select name="" id="">
            <option value="">Seleccionar</option>
            <option value="">Microsoft</option>
            <option value="">PlayStation</option>
            <option value="">Android</option>
        </select>
        <label for="">Ordenar: </label>
        <select name="" id="">
            <option value="">Seleccionar</option>
            <option value="">A-Z</option>
            <option value="">Z-A</option>
        </select>

        <br>
        <button type="submit" name="filtrar">Filtrar</button>
        
    </form>

    <div class="btn-submit">
        <a class="btn-a" href="./altaJuego.php">Agregar juego</a>
    </div>



    <!------------- juegos disponibles--------------->
    
                    <!-- aca iria la imagen -->
    <?php while ($row = $resJuegos->fetch_assoc() and $gen = $resGeneros->fetch_assoc() and $plat = $resPlataformas->fetch_assoc()){ ?>
    <div class="lista-juegos">
        <ul>
            <li>
                <ul class="card-juego">
                    <div class="card-juegos-item">
                        <li>NOMBRE: <?php echo $row["nombre"]; ?></li>
                        <li>DESCRIPCION: <?php echo $row["descripcion"]; ?> </li>
                        <li>GENERO: <?php echo $gen["nombre"]; ?></li>
                        <li>PLATAFORMA: <?php echo $plat["nombre"];?></li>
                        <li>URL:<?php echo $row["url"]; ?></li>
                    </div>
                </ul>
    <?php }?>
            </li>
        </ul>
    </div>





    <!----------- pie de pagina ----------->
    <footer>Miño Erika Antonella - Cotignola Griselda Soledad - 2023</footer>
    <!-- <script src="validarAltaJuego.js"></script> -->
</body>

</html>

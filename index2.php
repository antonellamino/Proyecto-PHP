<?php   
require_once "conexionBD.php";


$juegos = "SELECT * FROM juegos";
$resJuegos = $link->query($juegos);
$generos = "SELECT nombre, id FROM generos";
$resGeneros = $link->query($generos);
$plataformas = "SELECT nombre FROM plataformas";
$resPlataformas = $link->query($plataformas);





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
            <a href="./index2.php">
                <img class="logo" src="./img/logo.svg" alt=""></a>
            <h1>GAMELAND</h1>
        </div>

        <div>
            <img class="fondo-img" src="./img/banner-videojuegos.png    " alt="">
        </div>
    </header>

    



    <!--------formulario para filtrar--------->
    <form method="POST" action="index2.php"> 
        <h2>Filtrar juego por: </h2>
        <label for="nombre">Nombre del juego: </label>
        <input type="text" name="juego_a_buscar" id="nombre">

        <label for="genero"> Genero: </label>
            <select name="filtro_genero" id="genero"> <!--id se asocia con el name del select-->
            <?php while ($row = $resGeneros->fetch_assoc()){?>
                <?php echo "<option value=\"" . $row["id"] . "\">" . $row["nombre"] . "</option>"; ?>
                <?php } ?>
            </select>


        <label for="plataforma">Plataforma</label>
        <select name="filtro_plataforma" id="plataforma">
        <?php while ($row = $resPlataformas->fetch_assoc()){?>
            <?php echo "<option value=\"" . $row["id"] . "\">" . $row["nombre"] . "</option>"; ?>
            <?php } ?>
        </select>


        <label for="ordenar">Ordenar: </label>
        <select name="filtro_ordenar" id="ordenar">
            <option value="selec">Seleccionar</option>
            <option value="asc">A-Z</option>
            <option value="desc">Z-A</option>
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
            </li>
        </ul>
    </div>
    <?php }?>





    <!----------- pie de pagina ----------->
    <footer>Miño Erika Antonella - Cotignola Griselda Soledad - 2023</footer>
    <!-- <script src="validarAltaJuego.js"></script> -->
</body>

</html>

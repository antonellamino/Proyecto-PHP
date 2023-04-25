<?php   
require_once "conexionBD.php";


$juegos = "SELECT * FROM juegos";
$resJuegos = $link->query($juegos);
$generos = "SELECT nombre, id FROM generos";
$resGeneros = $link->query($generos);
$plataformas = "SELECT * FROM plataformas";
$resPlataformas = $link->query($plataformas);

print_r ($_POST);


if(isset($_POST['filtrar'])){
    //FILTRAR POR JUEGO
    if((!empty($_POST['juego_a_buscar'])) and (empty($_POST['genero'])) and (empty($_POST['plataforma']))){
        $nombre = $_POST['juego_a_buscar'];
        $consulta = "SELECT * FROM juegos WHERE nombre LIKE '%$nombre%'";
        $resConsulta = $link->query($consulta);
            while($campo = $resConsulta->fetch_assoc()){
                echo $campo['nombre'].'<br>';
                echo $campo['descripcion'].'<br>';
                echo $campo['url'].'<br>';
            }
        }   
    
    //FILTRAR POR GENERO
    if((empty($_POST['juego_a_buscar'])) and (!empty($_POST['filtro_genero']) and ($_POST['filtro_genero']!= "seleccionar")) and (empty($_POST['plataforma']))){
        $genero = $_POST['filtro_genero'];
        $consulta = "SELECT * FROM juegos WHERE id_genero = $genero";
        $resConsulta = $link->query($consulta);
        while($campo = $resConsulta->fetch_assoc()){
            echo $campo['nombre'].'<br>';
            echo $campo['descripcion'].'<br>';
            echo $campo['url'].'<br>';
            echo $campo['id_genero']; //COMO HAGO PARA QUE ME PONGA EL NOMBRE DEL GENERO
        }
    }

    //FILTRAR POR PLATAFORMA
    if(((!empty($_POST['filtro_plataforma']) and ($_POST['filtro_plataforma']!= "seleccionar")) and (empty($_POST['filtro_genero'])) and (empty($_POST['juego_a_buscar'])))){
        $plataforma = $_POST['filtro_plataforma'];
        $consulta = "SELECT * FROM juegos WHERE id_plataforma = $plataforma";
        $resConsulta = $link->query($consulta);
        while($campo = $resConsulta->fetch_assoc()){
            echo $campo['nombre'].'<br>';
            echo $campo['descripcion'].'<br>';
            echo $campo['url'].'<br>';
            echo $campo['id_plataforma'];
        }
    }
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
            <a href="./index2.php">
                <img class="logo" src="./img/logo.svg" alt=""></a>
            <h1>GAMELAND</h1>
        </div>

        <div>
            <img class="fondo-img" src="./img/banner-videojuegos.png    " alt="">
        </div>
    </header>

    



    <!--------formulario para filtrar--------->
    <form method="POST" action="pruebas.php"> 
        <h2>Filtrar juego por: </h2>
        <label for="nombre">Nombre del juego: </label>
        <input type="text" name="juego_a_buscar" id="nombre">


        <label for="genero"> Genero </label>
        <select name="filtro_genero" id="genero"> <!--id se asocia con el name del select-->
            <option value="seleccionar">Seleccionar</option>
            <?php while ($row = $resGeneros->fetch_assoc()){?>
            <?php echo "<option value=\"" . $row["id"] . "\">" . $row["nombre"] . "</option>"; ?>
            <?php } ?>
        </select>


        <label for="plataforma"> Plataforma </label>
        <select name="filtro_plataforma" id="plataforma">
            <option value="seleccionar">Seleccionar</option>
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

    <?php $consulta = "SELECT j.*, g.nombre AS nombre_genero, p.nombre as nombre_plataforma FROM juegos j 
                        INNER JOIN generos g ON g.id = j.id_genero 
                        INNER JOIN plataformas p on p.id = j.id_plataforma";
        $resConsulta = $link->query($consulta);
    while ($row = $resConsulta->fetch_assoc()){
    ?>
    <div class="lista-juegos">
        <ul>
            <li>
                <ul class="card-juego">
                    <div class="card-juegos-item">
                        <li>NOMBRE: <?php echo $row["nombre"]; ?></li>
                        <li>DESCRIPCION: <?php echo $row["descripcion"]; ?> </li>
                        <li>GENERO: <?php echo $row["nombre_genero"]; ?></li>
                        <li>PLATAFORMA: <?php echo $row["nombre_plataforma"];?></li>
                        <li>URL:<?php echo $row["url"]; ?></li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
    <?php }?>



    <!----------- pie de pagina ----------->
    <footer>Miño Erika Antonella - Cotignola Griselda Soledad - 2023</footer>
</body>

</html>

<?php   
require_once "conexionBD.php";

session_start();



$juegos = "SELECT * FROM juegos";
$resJuegos = $link->query($juegos);
$generos = "SELECT nombre, id FROM generos";
$resGeneros = $link->query($generos);
$plataformas = "SELECT * FROM plataformas";
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
            <a href="./index.php">
                <img class="logo" src="./img/logo.svg" alt=""></a>
            <h1>GAMELAND</h1>
        </div>

        <div>
            <img class="fondo-img" src="./img/banner-videojuegos.png    " alt="">
        </div>
    </header>

    
<?php if (isset($_SESSION['alta-exitosa'])){
    echo "<h3>Se agregó un juego</h3>";
    unset($_SESSION['alta-exitosa']);
}?>

    <!--------formulario para filtrar--------->
    <form method="GET" action="index.php"> 
        <h2>Filtrar juego por: </h2>
        <label for="nombre">Nombre del juego: </label>
        <input type="text" name="juego_a_buscar" id="nombre" value="<?php echo (isset($_GET['juego_a_buscar'])) ? $_GET['juego_a_buscar'] : '' ;?>">


        <label for="genero"> Genero </label>
        <select name="filtro_genero" id="genero">
            <option selected value>Seleccionar</option>
            <?php while ($row = $resGeneros->fetch_assoc()){?>
            <option <?php echo (!empty($_GET['filtro_genero']) and ($_GET['filtro_genero'] == $row['id'])) ? 'selected' : '' ?> value="<?php echo $row["id"] ?>"> <?php echo $row["nombre"] ?> </option>
            <?php } ?>
        </select>


        <label for="plataforma"> Plataforma </label>
        <select name="filtro_plataforma" id="plataforma">
            <option <?php echo (!empty($_GET['filtro_plataforma']) || (empty($_GET['filtro_plataforma']))) ? 'selected' : '' ?>  value>Seleccionar</option>
            <?php while ($row = $resPlataformas->fetch_assoc()){?>
            <option <?php echo (!empty($_GET['filtro_plataforma']) and ($_GET['filtro_plataforma'] == $row['id'])) ? 'selected' : '' ?> value="<?php echo $row["id"] ?>"> <?php echo $row["nombre"] ?> </option>
            <?php } ?>
        </select>


        <label for="ordenar">Ordenar: </label>
        <select name="filtro_ordenar" id="ordenar">
            <option <?php echo (empty($_GET['filtro_ordenar'])) ? 'selected' : '' ?> value>Seleccionar</option>
            <option <?php echo (!empty($_GET['filtro_ordenar']) and ($_GET['filtro_ordenar'] == 'asc')) ? 'selected' : '' ?> value="asc">A-Z</option>
            <option <?php echo (!empty($_GET['filtro_ordenar']) and ($_GET['filtro_ordenar'] == 'desc')) ? 'selected' : '' ?> value="desc">Z-A</option>
        </select>

        <br>
        <button type="submit" name="filtrar">Filtrar</button>
        
    </form>

    <div class="btn-submit">
        <a class="btn-a" href="./altaJuego.php">Agregar juego</a>
    </div>



    <!---------- COMPORTAMIENTO BOTON FILTRAR ---------->
    <?php
    if(isset($_GET['filtrar'])){

        $consulta = "WHERE ";
        $set = false;

        if(!empty($_GET['juego_a_buscar'])){
            $nombre = $_GET['juego_a_buscar'];
            $consulta .= " j.nombre LIKE '%$nombre%' "; //le agrego esto a la consulta
            $set = true;
        }


        if(!empty($_GET['filtro_genero'])){
            $genero = $_GET['filtro_genero'];
            if($set){
                $consulta .= " AND ";
            }
            $consulta .= " j.id_genero = $genero ";
            $set = true;
        }


        if(!empty($_GET['filtro_plataforma'])){
            $plataforma = $_GET['filtro_plataforma'];
            if($set){
                $consulta .= " AND ";
            }
            $consulta .= "j.id_plataforma = $plataforma ";
            $set = true;
        }

        if (!$set){
            $consulta = '';
        }
        if(!empty($_GET['filtro_ordenar']) ){
            if($_GET['filtro_ordenar'] == "asc"){
                $consulta .= " ORDER BY j.nombre ASC";
            }
            else {
                $consulta .= " ORDER BY j.nombre DESC";
            }
            $set = true;
        }

        if($set){
            imprimirDatos($consulta);
        } else {
            echo "<h2 style='width:60%; height:50px; margin-left:20%; text-align:center;'> -------- No se selecciono filtro -------</h2>";
        }



    } else {
        imprimirDatos("");
    }



    function imprimirDatos($consulta){
        global $link;
        $cons = "SELECT j.*, g.nombre AS nombre_genero, p.nombre as nombre_plataforma FROM juegos j INNER JOIN generos g ON g.id = j.id_genero 
        INNER JOIN plataformas p on p.id = j.id_plataforma " . $consulta;
        $resConsulta = $link->query($cons);

        while($row = $resConsulta->fetch_assoc()){?>
            <div class="lista-juegos">
                <ul>
                    <li>
                        <ul class="card-juego">
                            <div class="card-juegos-item">
                                <img class="card-img" src="data:image/<?php echo ($row['tipo_imagen'])?>;base64;, <?php echo $row['imagen']?>" alt="">
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
            
    <?php }
        }?>



    <!----------- pie de pagina ----------->
    <footer> Miño Erika Antonella - Cotignola Griselda Soledad - 2023</footer>
</body>

</html>

<?php   
require_once "conexionBD.php";

session_start();



$juegos = "SELECT * FROM juegos";
$resJuegos = $link->query($juegos);
$generos = "SELECT nombre, id FROM generos";
$resGeneros = $link->query($generos);
$plataformas = "SELECT * FROM plataformas";
$resPlataformas = $link->query($plataformas);

// print_r ($_GET); //DEBUG, eliminar para entrega
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

    
<?php if (isset($_SESSION['alta-exitosa'])){ //valida que se haya seteado el alta exitosa, si se seteo es xq todos los campos estan
    echo "<h3>Se agregó un juego</h3>";
    unset($_SESSION['alta-exitosa']); //la limpio para que no quede seteada
}?>

    <!--------formulario para filtrar--------->
    <form method="GET" action="index.php"> 
        <h2>Filtrar juego por: </h2>
        <label for="nombre">Nombre del juego: </label>
        <input type="text" name="juego_a_buscar" id="nombre">


        <label for="genero"> Genero </label>
        <select name="filtro_genero" id="genero">
            <option disabled selected value>Seleccionar</option>
            <?php while ($row = $resGeneros->fetch_assoc()){?>
            <?php echo "<option value=\"" . $row["id"] . "\">" . $row["nombre"] . "</option>"; ?>
            <?php } ?>
        </select>


        <label for="plataforma"> Plataforma </label>
        <select name="filtro_plataforma" id="plataforma">
            <option disabled selected value>Seleccionar</option>
            <?php while ($row = $resPlataformas->fetch_assoc()){?>
            <?php echo "<option value=\"" . $row["id"] . "\">" . $row["nombre"] . "</option>"; ?>
            <?php } ?>
        </select>


        <label for="ordenar">Ordenar: </label>
        <select name="filtro_ordenar" id="ordenar">
            <option disabled selected value>Seleccionar</option>
            <option value="asc">A-Z</option>
            <option value="desc">Z-A</option>
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
        //FILTRAR POR JUEGO
        if((!empty($_GET['juego_a_buscar'])) and (empty($_GET['filtro_genero'])) and (empty($_GET['filtro_plataforma']))){
            $nombre = $_GET['juego_a_buscar'];
            $consulta = "WHERE j.nombre LIKE '%$nombre%' ";
            ordenar($consulta);
            imprimirDatos($consulta);
            }   
        
        //FILTRAR POR GENERO
        if(empty($_GET['juego_a_buscar']) and !empty($_GET['filtro_genero']) and empty($_GET['filtro_plataforma'])){
            $genero = $_GET['filtro_genero'];
            $consulta = "WHERE j.id_genero = $genero";
            ordenar($consulta);
            imprimirDatos($consulta);
        }

        //FILTRAR POR PLATAFORMA
        if(!empty($_GET['filtro_plataforma']) and empty($_GET['filtro_genero']) and empty($_GET['juego_a_buscar'])){
            $plataforma = $_GET['filtro_plataforma'];
            $consulta = "WHERE j.id_plataforma = $plataforma";
            ordenar($consulta);
            imprimirDatos($consulta);
        }
        
        if(empty($_GET['filtro_plataforma']) and empty($_GET['filtro_genero']) and empty($_GET['juego_a_buscar'])){
            echo " -------- no se selecciono filtro -------";
        } //AGREGADO HOY, personalizar
    }
    else {
        imprimirDatos(""); //MUESTRA LA LISTA PORQUE entra a traves del get , el post esta vacio
    }



    function ordenar(&$consulta){ //&se usa para pasar variables por referencia en la funcion
        if(!empty($_GET['filtro_ordenar'])){
            if($_GET['filtro_ordenar'] == "asc"){
                $consulta .= " ORDER BY j.nombre ASC";
            }
            else {
                $consulta .= " ORDER BY j.nombre DESC";
            }
        }
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

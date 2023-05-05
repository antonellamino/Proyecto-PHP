<?php   
require_once "conexionBD.php";
session_start();



$juegos = "SELECT * FROM juegos";
$resJuegos = $link->query($juegos);
$generos = "SELECT nombre, id FROM generos";
$resGeneros = $link->query($generos);
$plataformas = "SELECT * FROM plataformas";
$resPlataformas = $link->query($plataformas);
// print_r ($_POST); //DEBUG, eliminar para entrega
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estilos.css">
    <title>Gameland - agregar juego</title>
</head>
<body>
    
<!------- encabezado, logo e imagen tipo banner-------->
<header>
    <div class="titulo">
        <a href="./index.php">
            <img class="logo" src="./img/logo.svg" alt=""></a>
        <h1>GAMELAND</h1>
    </div>

    <div>
        <img class="fondo-img" src="./img/banner-videojuegos.png" alt="">
    </div>
</header>  

<?php 
    if (!isset($_SESSION['dato-form']))
        $_SESSION['dato-form'] = array();
?>

<!-- formulario para agregar juego -->
<div class="agregar-juego">
    <form class="form-juego" id="form-alta-juego" method="post" action="validar-dar-de-alta.php" onsubmit="return validarAltaJuego()" enctype="multipart/form-data"> 

        <h2>Agregar un juego nuevo</h2>

        <label for="" >Nombre</label>
        <?php if (isset($_SESSION['nom-error'])){
                echo "El campo nombre no puede estar vacio";
                unset($_SESSION['nom-error']);
            } ?>
        <input type="text" id="form-nombre" name="nombre" value="<?php echo (isset($_SESSION['dato-form']['nombre'])) ? $_SESSION['dato-form']['nombre'] : '' ;?>">


        <label for="imagen" name="imagen" id="form-img">Imagen</label>
        <?php if (isset($_SESSION['img-error'])){
                echo "Se debe seleccionar una imagen";
                unset($_SESSION['img-error']);
            } else if(isset($_SESSION['img-invalida'])){
                echo "Se debe seleccionar una imagen de tipo .jpg, .jpeg, .png";
                unset($_SESSION['img-invalida']);
            } else if (isset($_SESSION['img-tamanio-invalido'])){
                echo "La imagen excede el tamanio maximo";
                unset($_SESSION['img-tamanio-invalido']);
            }?>
        <input class="btn-img-form" name="imagen" type="file" id="imagen">


        <label for="">Descripcion</label>
        <?php if (isset($_SESSION['des-error'])){
                echo "La descripcion no puede tener mas de 255 caracteres";
                unset($_SESSION['des-error']);
            } ?>
        <input style="width:60%; height:100px;" name="descripcion"  id="descripcion" value="<?php echo (isset($_SESSION['dato-form']['descripcion'])) ? $_SESSION['dato-form']['descripcion'] : ''; ?>"></input>

        <label for="id-genero">Genero</label>
        <?php if (isset($_SESSION['gen-error'])){
                echo "Se debe seleccionar un genero";
                unset($_SESSION['gen-error']);
            } ?>
        <select name="id-genero" id="form-genero"> <!--id se asocia con el name del select-->
            <option disabled <?php echo (!isset($_SESSION['dato-form']['id-genero']) || (empty($_SESSION['dato-form']['id-genero']))) ? 'selected' : '' ?> value>Seleccionar</option>
            <?php while ($row = $resGeneros->fetch_assoc()){?>
            <option <?php echo (isset($_SESSION['dato-form']['id-genero']) and ($_SESSION['dato-form']['id-genero'] == $row['id'])) ? 'selected' : '' ?> value="<?php echo $row["id"] ?>"> <?php echo $row["nombre"] ?> </option>
            <?php } ?>
        </select>


        <label for="id-plataforma"> Plataforma </label>
        <?php if (isset($_SESSION['plat-error'])){
                echo "Se debe seleccionar una plataforma";
                unset($_SESSION['plat-error']);
            } ?>
        <select name="id-plataforma" id="form-plataforma">
            <option disabled <?php echo (!isset($_SESSION['dato-form']['id-plataforma']) || (empty($_SESSION['dato-form']['id-plataforma']))) ? 'selected' : '' ?> value>Seleccionar</option>
            <?php while ($row = $resPlataformas->fetch_assoc()){?>
            <option <?php echo (isset($_SESSION['dato-form']['id-plataforma']) and ($_SESSION['dato-form']['id-plataforma'] == $row['id'])) ? 'selected' : '' ?> value="<?php echo $row["id"] ?>"> <?php echo $row["nombre"] ?> </option>
            <?php } ?>
        </select>


        <label for="" id="form-url">Ruta</label>
        <?php if (isset($_SESSION['url-error'])){
                echo "La ruta no puede tener mas de 80 caracteres";
                unset($_SESSION['url-error']);
            } ?>
        <input type="text" id="url" name="url" value="<?php echo (isset($_SESSION['dato-form']['url'])) ? $_SESSION['dato-form']['url'] : '' ; ?>">


        <button type="submit" name="submit">Agregar juego</button>
    </form>
    <a class="btn-b" href="./index.php">Volver</a>

</div>

<footer>Miño Erika Antonella - Cotignola Griselda Soledad - 2023</footer>
<script src="validarAltaJuego.js"></script>
</body>
</html>

<?php 
    $_SESSION['dato-form'] = array();
?>
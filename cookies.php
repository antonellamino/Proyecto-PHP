<?php   
include_once "conexionBD.php";

if(isset($_POST['enviar'])){
    $usuario = htmlentities($_POST['usuario']); //usuario seria el nombre que se ingreso en el input 

    //configuracion la cookie
    setcookie('usuario', $usuario, time()+3600);
    header("Location: cookies.php");

    //Borrar una cookie
    // setcookie('usuario', $usuario, time()-3600); //se pone un valor negativo para que se borre
}

if(isset($_COOKIE['usuario'])){
    echo "Usuario " . $_COOKIE['usuario'] . " esta configurado <br/>";
}

//validar si hay cookies guardadas
if(count($_COOKIE) > 0){
    echo "Hay " . count($_COOKIE) . " cookies guardadas";
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
    <form action="" method="POST">
        <input type="text" name="usuario" placeholder="Ingresa el usuario">
        <input type="submit" name="enviar" value="enviar">
    </form>
</body>

</html>

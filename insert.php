<?php
    $link = mysqli_connect('localhost', 'root', '', 'plataformajuegos');

    mysqli_query( $link, "INSERT INTO plataformas (nombre) VALUES ('Ejemplo 1'), ('Ejemplo2')");
/*mysqli_*/

    echo "Id creado: " . mysqli_insert_id($link);
?>
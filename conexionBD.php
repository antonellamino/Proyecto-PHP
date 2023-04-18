<?php
error_reporting(E_ALL);
ini_set("display_errors", true);

$link = mysqli_connect('localhost', 'root', '', 'plataformajuegos'); /*se puede guardar en variables*/


if ($link -> connect_errno){       
die('Conexion fallida ' . $link->connect_errno);
} else {
    echo "conectado";
}
?>
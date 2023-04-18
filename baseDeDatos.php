<?php
$link = mysqli_connect('localhost', 'root', '', 'plataformajuegos')
    or die("Error". mysqli_error($link));

$result = mysqli_query($link, "SELECT * FROM plataformas LIMIT 10");

if ($result)
{       
    echo "Numero de filas recuperadas: " . mysqli_num_rows($result);
} else {
    die('Query invalido : ' . mysqli_error() . '<br>');
}

while ($row = mysqli_fetch_array($result)){
    echo $row['nombre'] . '<br>';
}
?>
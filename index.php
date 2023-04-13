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
    <form>
        <h2>Filtrar juego por: </h2>
        <label for="nombre">Nombre del juego: </label>
        <input type="text" name="" id="nombre">
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
            <option value="">A-Z</option>
            <option value="">Z-A</option>
        </select>

        <br>
        <button type="submit">Filtrar</button>
        
    </form>
    <div class="btn-submit">
        <a class="btn-a" href="./altaJuego.html">Agregar juego</a>
    </div>


    <!------------- juegos disponibles--------------->
    <div class="lista-juegos">
        <ul>
            <li>
                <ul class="card-juego">
                    <img class="img-juego" src="./img-juego1.jpeg" alt="">
                    <div class="card-juegos-item">
                        <li>NOMBRE: Resident Evil</li>
                        <li>GENERO: Terror </li>
                        <li>PLATAFORMA: Windows</li>
                        <li>DESCRIPCION: Lorem ipsum, dolor sit amet consectetur </li>
                        <li>URL: Lorem ipsum dolor sit amet</li>
                    </div>
                </ul>
            </li>


            <br>
            <li>
                <ul class="card-juego">
                    <img class="img-juego" src="./img-juego2.jpg" alt="">
                    <div class="card-juegos-item">
                        <li>NOMBRE: Final Fantasy</li>
                        <li>GENERO: RPG </li>
                        <li>PLATAFORMA: Android</li>
                        <li>DESCRIPCION: Lorem ipsum, dolor sit amet consectetur  </li>
                        <li>URL: Lorem ipsum dolor sit amet</li>
                    </div>
                </ul>
            </li>


            <br>
            <li>
                <ul class="card-juego">
                    <img class="img-juego" src="./img-juego3.jpg" alt="">
                    <div class="card-juegos-item">
                        <li>NOMBRE: The Last Of Us</li>
                        <li>GENERO: Terror </li>
                        <li>PLATAFORMA: PlayStation</li>
                        <li>DESCRIPCION: Lorem ipsum, dolor sit amet consectetur </li>
                        <li>URL: Lorem ipsum dolor sit amet</li>
                    </div>
                </ul>
            </li>


            <br>
            <li>
                <ul class="card-juego">
                    <img class="img-juego" src="./img-juego4.jpg" alt="">
                    <div class="card-juegos-item">
                        <li>NOMBRE: God Of War</li>
                        <li>GENERO: Accion </li>
                        <li>PLATAFORMA: PlayStation</li>
                        <li>DESCRIPCION: Lorem ipsum, dolor sit amet consectetur</li>
                        <li>URL: Lorem ipsum dolor sit amet</li>
                    </div>
                </ul>
            </li>


        </ul>
    </div>



    <!----------- pie de pagina ----------->
    <footer>Miño Erika Antonella - Cotignola Griselda Soledad - 2023</footer>
    <script src="validarAltaJuego.js"></script>
</body>

</html>

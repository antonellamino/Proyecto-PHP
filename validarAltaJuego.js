
function validarAltaJuego() {

    let valido = true;
    let nombre = document.getElementById('form-nombre').value; 
    let img = document.getElementById('imagen').files; //devuelve una lista de archivos
    let descripcion = document.getElementById('descripcion').value;
    let genero = document.getElementById('genero');
    let opcionGenero = genero.options[genero.selectedIndex].value; //devuelve el valor de la opcion elegida
    let plataforma = document.getElementById('plataforma');
    let opcionPlataforma = plataforma.options[plataforma.selectedIndex].value; //develve el valor de la opcion elegida
    let url = document.getElementById('url').value;


    //Las alertas estan a modo de mensaje, se pueden sacar, sirven para saber que esta faltando o que esta mal
    if (nombre === null || nombre.length == 0){
        alert("El nombre no puede estar vacio");
        valido = false;
        return valido;
    }

    if (img[0] === undefined ){ //chequeo, si el valor del archivo en la posicion [0] es indefinido, es porque no se selecciono ninguna imagen
        alert('Se debe seleccionar una imagen');
        valido = false;
        return valido;
    }

    if (descripcion.length > 255){
        alert("La descripcion no puede superar los 255 caracteres");
        valido = false;
        return valido;
    }

    if (opcionGenero === 'seleccionar-genero'){
        alert('Seleccionar genero');
        valido = false;
        return valido;
    }

    if (url.length > 80){
        alert('La ruta no debe tener mas de 80 caracteres');
        valido = false;
        return valido;
    }

    
    if (opcionPlataforma === 'seleccionar-plataforma') { //chequeo si el valor que tengo es el valor de la opcion seleccionar, significa que no fue seleccionado ninguna plataforma, si no devolveria el valor de alguna plataforma permitida
        alert('Seleecionar una plataforma');
        valido = false;
        return valido;
    }

}


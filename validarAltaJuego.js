
function validarAltaJuego() {

    let valido = true;
    let nombre = document.getElementById('form-nombre').value; 
    let img = document.getElementById('imagen').files; //devuelve una lista de archivos
    let descripcion = document.getElementById('descripcion').value;
    let genero = document.getElementById('form-genero');
    let opcionGenero = genero.options[genero.selectedIndex].value; //devuelve el valor de la opcion elegida
    let plataforma = document.getElementById('form-plataforma');
    let opcionPlataforma = plataforma.options[plataforma.selectedIndex].value; //develve el valor de la opcion elegida
    let url = document.getElementById('url').value;
    let alerta= "";

    //Las alertas estan a modo de mensaje, se pueden sacar, sirven para saber que esta faltando o que esta mal
    if (nombre === null || nombre == ''){
        valido = false;
        alerta += 'El nombre no puede estar vacio. ';
    }

    if (img[0] === undefined ){ //chequeo, si el valor del archivo en la posicion [0] es indefinido, es porque no se selecciono ninguna imagen
        valido = false;
        alerta += 'Se debe seleccionar una imagen. ';
    }

    if (descripcion.length > 255){
        alerta += 'La descripcion no puede superar los 255 caracteres. ';
        valido = false;
    }

    if (opcionGenero === ""){
        alerta += 'Seleccionar genero. ';
        valido = false;
    }

    if (url.length > 80){
        alerta +='La ruta no debe tener mas de 80 caracteres. ';
        valido = false;
    }

    
    if (opcionPlataforma === "") { //chequeo si el valor que tengo es el valor de la opcion seleccionar, significa que no fue seleccionado ninguna plataforma, si no devolveria el valor de alguna plataforma permitida
        alerta += ' Seleccionar una plataforma.';
        valido = false;
    }


    if (!valido ) 
        alert(alerta);
    
    return valido;
}

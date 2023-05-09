
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

    
    if (nombre === null || nombre == ''){
        valido = false;
        alerta += 'El nombre no puede estar vacio. ';
    }

    if (img[0] === undefined ){
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

    
    if (opcionPlataforma === "") {
        alerta += ' Seleccionar una plataforma.';
        valido = false;
    }


    if (!valido ) 
        alert(alerta);
    
    return valido;
}

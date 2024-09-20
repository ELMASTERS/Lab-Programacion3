function validarCedula(numero) {
    const numeroLimpio = numero.replace(/\D/g, '');

  
    if (numeroLimpio.length !== 11 || /^0+$/.test(numeroLimpio)) {
        return false;
    }

    let suma = 0;
    let esSegundo = false;

    for (let i = numeroLimpio.length - 1; i >= 0; i--) {
        let digito = parseInt(numeroLimpio.charAt(i), 10);

        if (esSegundo) {
            digito *= 2;
            if (digito > 9) {
                digito -= 9;
            }
        }

        suma += digito;
        esSegundo = !esSegundo;
    }

    return suma % 10 === 0;
}

function validar() {
 const cedula = document.getElementById('cedula').value;
    const resultado = document.getElementById('resultado');
    const historial = document.getElementById('historial');

    let mensaje;
    let color;

    if (validarCedula(cedula)) {
        mensaje = 'La cédula ' + cedula + ' es válida.';
        color = 'green';
    } else {
        mensaje = 'La cédula ' + cedula + ' no es válida.';
        color = 'red';
    }

    resultado.textContent = mensaje;
    resultado.style.color = color;

 
    const li = document.createElement('li');
    li.textContent = mensaje;
    li.style.color = color;
    historial.appendChild(li);
}

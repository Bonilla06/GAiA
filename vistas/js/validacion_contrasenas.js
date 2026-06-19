

document.addEventListener('DOMContentLoaded', function() {
    // Criterios de contraseña
    const CRITERIOS = {
        longitud: {
            id: 'criterio-longitud',
            validar: (pwd) => pwd.length >= 8
        },
        mayuscula: {
            id: 'criterio-mayuscula',
            validar: (pwd) => /[A-Z]/.test(pwd)
        },
        minuscula: {
            id: 'criterio-minuscula',
            validar: (pwd) => /[a-z]/.test(pwd)
        },
        numero: {
            id: 'criterio-numero',
            validar: (pwd) => /[0-9]/.test(pwd)
        },
        especial: {
            id: 'criterio-especial',
            validar: (pwd) => /[!@#$%^&*()\-_=+\[\]{}|;:\'",.<>?\/`~]/.test(pwd)
        }
    };

    // Elementos del DOM
    const inputPassword = document.getElementById('nuevoPasswordRegistro');
    const criteriosDiv = document.getElementById('criteriosContrasena');
    const barraFortaleza = document.getElementById('barraFortaleza');
    const toggleButtons = document.querySelectorAll('.togglePassword');

    // Inicializar event listeners si el input existe
    if (inputPassword) {
        inputPassword.addEventListener('input', validarContrasenaEnTiempoReal);
        inputPassword.addEventListener('focus', mostrarCriterios);
        inputPassword.addEventListener('blur', ocultarCriterios);
    }

    // Toggle para mostrar/ocultar contraseña
    toggleButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-target');
            const input = document.querySelector(targetId);
            
            if (input) {
                if (input.type === 'password') {
                    input.type = 'text';
                    this.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    input.type = 'password';
                    this.innerHTML = '<i class="fas fa-eye"></i>';
                }
            }
        });
    });

    /**
     * Valida la contraseña en tiempo real
     */
    function validarContrasenaEnTiempoReal() {
        const password = inputPassword.value;
        mostrarCriterios();
        
        // Actualizar estado de cada criterio
        let cumplidos = 0;
        for (const [key, criterio] of Object.entries(CRITERIOS)) {
            const elemento = document.getElementById(criterio.id);
            const cumple = criterio.validar(password);
            
            if (cumple) {
                cumplidos++;
                elemento.classList.remove('text-danger');
                elemento.classList.add('text-success');
                elemento.querySelector('i').classList.remove('fa-times-circle');
                elemento.querySelector('i').classList.add('fa-check-circle');
            } else {
                elemento.classList.add('text-danger');
                elemento.classList.remove('text-success');
                elemento.querySelector('i').classList.add('fa-times-circle');
                elemento.querySelector('i').classList.remove('fa-check-circle');
            }
        }
        
        // Actualizar barra de fortaleza
        actualizarBarraFortaleza(password, cumplidos);
        
        // Habilitar/deshabilitar botón de registro
        const btnRegistro = document.querySelector('#modal-registroAprendiz button[type="submit"]');
        if (btnRegistro) {
            btnRegistro.disabled = cumplidos < 5;
            if (cumplidos < 5) {
                btnRegistro.classList.add('disabled');
                btnRegistro.title = 'Completa todos los criterios de contraseña';
            } else {
                btnRegistro.classList.remove('disabled');
                btnRegistro.title = '';
            }
        }
    }

    /**
     * Actualiza la barra de fortaleza de contraseña
     */
    function actualizarBarraFortaleza(password, criteriosCumplidos) {
        const indicador = document.getElementById('indicadorFortaleza');
        const textoFortaleza = document.getElementById('textoFortaleza');
        const porcentaje = (criteriosCumplidos / 5) * 100;
        
        indicador.style.width = porcentaje + '%';
        indicador.setAttribute('aria-valuenow', porcentaje);
        
        // Determinar color y texto según fortaleza
        if (password.length === 0) {
            barraFortaleza.style.display = 'none';
        } else {
            barraFortaleza.style.display = 'block';
            
            if (criteriosCumplidos === 5) {
                indicador.style.backgroundColor = '#28a745'; // Verde - Fuerte
                textoFortaleza.textContent = 'Fuerte';
            } else if (criteriosCumplidos >= 3) {
                indicador.style.backgroundColor = '#ffc107'; // Amarillo - Moderada
                textoFortaleza.textContent = 'Moderada';
            } else {
                indicador.style.backgroundColor = '#dc3545'; // Rojo - Débil
                textoFortaleza.textContent = 'Débil';
            }
        }
    }

    /**
     * Muestra los criterios de validación
     */
    function mostrarCriterios() {
        if (criteriosDiv && inputPassword.value.length > 0) {
            criteriosDiv.style.display = 'block';
        }
    }

    /**
     * Oculta los criterios si la contraseña está vacía
     */
    function ocultarCriterios() {
        if (inputPassword.value.length === 0) {
            criteriosDiv.style.display = 'none';
            barraFortaleza.style.display = 'none';
        }
    }

    /**
     * Validación antes de enviar el formulario
     */
    const formRegistro = document.querySelector('#modal-registroAprendiz form');
    if (formRegistro) {
        formRegistro.addEventListener('submit', function(e) {
            const password = inputPassword.value;
            
            // Validar que la contraseña no esté vacía
            if (!password) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Contraseña requerida',
                    text: 'Por favor, define una contraseña que cumpla con los criterios de seguridad.',
                    confirmButtonText: 'Aceptar'
                });
                inputPassword.focus();
                return false;
            }
            
            // Validar que cumpla todos los criterios
            let todosCumplidos = true;
            for (const [key, criterio] of Object.entries(CRITERIOS)) {
                if (!criterio.validar(password)) {
                    todosCumplidos = false;
                    break;
                }
            }
            
            if (!todosCumplidos) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Contraseña inválida',
                    text: 'La contraseña no cumple con todos los criterios de seguridad. Por favor, revisa los requisitos.',
                    confirmButtonText: 'Aceptar'
                });
                inputPassword.focus();
                return false;
            }
        });
    }
});

/**
 * Función global para validar contraseña (usada en validación del servidor)
 * Retorna objeto con validez y errores
 */
function validarContrasenaGlobal(password) {
    const CRITERIOS = {
        longitud: (pwd) => pwd.length >= 8,
        mayuscula: (pwd) => /[A-Z]/.test(pwd),
        minuscula: (pwd) => /[a-z]/.test(pwd),
        numero: (pwd) => /[0-9]/.test(pwd),
        especial: (pwd) => /[!@#$%^&*()\-_=+\[\]{}|;:\'",.<>?\/`~]/.test(pwd)
    };

    const errores = [];
    let valida = true;

    if (!CRITERIOS.longitud(password)) {
        errores.push('La contraseña debe tener al menos 8 caracteres.');
        valida = false;
    }
    if (!CRITERIOS.mayuscula(password)) {
        errores.push('La contraseña debe contener al menos una letra mayúscula.');
        valida = false;
    }
    if (!CRITERIOS.minuscula(password)) {
        errores.push('La contraseña debe contener al menos una letra minúscula.');
        valida = false;
    }
    if (!CRITERIOS.numero(password)) {
        errores.push('La contraseña debe contener al menos un número.');
        valida = false;
    }
    if (!CRITERIOS.especial(password)) {
        errores.push('La contraseña debe contener al menos un carácter especial (!@#$%^&*).');
        valida = false;
    }

    return { valida, errores };
}

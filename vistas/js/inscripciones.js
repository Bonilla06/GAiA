document.addEventListener('DOMContentLoaded', function() {
  
  // ============================================
  // LOGICA DEL SWITCH USUARIO/ADMINISTRADOR
  // ============================================
  var switchBtn = document.getElementById('switchVistaAdmin');
  var vistaUsuario = document.getElementById('vistaUsuario');
  var vistaAdmin = document.getElementById('vistaAdmin');
  var btnDoc = document.getElementById('btnSubirDocumento');

  if(switchBtn) {
    switchBtn.addEventListener('change', function() {
      if(this.checked) {
        vistaUsuario.style.display = 'none';
        vistaAdmin.style.display = 'block';
        if(btnDoc) btnDoc.style.display = 'none';
      } else {
        vistaUsuario.style.display = 'block';
        vistaAdmin.style.display = 'none';
        if(btnDoc) btnDoc.style.display = 'block';
      }
    });
  }

  var btnAbrirSubirArchivo = document.getElementById('btnAbrirSubirArchivo');
  if(btnAbrirSubirArchivo) {
    btnAbrirSubirArchivo.addEventListener('click', function() {
      $('#modalInfoBancaria').modal('hide');
      setTimeout(function(){
        $('#modalSubirArchivo').modal('show');
      }, 400);
    });
  }

  // ============================================
  // TABS DE ADMINISTRADOR (OPACIDAD ETC)
  // ============================================
  $('#adminTabs .nav-link').on('click', function(){
    $('#adminTabs .nav-link').removeClass('active bg-success').addClass('bg-success');
    $(this).addClass('active text-white bg-success');

    var index = $(this).parent().index();
    $('.admin-indicador').text(index + 1);
  });

  $('.btn-admin-sig').on('click', function(){
    var $active = $('#adminTabs .nav-link.active');
    var $next = $active.parent().next().children('.nav-link');
    if($next.length > 0) {
      $next.tab('show');
      $next.click();
    }
  });

  $('.btn-admin-ant').on('click', function(){
    var $active = $('#adminTabs .nav-link.active');
    var $prev = $active.parent().prev().children('.nav-link');
    if($prev.length > 0) {
      $prev.tab('show');
      $prev.click();
    }
  });

  // ============================================
  // LOGICA DEL MODAL DE PASOS
  // ============================================
  let pdCurrentStep = 1;
  const pdTotalSteps = 8;
  const btnPdSiguiente = document.getElementById('btnPdSiguiente');
  const btnPdAnterior = document.getElementById('btnPdAnterior');
  const pdCircles = document.querySelectorAll('.pd-circle');
  const pdModalTitle = document.getElementById('pdModalTitle');
  
  const stepTitles = {
    1: "DATOS PERSONALES DEL APRENDIZ",
    2: "DATOS DE FORMACIÓN",
    3: "DATOS DEL REPRESENTANTE LEGAL",
    4: "VIVIENDA Y SERVICIO",
    5: "INFORMACION SOCIOECONOMICA",
    6: "DOCUMENTO DE SOPORTE DEL APRENDIZ Y REPRESENTANTE",
    7: "CONDICIONES DEL APRENDIZ",
    8: "CONDICIONES DEL APRENDIZ PAG 2"
  };
  
  function updatePdStep(step) {
    for(let i=1; i<=pdTotalSteps; i++) {
      let el = document.getElementById('pd-step-' + i);
      if(el) el.style.display = 'none';
    }
    let currentEl = document.getElementById('pd-step-' + step);
    if(currentEl) currentEl.style.display = 'block';

    pdCircles.forEach(c => {
      c.classList.remove('active');
      if(parseInt(c.getAttribute('data-step')) === step) {
        c.classList.add('active');
      }
    });

    if(step === pdTotalSteps) {
      if(btnPdSiguiente) btnPdSiguiente.textContent = 'siguiente';
    } else {
      if(btnPdSiguiente) btnPdSiguiente.textContent = 'Siguiente';
    }

    if(step > 1) {
      if(btnPdAnterior) {
        btnPdAnterior.textContent = (step === 8) ? 'Atras' : 'Anterior';
      }
    } else {
      if(btnPdAnterior) {
        btnPdAnterior.textContent = 'Cancelar';
      }
    }

    if(pdModalTitle && stepTitles[step]) {
      pdModalTitle.textContent = stepTitles[step];
    }
  }

  if (btnPdSiguiente) {
    btnPdSiguiente.addEventListener('click', function() {
      if (pdCurrentStep < pdTotalSteps) {
        pdCurrentStep++;
        updatePdStep(pdCurrentStep);
      } else {
        $('#modalConfirmacion').modal('show');
      } 
    });
  }

  if (btnPdAnterior) {
    btnPdAnterior.addEventListener('click', function() {
      if (pdCurrentStep > 1) {
        pdCurrentStep--;
        updatePdStep(pdCurrentStep);
      } else {
        $('#modalDatosPersonales').modal('hide');
      }
    });
  }

  pdCircles.forEach(circle => {
    circle.addEventListener('click', function() {
      pdCurrentStep = parseInt(this.getAttribute('data-step'));
      updatePdStep(pdCurrentStep);
    });
  });
  
  $('#btnContinuarConfirmacion').on('click', function() {
    setTimeout(function() {
      $('#modalExitoInscripcion').modal('show');
    }, 400);
  });

  $('#btnFinalizarTodo').on('click', function() {
    $('#modalDatosPersonales').modal('hide');
  });

  $('#modalSubirArchivo').on('show.bs.modal', function () {
    setTimeout(function() {
      $('.modal-backdrop').last().css('z-index', 1059);
    }, 10);
  });

  $('#modalSubirArchivo, #modalConfirmacion, #modalExitoInscripcion').on('hidden.bs.modal', function() {
     if ($('.modal.show').length > 0) {
       $('body').addClass('modal-open');
     }
  });

});

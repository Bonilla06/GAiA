  <!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Identificacion de Apoyos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Apoyos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" id="vista-identificacion">
      <div class="container-fluid">
        <!-- Título -->
        <div class="row mb-5 justify-content-center mt-4">
          <div class="col-auto">
             <!-- Este border especifico se queda igual debido a que son clases nativas de bootstrap, pero el letter spacing irá a css -->
            <div class="border border-secondary px-4 py-2 bg-dark shadow-sm">
              <h3 class="m-0 font-weight-bold text-uppercase text-white titulo-seccion">APOYOS DISPONIBLES</h3>
            </div>
          </div>
        </div>

        <!-- Tarjetas de Apoyos -->
        <div class="row justify-content-center px-4">
          
          <!-- ALIMENTACION -->
          <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#modalAlimentacion">
              <div class="card h-100 elevation-3 apoyo-card">
                <div class="card-body d-flex flex-column">
                  <h5 class="font-weight-bold text-dark">ALIMENTACION</h5>
                  <div class="mt-auto">
                    <span class="text-dark plus-icon">+</span>
                  </div>
                </div>
              </div>
            </a>
          </div>

          <!-- MEDIOS TECNOLOGICOS -->
          <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#modalMedios">
              <div class="card h-100 elevation-3 apoyo-card">
                <div class="card-body d-flex flex-column">
                  <h5 class="font-weight-bold text-dark">MEDIOS<br>TECNOLOGICOS</h5>
                  <div class="mt-auto">
                    <span class="text-dark plus-icon">+</span>
                  </div>
                </div>
              </div>
            </a>
          </div>

          <!-- SOSTENIMIENTO REGULAR -->
          <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#modalSostenimiento">
              <div class="card h-100 elevation-3 apoyo-card">
                <div class="card-body d-flex flex-column">
                  <h5 class="font-weight-bold text-dark">SOSTENIMIENTO<br>REGULAR</h5>
                  <div class="mt-auto">
                    <span class="text-dark plus-icon">+</span>
                  </div>
                </div>
              </div>
            </a>
          </div>

          <!-- TRANSPORTE -->
          <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#modalTransporte">
              <div class="card h-100 elevation-3 apoyo-card">
                <div class="card-body d-flex flex-column">
                  <h5 class="font-weight-bold text-dark">TRANSPORTE</h5>
                  <div class="mt-auto">
                    <span class="text-dark plus-icon">+</span>
                  </div>
                </div>
              </div>
            </a>
          </div>

        </div>
      </div>

      <!-- ==============================================
      MODALES DE APOYOS
      =============================================== -->
      
      <!-- Modal ALIMENTACION -->
      <div class="modal fade apoyo-modal" id="modalAlimentacion" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header align-items-center d-flex">
              <i class="fas fa-utensils"></i>
              <h5 class="modal-title text-center font-weight-bold m-0">ALIMENTACIÓN</h5>
              <button type="button" class="close text-white m-0 p-0" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center pb-4 pt-4 bg-white">
              <button type="button" class="btn btn-secondary mx-1 shadow-sm apoyo-btn">Info. Apoyo</button>
              <button type="button" class="btn btn-danger mx-1 shadow-sm apoyo-btn">Detalles</button>
              <button type="button" class="btn btn-success mx-1 shadow-sm apoyo-btn" style="background-color: #17c42a; border-color: #17c42a;" data-dismiss="modal">Aceptar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal MEDIOS TECNOLOGICOS -->
      <div class="modal fade apoyo-modal" id="modalMedios" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header align-items-center d-flex">
              <i class="fas fa-laptop"></i>
              <h5 class="modal-title text-center font-weight-bold m-0">MEDIOS TECNOLÓGICOS</h5>
              <button type="button" class="close text-white m-0 p-0" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center pb-4 pt-4 bg-white">
              <button type="button" class="btn btn-secondary mx-1 shadow-sm apoyo-btn">Info. Apoyo</button>
              <button type="button" class="btn btn-danger mx-1 shadow-sm apoyo-btn">Detalles</button>
              <button type="button" class="btn btn-success mx-1 shadow-sm apoyo-btn" style="background-color: #17c42a; border-color: #17c42a;" data-dismiss="modal">Aceptar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal SOSTENIMIENTO REGULAR -->
      <div class="modal fade apoyo-modal" id="modalSostenimiento" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header align-items-center d-flex">
              <i class="fas fa-hand-holding-usd"></i>
              <h5 class="modal-title text-center font-weight-bold m-0">SOSTENIMIENTO REGULAR</h5>
              <button type="button" class="close text-white m-0 p-0" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center pb-4 pt-4 bg-white">
              <button type="button" class="btn btn-secondary mx-1 shadow-sm apoyo-btn">Info. Apoyo</button>
              <button type="button" class="btn btn-danger mx-1 shadow-sm apoyo-btn">Detalles</button>
              <button type="button" class="btn btn-success mx-1 shadow-sm apoyo-btn" style="background-color: #17c42a; border-color: #17c42a;" data-dismiss="modal">Aceptar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal TRANSPORTE -->
      <div class="modal fade apoyo-modal" id="modalTransporte" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header align-items-center d-flex">
              <i class="fas fa-bus"></i>
              <h5 class="modal-title text-center font-weight-bold m-0">TRANSPORTE</h5>
              <button type="button" class="close text-white m-0 p-0" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center pb-4 pt-4 bg-white">
              <button type="button" class="btn btn-secondary mx-1 shadow-sm apoyo-btn">Info. Apoyo</button>
              <button type="button" class="btn btn-danger mx-1 shadow-sm apoyo-btn">Detalles</button>
              <button type="button" class="btn btn-success mx-1 shadow-sm apoyo-btn" style="background-color: #17c42a; border-color: #17c42a;" data-dismiss="modal">Aceptar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Fin de modales -->

    </section>
    <!-- /.content -->
  
  <!-- </div> -->
  <!-- /.content-wrapper -->
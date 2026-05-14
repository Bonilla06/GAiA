//===========================================
// ACTIVAR / DESACTIVAR SEDE
//===========================================
$(document).on("click", ".btnActivarSede", function(){
    let boton = $(this);
    let estadoActual = boton.attr("data-estadoSede");
    let idSede = boton.attr("data-idSede");

    $.ajax({
        url: "ajax/sedes.ajax.php",
        method: "POST",
        data: {
            idSedeEstado: idSede,
            estado: estadoActual
        },
        success: function (respuesta) {
            if (respuesta.trim()==="ok"){
                if (estadoActual === "activo") {
                    boton.removeClass("btn-danger");
                    boton.addClass("btn-success");
                    boton.html("activo");
                    boton.attr("data-estadoSede","inactivo");
                } else {
                    boton.removeClass("btn-success");
                    boton.addClass("btn-danger");
                    boton.html("inactivo");
                    boton.attr("data-estadoSede","activo");
                }
            }
        }
    });
});

//===========================================
// EDITAR SEDE
//===========================================
$(document).on("click", ".btnEditarSede", function() {
    let idSede = $(this).attr("data-idSede");
    let datos = new FormData();
    datos.append("idSede", idSede);

    $.ajax({
        url: "ajax/sedes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#idSedeEditar").val(respuesta["id_sede"]);
            $("#editarNombreSede").val(respuesta["descripcion_sede"]);
            $("#editarDireccionSede").val(respuesta["direccion_sede"]);
        }
    });
});

//===========================================
// CONSULTAR SEDE
//===========================================
$(document).on("click", ".btnConsultarSede", function() {
    let idSede = $(this).attr("data-idSede");
    let datos = new FormData();
    datos.append("idSede", idSede);

    $.ajax({
        url: "ajax/sedes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#consultarNombreSede").val(respuesta["descripcion_sede"]);
            $("#consultarDireccionSede").val(respuesta["direccion_sede"]);
        }
    });
});

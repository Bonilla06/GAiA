<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{

    public $nuevoDocumento;

    public function ajaxValidarDocumento(){

        $item = "documento_id";
        $valor = $this->nuevoDocumento;

        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);

    }


}

if (isset($_POST["nuevoDocumento"])) {
    $valDocumento = new AjaxUsuarios();
    $valDocumento->nuevoDocumento = $_POST["nuevoDocumento"];
    $valDocumento->ajaxValidarDocumento();
}

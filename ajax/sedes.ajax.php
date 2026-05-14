<?php

require_once "../controladores/sedes.controlador.php";
require_once "../modelos/sedes.modelo.php";

class AjaxSedes
{

    public $idSedeEstado; // usado para cambiar el estado
    public $estado; // usado para cambiar el estado
    
    public function ajaxCambiarEstado()
    {
        $idSede = $this->idSedeEstado;
        $estado = $this->estado;
        $respuesta = ControladorSedes::ctrCambiarEstadoSede($idSede, $estado);
        echo $respuesta ? 'ok' : 'error';
    }

    public $idSede; // usado para editar/consultar sede

    public function ajaxEditarSede()
    {
        $item = "id_sede";
        $valor = $this->idSede;
        $respuesta = ControladorSedes::ctrMostrarSedes($item, $valor);
        echo json_encode($respuesta);
    }
}

if (isset($_POST["idSedeEstado"]) && isset($_POST["estado"])) {
    $actSede = new AjaxSedes();
    $actSede->idSedeEstado = $_POST["idSedeEstado"];
    $actSede->estado = $_POST["estado"];
    $actSede->ajaxCambiarEstado();
}

if (isset($_POST["idSede"])) {
    $editar = new AjaxSedes();
    $editar->idSede = $_POST["idSede"];
    $editar->ajaxEditarSede();
}

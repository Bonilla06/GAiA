<?php

require_once "conexion.php";

class ModeloSedes
{
    // LISTAR SEDES
    static public function mdlListarSedes()
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM sedes");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // AGREGAR SEDE
    static public function mdlAgregarSede($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (descripcion_sede, direccion_sede) VALUES (:descripcion_sede, :direccion_sede)");
        $stmt->bindParam(":descripcion_sede", $datos["descripcion_sede"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion_sede", $datos["direccion_sede"], PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    // MOSTRAR SEDES
    static public function mdlMostrarSedes($tabla, $item, $valor)
    {
        if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :valor");
            $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    // EDITAR SEDE
    static public function mdlEditarSede($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion_sede = :descripcion_sede, direccion_sede = :direccion_sede WHERE id_sede = :id_sede");
        
        $stmt->bindParam(":descripcion_sede", $datos["descripcion_sede"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion_sede", $datos["direccion_sede"], PDO::PARAM_STR);
        $stmt->bindParam(":id_sede", $datos["id_sede"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    // CAMBIAR ESTADO SEDE
    static public function mdlCambiarEstadoSede($tabla, $idSede, $estado)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado WHERE id_sede = :id");
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":id", $idSede, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

}

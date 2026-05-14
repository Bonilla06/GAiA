<?php
require_once "modelos/conexion.php";
$stmt = Conexion::conectar()->prepare("DESCRIBE usuarios");
$stmt->execute();
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));

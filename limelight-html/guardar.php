<?php
include_once '../bd/conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();

$titulo = $_POST['titulo'];
$imagen = $_POST['imagen'];
$archivo = $_POST['archivo'];

$consulta = "INSERT INTO recursos (titulo, imagen, archivo) VALUES ('$titulo', '$imagen', '$archivo')";
$resultado = $conexion->prepare($consulta);

if ($resultado->execute()) {
    echo json_encode(array('status' => 'success', 'msg' => 'Recurso guardado correctamente'));
} else {
    echo json_encode(array('status' => 'error', 'msg' => 'Error al guardar el recurso'));
}

$conexion = NULL;
?>

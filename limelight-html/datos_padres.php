<?php
// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $campoNuevo1 = $_POST["campoNuevo1"];
    $campoNuevo2 = $_POST["campoNuevo2"];

    // Puedes realizar validaciones adicionales aquí antes de almacenar los datos

    // Almacenar los datos en algún lugar (por ejemplo, en un archivo o base de datos)
    // Aquí puedes personalizar según tu necesidad

    // Ejemplo de almacenamiento en un archivo de texto
    $archivo = "recursos_padres.txt";
    $contenido = "Título: $titulo\nDescripción: $descripcion\nCampo Nuevo 1: $campoNuevo1\nCampo Nuevo 2: $campoNuevo2\n\n";

    // Abre el archivo en modo escritura y añade el contenido
    file_put_contents($archivo, $contenido, FILE_APPEND);

    // Puedes agregar mensajes de éxito, redirecciones, etc. según tu aplicación
    echo "Datos almacenados exitosamente.";
} else {
    // Manejar la situación donde no se reciben datos POST
    echo "No se recibieron datos del formulario.";
}
?>

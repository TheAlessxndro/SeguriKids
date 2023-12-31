<?php
// Agrega la configuración de la base de datos y la conexión
$servername = "localhost";
$username = "root";
$password = "";
$database = "crud_2019";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si la solicitud es una petición POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los datos del formulario
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];

    // Realiza la inserción en la base de datos (ajusta según tu lógica)
    $sql = "INSERT INTO recursos (nombre, descripcion) VALUES ('$titulo', '$descripcion')";
    if ($conn->query($sql) === TRUE) {
        // Si la inserción es exitosa, devuelve un mensaje de éxito (puedes ajustar según tus necesidades)
        echo json_encode(["success" => true, "message" => "Inserción exitosa"]);
    } else {
        // Si hay un error, devuelve un mensaje de error (puedes ajustar según tus necesidades)
        echo json_encode(["success" => false, "message" => "Error en la inserción: " . $conn->error]);
    }

    // Cierra la conexión
    $conn->close();
    exit(); // Importante: termina la ejecución después de manejar la solicitud POST
}

// Si no es una solicitud POST, devuelve los datos (ajusta según tus necesidades)
$query = "SELECT id, nombre, descripcion FROM recursos";
$result = $conn->query($query);

if ($result) {
    $tusDatos = array();

    while ($row = $result->fetch_assoc()) {
        $tusDatos[] = $row;
    }

    echo json_encode($tusDatos);
} else {
    echo json_encode(["error" => "Error en la consulta: " . $conn->error]);
}

// Cierra la conexión al final del archivo
$conn->close();
?>

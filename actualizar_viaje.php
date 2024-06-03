<?php
// Verificar si se recibieron datos del formulario para actualizar un viaje
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["nombre"]) && isset($_POST["descripcion"])) {
    // Recuperar los datos del formulario
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];

    // Verificar si los campos no están vacíos
    if (!empty($id) && !empty($nombre) && !empty($descripcion)) {
        // Establecer la conexión con la base de datos (suponiendo que estás utilizando MySQL)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "examenfinal";

        $conexion = new mysqli($servername, $username, $password, $dbname);

        if ($conexion->connect_errno) {
            echo "Error en la conexión: " . $conexion->connect_error . "\n";
        } else {
            // Preparar la consulta SQL para actualizar los datos
            $sql = "UPDATE viajes SET nombre='$nombre', descripcion='$descripcion' WHERE ID='$id'";

            // Ejecutar la consulta
            if ($conexion->query($sql) === TRUE) {
                // Devolver una respuesta exitosa si la actualización fue exitosa
                echo "La actualización del viaje fue exitosa.";
            } else {
                echo "Error al actualizar datos: " . $conexion->error;
            }
            // Cerrar la conexión
            $conexion->close();
        }
    }
}
?>

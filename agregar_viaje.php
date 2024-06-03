<?php
// Verificar si se recibieron datos del formulario para agregar un viaje
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nombre"]) && isset($_POST["precio"]) && isset($_POST["descripcion"])) {
    // Recuperar los datos del formulario
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $descripcion = $_POST["descripcion"];

    // Verificar si los campos no están vacíos
    if (!empty($nombre) && !empty($precio) && !empty($descripcion)) {
        // Establecer la conexión con la base de datos (suponiendo que estás utilizando MySQL)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "examenfinal";

        $conexion = new mysqli($servername, $username, $password, $dbname);

        if ($conexion->connect_errno) {
            echo "Error en la conexión: " . $conexion->connect_error . "\n";
        } else {
            // Preparar la consulta SQL para insertar los datos
            $sql = "INSERT INTO viajes (nombre, precio, descripcion) VALUES ('$nombre', '$precio', '$descripcion')";

            // Ejecutar la consulta
            if ($conexion->query($sql) === TRUE) {
                // Mostrar el modal cuando los datos se inserten correctamente
                echo '<script>
                        window.onload = function() {
                            $("#modalExito").modal("show");
                        }
                      </script>';
            } else {
                echo "Error al insertar datos: " . $conexion->error;
            }
            // Cerrar la conexión
            $conexion->close();
        }
    }
}
?>

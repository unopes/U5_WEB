<?php
// Verificar si se recibió un ID para eliminar un viaje
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idE"])) {
    // Obtener el ID del formulario
    $idE = $_POST["idE"];

    // Verificar si el ID no está vacío
    if (!empty($idE)) {
        // Establecer la conexión con la base de datos (suponiendo que estás utilizando MySQL)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "examenfinal";

        $conexion = new mysqli($servername, $username, $password, $dbname);

        if ($conexion->connect_errno) {
            echo "Error en la conexión: " . $conexion->connect_error;
        } else {
            // Consultar si el viaje aún existe en la base de datos
            $sql_check = "SELECT id FROM viajes WHERE id = '$idE'";
            $result_check = $conexion->query($sql_check);

            if ($result_check->num_rows > 0) {
                // El viaje aún existe, proceder con la eliminación
                $sql_delete = "DELETE FROM viajes WHERE id = '$idE'";
                
                if ($conexion->query($sql_delete) === TRUE) {
                    // Mostrar el modal cuando los datos se eliminen correctamente
                    echo '<script>
                            window.onload = function() {
                                $("#modalExitoEliminar").modal("show");
                            }
                          </script>';
                } else {
                    echo "Error al eliminar el viaje: " . $conexion->error;
                }
            } else {
                // El viaje no existe, mostrar un mensaje indicando que ya ha sido eliminado
            }

            // Cerrar la conexión
            $conexion->close();
        }
    }
}
?>

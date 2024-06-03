<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <img src="assets/cerebro.png" alt="" class="img d-none d-md-block img-logo">
            <a class="navbar-brand" href="index.html">Mexíco Explora</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item" id="inicio">
                        <a class="nav-link" href="index.html" onclick="closeNavbar()">Inicio</a>
                    </li>
                    <li class="nav-item" id="acercadenosotros">
                        <a class="nav-link" href="acercadenosotros.html" onclick="closeNavbar()">Acerca de nosotros</a>
                    </li>
                    <li class="nav-item" id="contacto">
                        <a class="nav-link" href="contacto.html" onclick="closeNavbar()">Contacto</a>
                    </li>
                    <li class="nav-item" id="galeria">
                        <a class="nav-link" href="galeria.html" onclick="closeNavbar()">Galeria</a>
                    </li>
                    <!-- Agrega aquí más elementos de navegación -->
                </ul>
            </div>
        </div>
    </nav>

    <div style="height: 50px;"></div>

    <div class="container mt-5 col-sm-12 col-md-6 col-lg-6 shadow-lg p-3 bg-body-tertiary rounder">
        <h2 class="mb-4" style="text-align: center;">Agregar Viaje</h2>
        <form id="contactForm" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
                <div class="invalid-feedback">
                    Por favor ingresa tu nombre.
                </div>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="text" class="form-control" id="precio" name="precio" required>
                <div class="invalid-feedback">
                    Por favor ingresa el precio.
                </div>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                <div class="invalid-feedback">
                    Por favor ingresa una descripcion.
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Enviar</button>
        </form>
    </div>

    <?php
    // Incluir el archivo PHP que contiene el código para agregar viaje
    include 'agregar_viaje.php';
    ?>

    <!-- Modal de éxito -->
    <div class="modal fade" id="modalExito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Éxito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Se ha agregado un viaje correctamente.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <?php
    // Incluir el archivo PHP que contiene el código para agregar viaje
    include 'eliminar_viaje.php';
    ?>

    <!-- Modal de éxito -->
    <div class="modal fade" id="modalExitoEliminar" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Éxito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Se ha eliminado correctamente.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5 shadow-lg p-3 bg-body-tertiary rounder">
        <h2 class="mb-4" style="text-align: center;">Lista de Viajes</h2>
        <form class="mb-4" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar por ID o nombre" name="search">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mostrar los viajes obtenidos de la base de datos
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "examenfinal";

                    $conexion = new mysqli($servername, $username, $password, $dbname);

                    if ($conexion->connect_errno) {
                        echo "Error en la conexión: " . $conexion->connect_error;
                    } else {
                        // Verificar si se recibió un valor de búsqueda
                        if (isset($_GET['search'])) {
                            $search = $_GET['search'];
                            // Modifica la consulta SQL para que tenga en cuenta el valor de búsqueda
                            $sql = "SELECT * FROM viajes WHERE ID LIKE '%$search%' OR NOMBRE LIKE '%$search%'";
                        } else {
                            // Consulta SQL para seleccionar todos los viajes si no hay un valor de búsqueda
                            $sql = "SELECT * FROM viajes";
                        }

                        $result = $conexion->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["ID"] . "</td>";
                                echo "<td>" . $row["NOMBRE"] . "</td>";
                                echo "<td>" . $row["DESCRIPCION"] . "</td>";
                                echo "<td>" . $row["PRECIO"] . "</td>";
                                echo "<td><form method='POST'><input type='hidden' name='idE' value='" . $row["ID"] . "'><button type='submit' class='btn btn-danger'>Eliminar</button></form></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No hay viajes disponibles</td></tr>";
                        }

                        // Cerrar la conexión
                        $conexion->close();
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container mt-5 shadow-lg p-3 bg-body-tertiary rounder col-lg-6 col-sm-12 col-md-12">
        <h2 class="mb-4" style="text-align: center;">Modificar Viaje</h2>
        <form id="editForm" method="POST" action="actualizar_viaje.php">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" class="form-control" id="id" name="id" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nuevo Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Nueva Descripción:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>

    <!-- Modal de éxito -->
    <div class="modal fade" id="modalExito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Éxito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Se ha modificado el viaje correctamente.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script>
        // Mostrar el modal de éxito después de enviar el formulario
        $('#editForm').submit(function (event) {
            event.preventDefault(); // Evitar el envío del formulario por defecto
            var formData = $(this).serialize(); // Obtener los datos del formulario

            // Enviar la solicitud AJAX para actualizar el viaje
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function (response) {
                    // Mostrar el modal de éxito
                    $('#modalExito').modal('show');
                    // Actualizar la página después de 2 segundos
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    </script>



    <!-- Agrega jQuery antes de cargar bootstrap.min.js -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
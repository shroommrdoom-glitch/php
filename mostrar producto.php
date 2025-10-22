<?php
include_once("conexion.php");

$conexion_exitosa = false;
$alumnos = [];

if ($conn) {
    $conexion_exitosa = true;

    try {
        $stmt = $conn->query("SELECT * FROM alumnos");
        $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al consultar la base de datos: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas en consultorio nutrición</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="logo.png">
</head>
<body>
    <div class="browser-window">
        <div class="top-bar">
            <div class="circles">
                <div class="circle circle-red"></div>
                <div class="circle circle-yellow"></div>
                <div class="circle circle-green"></div>
            </div>
            <div class="address-bar"></div>
            <div class="right-icons">
                <div class="icon"></div>
            </div>
        </div>
        <div class="content">
            <div class="header">
                <div class="logo">
                    <img src="logo.jpg" alt="Logotipo de tu empresa" style="width:300px; height:200px;">
                    <h1>CITAS NUTRICIÓN</h1>
                </div>
            </div>

            <div class="actions">
                <button onclick="mostrarMensajeConexion()">Conectar BD</button>
                <button onclick="location.href='mostrar producto.php'">Mostrar todos</button>
            </div>

            <div class="status-bar" id="status-bar">
                <span class="status-indicator"></span>
            </div>

            <div id="infoContacto" style="display:none; padding: 10px; background-color: #f0f0f0; border-radius: 5px; margin-bottom: 10px;">
                <p><strong>Dirección:</strong> Calle Principal #123, Ciudad</p>
                <p><strong>Teléfono:</strong> 555-1234</p>
            </div>

            <div class="data-table">
                <h2>Listado de alumnos</h2>
                <table border="1" cellpadding="5">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Fecha de nacimiento</th>
                        <th>Ciudad</th>
                        <th>Promedio</th>
                    </tr>
                    <?php foreach ($alumnos as $alumno): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($alumno['id_alumno']); ?></td>
                            <td><?php echo htmlspecialchars($alumno['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($alumno['apellido']); ?></td>
                            <td><?php echo htmlspecialchars($alumno['correo']); ?></td>
                            <td><?php echo htmlspecialchars($alumno['telefono']); ?></td>
                            <td><?php echo htmlspecialchars($alumno['fecha_de_nacimiento']); ?></td>
                            <td><?php echo htmlspecialchars($alumno['ciudad']); ?></td>
                            <td><?php echo htmlspecialchars($alumno['promedio']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

    <script>
        var conexionExitosa = <?php echo json_encode($conexion_exitosa); ?>;

        function mostrarMensajeConexion() {
            var statusBar = document.getElementById('status-bar');
            var statusIndicator = document.querySelector('.status-indicator');

            if (conexionExitosa) {
                statusIndicator.textContent = '✔';
                statusIndicator.style.color = 'green';
                statusBar.innerHTML = '<span class="status-indicator">✔</span> BD conectada';
            } else {
                statusIndicator.textContent = '✖';
                statusIndicator.style.color = 'red';
                statusBar.innerHTML = '<span class="status-indicator">✖</span> Error al conectar a la BD';
            }
        }
    </script>
</body>
</html>

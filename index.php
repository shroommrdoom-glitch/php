<?php
include_once("conexion.php");

$conexion_exitosa = false;
$alumnos = [];

if ($conn) {
    $conexion_exitosa = true;

    try {
        $stmt = $conn->query("SELECT id, nombre, apellido, correo, telefono, fecha_nacimiento, ciudad, promedio FROM personas ORDER BY id DESC");
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
    <title>Sistema de Gestión - Colegio</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="icon" href="logo27.jpg">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="logo27.jpg" alt="Logo del Colegio" class="logo-img">
                <h1>Sistema de Gestión - Colegio</h1>
            </div>
            <div class="estado-conexion">
                <span class="indicador"></span>
                BD conectada
            </div>
        </div>

        <div class="actions">
            <button onclick="mostrarMensajeConexion()">Conectar BD</button>
            <button onclick="location.href='mostrar producto.php'">Mostrar todos</button>
            <button onclick="location.href='index.php'">Inicio</button>
        </div>

        <div class="content">
            <div class="status-bar" id="status-bar">
                <span class="status-indicator"></span>
                Conectado a la base de datos
            </div>

            <div class="data-table">
                <h2>Listado de Alumnos (<?php echo count($alumnos); ?> registros)</h2>
                <?php if (count($alumnos) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Ciudad</th>
                            <th>Promedio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alumnos as $alumno): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($alumno['id']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['apellido']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['correo']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['telefono']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['fecha_nacimiento']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['ciudad']); ?></td>
                                <td><?php echo number_format($alumno['promedio'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <p style="text-align: center; padding: 20px; color: #666;">No hay registros de alumnos en la base de datos.</p>
                <?php endif; ?>
            </div>
        </div>

        <footer>
            <p>© 2025 Sistema de Gestión - Colegio</p>
        </footer>
    </div>

    <script>
        var conexionExitosa = <?php echo json_encode($conexion_exitosa); ?>;

        // Actualizar indicador al cargar la página
        window.onload = function() {
            var indicador = document.querySelector('.indicador');
            if (conexionExitosa) {
                indicador.style.backgroundColor = '#00ff00';
                indicador.style.boxShadow = '0 0 5px #00ff00';
            } else {
                indicador.style.backgroundColor = '#ff0000';
                indicador.style.boxShadow = '0 0 5px #ff0000';
            }
        };

        function mostrarMensajeConexion() {
            var statusBar = document.getElementById('status-bar');
            var statusIndicator = document.querySelector('.status-indicator');

            if (conexionExitosa) {
                statusIndicator.textContent = '✔';
                statusIndicator.style.color = 'white';
                statusBar.innerHTML = '<span class="status-indicator">✔</span> BD conectada exitosamente';
                statusBar.style.backgroundColor = '#2ecc71';
            } else {
                statusIndicator.textContent = '✖';
                statusIndicator.style.color = 'white';
                statusBar.innerHTML = '<span class="status-indicator">✖</span> Error al conectar a la BD';
                statusBar.style.backgroundColor = '#e74c3c';
            }
        }
    </script>
</body>
</html>
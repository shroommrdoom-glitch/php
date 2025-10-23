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
    <title>COLEGIO SADBOYZ - Listado de Alumnos</title>
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
                    <img src="logo.jpg" alt="Logotipo del colegio" style="width:300px; height:200px;">
                    <h1>COLEGIO ALLIS</h1>
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
                <h2>Listado de alumnos (<?php echo count($alumnos); ?> registros)</h2>
                <?php if (count($alumnos) > 0): ?>
                <table border="1" cellpadding="5">
                    <thead>
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
                    <p>No hay registros de alumnos en la base de datos.</p>
                <?php endif; ?>
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
                statusBar.innerHTML = '<span class="status-indicator">✔</span> BD conectada exitosamente';
                statusBar.style.backgroundColor = '#2ecc71';
            } else {
                statusIndicator.textContent = '✖';
                statusIndicator.style.color = 'red';
                statusBar.innerHTML = '<span class="status-indicator">✖</span> Error al conectar a la BD';
                statusBar.style.backgroundColor = '#e74c3c';
            }
        }
    </script>
</body>
</html>
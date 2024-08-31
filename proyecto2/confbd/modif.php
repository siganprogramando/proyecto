<?php
$servername = "localhost";
$username = "root"; // Cambia esto si es necesario
$password = ""; // Cambia esto si es necesario
$dbname = "clinicas";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener especialidades para el menú desplegable
$sql_especialidades = "SELECT codespecialidades, especialidades FROM especialidades";
$result_especialidades = $conn->query($sql_especialidades);

// Obtener todos los usuarios activos
$sql_users = "SELECT m.id, m.medico, m.codespecialidad, e.enlaces, s.especialidades
              FROM medicos m
              LEFT JOIN enlaces e ON m.id = e.id AND e.activo = 1
              LEFT JOIN especialidades s ON m.codespecialidad = s.codespecialidades
              WHERE m.activo = 1";
$result_users = $conn->query($sql_users);

// Marcar usuario como inactivo si se proporciona el ID
if (isset($_GET['deactivate'])) {
    $deactivate_id = intval($_GET['deactivate']);

    // Marcar como inactivo en la tabla enlaces
    $stmt = $conn->prepare("UPDATE enlaces SET activo = 0 WHERE id = ?");
    $stmt->bind_param("i", $deactivate_id);
    $stmt->execute();
    $stmt->close();

    // Marcar como inactivo en la tabla medicos
    $stmt = $conn->prepare("UPDATE medicos SET activo = 0 WHERE id = ?");
    $stmt->bind_param("i", $deactivate_id);
    $stmt->execute();
    $stmt->close();

    // Redireccionar para evitar reenvío del formulario
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Usuarios Registrados</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Usuarios Registrados</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Médico</th>
                <th>Especialidad</th>
                <th>Enlace</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_users->num_rows > 0) {
                while($row = $result_users->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['medico']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['especialidades']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['enlaces']) . "</td>";
                    echo "<td>
                            <a href='modify_user.php?id=" . $row['id'] . "'>Modificar</a>
                            <a href='?deactivate=" . $row['id'] . "' onclick='return confirm(\"¿Estás seguro de que deseas desactivar este usuario?\")'>Desactivar</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay usuarios registrados.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

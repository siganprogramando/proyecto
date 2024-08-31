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

// Buscar y cargar datos del usuario si se especifica el ID
$user = null;
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
    $sql_user = "SELECT * FROM medicos WHERE id = ?";
    $stmt = $conn->prepare($sql_user);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user_result = $stmt->get_result();
    if ($user_result->num_rows > 0) {
        $user = $user_result->fetch_assoc();
    }
    $stmt->close();
}

// Actualizar datos si el formulario es enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medico_id = $_POST['id'];
    $medico = $_POST['medico'];
    $especialidad_id = $_POST['especialidad'];
    $enlace = $_POST['enlace'];

    // Validar la existencia de la especialidad
    $stmt = $conn->prepare("SELECT 1 FROM especialidades WHERE codespecialidades = ?");
    $stmt->bind_param("i", $especialidad_id);
    $stmt->execute();
    $especialidad_result = $stmt->get_result();
    if ($especialidad_result->num_rows == 0) {
        die("Especialidad no válida.");
    }
    $stmt->close();

    // Preparar y ejecutar consulta para actualizar el médico
    $stmt = $conn->prepare("UPDATE medicos SET medico = ?, codespecialidad = ? WHERE id = ?");
    $stmt->bind_param("sii", $medico, $especialidad_id, $medico_id);
    $stmt->execute();
    $stmt->close();

    // Preparar y ejecutar consulta para actualizar el enlace
    $stmt = $conn->prepare("UPDATE enlaces SET enlaces = ? WHERE id = ?");
    $stmt->bind_param("si", $enlace, $medico_id);
    $stmt->execute();
    $stmt->close();

    echo "Datos actualizados correctamente.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modificar Usuario</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Modificar Datos del Usuario</h1>
    <?php if ($user): ?>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

        <label for="medico">Nombre del Médico:</label>
        <input type="text" id="medico" name="medico" value="<?php echo htmlspecialchars($user['medico']); ?>" required><br><br>

        <label for="especialidad">Especialidad:</label>
        <select id="especialidad" name="especialidad" required>
            <?php
            if ($result_especialidades->num_rows > 0) {
                while($row = $result_especialidades->fetch_assoc()) {
                    $selected = ($row['codespecialidades'] == $user['codespecialidad']) ? 'selected' : '';
                    echo "<option value='" . $row['codespecialidades'] . "' $selected>" . $row['especialidades'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay especialidades disponibles</option>";
            }
            ?>
        </select><br><br>

        <label for="enlace">Enlace:</label>
        <input type="text" id="enlace" name="enlace" value="<?php echo htmlspecialchars($user['enlaces']); ?>" required><br><br>

        <input type="submit" value="Actualizar">
    </form>
    <?php else: ?>
    <p>Usuario no encontrado.</p>
    <?php endif; ?>
</body>
</html>

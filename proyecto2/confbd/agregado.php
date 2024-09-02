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

// Insertar datos si el formulario es enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medico = $_POST['medico'];
    $especialidad_id = $_POST['especialidad'];
    $enlace = $_POST['enlace'];

    // Preparar y ejecutar consulta para insertar el médico
    $stmt = $conn->prepare("INSERT INTO medicos (medico, codespecialidad) VALUES (?, ?)");
    $stmt->bind_param("si", $medico, $especialidad_id);
    $stmt->execute();
    $medico_id = $stmt->insert_id; // Obtener ID del médico insertado
    $stmt->close();

    // Preparar y ejecutar consulta para insertar el enlace
    $stmt = $conn->prepare("INSERT INTO enlaces (id, enlaces) VALUES (?, ?)");
    $stmt->bind_param("is", $medico_id, $enlace); // Asegúrate de que el tipo de datos coincide con la estructura de tu tabla
    $stmt->execute();
    $stmt->close();

    echo "Datos agregados correctamente.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Datos</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Agregar Datos a la Base de Datos</h1>
    <form method="POST">
        <label for="medico">Nombre del Médico:</label>
        <input type="text" id="medico" name="medico" required><br><br>

        <label for="especialidad">Especialidad:</label>
        <select id="especialidad" name="especialidad" required>
            <?php
            if ($result_especialidades->num_rows > 0) {
                while($row = $result_especialidades->fetch_assoc()) {
                    echo "<option value='" . $row['codespecialidades'] . "'>" . $row['especialidades'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay especialidades disponibles</option>";
            }
            ?>
        </select><br><br>

        <label for="enlace">Enlace:</label>
        <input type="text" id="enlace" name="enlace" required><br><br>

        <input type="submit" value="Agregar">
    </form>
</body>
</html>

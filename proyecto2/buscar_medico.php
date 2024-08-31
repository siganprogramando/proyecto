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

$especialidad = $_GET['especialidad'];
$nombre = $_GET['nombre'];

$sql = "SELECT m.medico, e.especialidades, l.enlaces 
        FROM medicos m
        JOIN especialidades e ON m.codespecialidad = e.codespecialidades
        LEFT JOIN enlaces l ON m.id = l.id
        WHERE m.codespecialidad LIKE ? AND m.medico LIKE ?";
$stmt = $conn->prepare($sql);
$especialidad_param = "%{$especialidad}%";
$nombre_param = "%{$nombre}%";
$stmt->bind_param("ss", $especialidad_param, $nombre_param);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Obtener el enlace
        $enlace = $row['enlaces'];

        // Analizar y modificar el enlace
        $parsed_url = parse_url($enlace);
        $host = $parsed_url['host'] ?? $enlace; // Usa el host si está disponible

        // Eliminar 'www.' si está presente
        $host = preg_replace('/^www\./', '', $host);

        // Mostrar los resultados
        echo "<p><strong>Médico:</strong> " . $row['medico'] . " - <strong>Especialidad:</strong> " . $row['especialidades'] . " - <strong>Reservar</strong> <a href='" . $enlace . "'>AQUI</a></p>";
    }
} else {
    echo "No se encontraron resultados.";
}

$stmt->close();
$conn->close();
?>

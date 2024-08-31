<?php

session_start();

// Definir el tiempo máximo de inactividad en segundos (ej. 15 minutos = 900 segundos)
$timeout_duration = 10;

// Comprobar si la última actividad está establecida en la sesión
if (isset($_SESSION['LAST_ACTIVITY'])) {
    $elapsed_time = time() - $_SESSION['LAST_ACTIVITY'];
    
    // Si ha pasado más tiempo que el tiempo de inactividad, cerrar sesión
    if ($elapsed_time >= $timeout_duration) {
        session_unset();     // Eliminar todas las variables de sesión
        session_destroy();   // Destruir la sesión
        header("Location:  http://localhost/proyecto2/admin/index.php"); // Redirigir a la página de inicio de sesión
        exit();
    }
}

// Actualizar el tiempo de la última actividad
$_SESSION['LAST_ACTIVITY'] = time();





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

// Manejo de la búsqueda y paginación
$filasmax = 5;
$pagina = isset($_GET['pag']) ? intval($_GET['pag']) : 1;
$buscar = isset($_POST['txtbuscar']) ? $_POST['txtbuscar'] : '';

$especialidad_param = "%{$buscar}%";
$nombre_param = "%{$buscar}%";

if ($buscar) {
    $sql = "SELECT m.medico, e.especialidades, l.enlaces 
            FROM medicos m
            JOIN especialidades e ON m.codespecialidad = e.codespecialidades
            LEFT JOIN enlaces l ON m.id = l.id
            WHERE m.codespecialidad LIKE ? OR m.medico LIKE ?";
} else {
    $sql = "SELECT m.medico, e.especialidades, l.enlaces 
            FROM medicos m
            JOIN especialidades e ON m.codespecialidad = e.codespecialidades
            LEFT JOIN enlaces l ON m.id = l.id
            LIMIT " . (($pagina - 1) * $filasmax)  . "," . $filasmax;
}

$stmt = $conn->prepare($sql);

if ($buscar) {
    $stmt->bind_param("ss", $especialidad_param, $nombre_param);
}

$stmt->execute();
$result = $stmt->get_result();

// Obtener el número total de médicos si no se está buscando
if (!$buscar) {
    $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_medicos FROM medicos");
    $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_medicos'];
} else {
    $maxusutabla = $result->num_rows; // Para búsqueda, solo el número de resultados encontrados
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>VaidrollTeam</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="logo.png">
</head>
<body>
    <div class="cont">
        <form method="POST">
            <h1>Lista de médicos</h1>

            <a href="index.php">Inicio</a>

            <a href="agregado.php?pag=<?php echo $pagina; ?>">Crear médico</a>
            <a href="modif.php?pag=<?php echo $pagina; ?>">Modificar cuenta</a>
            <a href="admin/cerrar_sesion.php?pag=<?php echo $pagina; ?>">cerrar sesion</a>

            <input type="submit" value="Buscar" name="btnbuscar">
            <input type="text" name="txtbuscar" placeholder="Ingresar DNI o Especialidad de médico" autocomplete="off" style='width:20%' value="<?php echo htmlspecialchars($buscar); ?>">
        </form>
        <table>
            <tr>
                <th>Medico</th>
                <th>Especialidades</th>
                <th>Reservar</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $enlace = $row['enlaces'];
                    $parsed_url = parse_url($enlace);
                    $host = $parsed_url['host'] ?? $enlace;
                    $host = preg_replace('/^www\./', '', $host);

                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['medico']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['especialidades']) . "</td>";
                    echo "<td><a href='" . htmlspecialchars($enlace) . "'>AQUI</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No se encontraron resultados.</td></tr>";
            }
            ?>
        </table>
        <div style='text-align:right'>
            <br>
            <?php echo "Total de médicos: " . $maxusutabla; ?>
        </div>
        <div style="text-align:center">
            <?php
            if ($pagina > 1) {
                echo "<a href='index.php?pag=" . ($pagina - 1) . "'>Anterior</a> ";
            } else {
                echo "<a href='#' style='pointer-events: none'>Anterior</a> ";
            }

            if (($pagina * $filasmax) < $maxusutabla) {
                echo "<a href='index.php?pag=" . ($pagina + 1) . "'>Siguiente</a>";
            } else {
                echo "<a href='#' style='pointer-events: none'>Siguiente</a>";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();

?>

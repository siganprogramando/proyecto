<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinicas";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la acción a realizar
$action = $_POST['action'] ?? '';

switch ($action) {
    case 'add':
        $title = $_POST['title'];
        $content = $_POST['content'];
        $image = $_FILES['image']['name'] ?? '';
        $imageTmp = $_FILES['image']['tmp_name'] ?? '';
        $imagePath = 'uploads/' . $image;
        
        if ($image) {
            // Mover la imagen al directorio de uploads
            move_uploaded_file($imageTmp, $imagePath);
        }
        
        $stmt = $conn->prepare("INSERT INTO noticias (titulo, contenido, imagen, activo) VALUES (?, ?, ?, TRUE)");
        $stmt->bind_param("sss", $title, $content, $image);
        
        if ($stmt->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => $stmt->error]);
        }
        $stmt->close();
        break;
    
    case 'edit':
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $image = $_FILES['image']['name'] ?? '';
        $imageTmp = $_FILES['image']['tmp_name'] ?? '';
        $imagePath = 'uploads/' . $image;
        
        if ($image) {
            // Mover la nueva imagen al directorio de uploads
            move_uploaded_file($imageTmp, $imagePath);
            $stmt = $conn->prepare("UPDATE noticias SET titulo = ?, contenido = ?, imagen = ? WHERE id = ?");
            $stmt->bind_param("sssi", $title, $content, $image, $id);
        } else {
            $stmt = $conn->prepare("UPDATE noticias SET titulo = ?, contenido = ? WHERE id = ?");
            $stmt->bind_param("ssi", $title, $content, $id);
        }
        
        if ($stmt->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => $stmt->error]);
        }
        $stmt->close();
        break;

    case 'delete':
        $id = $_POST['id'];
        
        $stmt = $conn->prepare("UPDATE noticias SET activo = FALSE WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => $stmt->error]);
        }
        $stmt->close();
        break;

    case 'list':
        $result = $conn->query("SELECT * FROM noticias WHERE activo = TRUE");
        $news = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($news);
        break;
    
    default:
        echo json_encode(["status" => "error", "message" => "Acción no válida"]);
}

$conn->close();
?>

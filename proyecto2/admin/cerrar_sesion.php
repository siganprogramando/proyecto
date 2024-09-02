<?php
session_start();
session_destroy();
header("Location: http://localhost/proyecto2/admin/index.php");
exit;
?>
<?php 
include_once("conexion.php");
include_once("index.php");

$pagina = $_GET['pag'];
$coddni = $_GET['dni'];

$querybuscar = mysqli_query($conn, "SELECT * FROM usuarios WHERE dni=$coddni");
 
while($mostrar = mysqli_fetch_array($querybuscar))
{
	$usunom 	= $mostrar['nom'];
	$usudni 	= $mostrar['dni'];
    $usudir 	= $mostrar['dir'];
	$usutel 	= $mostrar['tel'];
    $usucorreo 	= $mostrar['email'];
}
?>
<html>
<head>    
		<title>VaidrollTeam</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="caja_popup2">
  <form class="contenedor_popup" method="POST">
        <table>
		<tr><th colspan="2">Modificar usuario</th></tr>
            <tr> 
                <td>Nombre</td>
                <td><input type="text" name="txtnom" value="<?php echo $usunom;?>" required></td>
            </tr>
			   <tr> 
                <td>DNI</td>
                <td><input type="number" name="txtdni" value="<?php echo $usudni;?>" required readonly></td>
            </tr>
        
            <tr> 
                <td>Dirección</td>
                <td><input type="text" name="txtdir" value="<?php echo $usudir;?>" required></td>
            </tr>
			  <tr> 
                <td>Telefono</td>
                <td><input type="number" name="txttel" value="<?php echo $usutel;?>" required></td>
            </tr>
			  <tr> 
                <td>Correo</td>
                <td><input type="text" name="txtcorreo" value="<?php echo $usucorreo;?>" required></td>
            </tr>
            <tr>
				
                <td colspan="2">
				 <?php echo "<a href=\"index.php?pag=$pagina\">Cancelar</a>";?>
				<input type="submit" name="btnmodificar" value="Modificar" onClick="javascript: return confirm('¿Deseas modificar este usuario?');">
				</td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>

<?php
	
	if(isset($_POST['btnmodificar']))
{    
	$nom1 = $_POST['txtnom'];
	$dni1 = $_POST['txtdni'];
	$dir1 = $_POST['txtdir'];
	$tel1 = $_POST['txttel'];
	$correo1 = $_POST['txtcorreo'];
      
    $querymodificar = mysqli_query($conn, "UPDATE usuarios SET nom='$nom1',dni='$dni1',dir='$dir1',email='$correo1' WHERE dni=$dni1");
	echo "<script>window.location= 'index.php?pag=$pagina' </script>";
    
}
?>
	
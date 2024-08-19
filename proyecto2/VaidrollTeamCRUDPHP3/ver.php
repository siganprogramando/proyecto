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
		<tr><th colspan="2">Ver usuario</th></tr>
            <tr> 
                <td>Nombre: </td>
                <td><?php echo $usunom;?></td>
            </tr>
			   <tr> 
                <td>DNI: </td>
                <td><?php echo $usudni;?></td>
            </tr>
        
            <tr> 
                <td>Dirección: </td>
                <td><?php echo $usudir;?></td>
            </tr>
			  <tr> 
                <td>Telefono: </td>
                <td><?php echo $usutel;?></td>
            </tr>
			  <tr> 
                <td>Correo: </td>
                <td><?php echo $usucorreo;?></td>
            </tr>
            <tr>
				
                <td colspan="2">
				 <?php echo "<a href=\"index.php?pag=$pagina\">Regresar</a>";?>
				</td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>


	
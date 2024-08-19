<?php 
include_once("conexion.php"); 
include_once("index.php");

$pagina = $_GET['pag'];
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
		<tr><th colspan="2" >Agregar usuario</th></tr>
            <tr> 
                <td>Nombre</td>
                <td><input type="text" name="txtnom" autocomplete="off"></td>
            </tr>
			 <tr> 
                <td>DNI</td>
                <td><input type="number" name="txtdni" autocomplete="off"></td>
            </tr>
            <tr> 
                <td>Dirección</td>
                <td><input type="text" name="txtdir" autocomplete="off"></td>
            </tr>
            <tr> 
                <td>Telefono</td>
                <td><input type="number" name="txttel" autocomplete="off"></td>
            </tr>
			  <tr> 
                <td>Correo</td>
                <td><input type="text" name="txtcorreo" autocomplete="off"></td>
            </tr>
            <tr> 	
               <td colspan="2" >
				  <?php echo "<a href=\"index.php?pag=$pagina\">Cancelar</a>";?>
				   <input type="submit" name="btnregistrar" value="Registrar" onClick="javascript: return confirm('¿Deseas registrar a este usuario');">
			</td>
            </tr>
        </table>
    </form>
 </div>
</body>
</html>
<?php

		if(isset($_POST['btnregistrar']))
{   
	$vaiusu 	= $_POST['txtnom'];
	$vaidni 	= $_POST['txtdni'];
    $vaidir 	= $_POST['txtdir'];
	$vaitel 	= $_POST['txttel'];
    $vaiemail 	= $_POST['txtcorreo'];

	$queryadd	= mysqli_query($conn, "INSERT INTO usuarios(nom,dni,dir,tel,email) VALUES('$vaiusu','$vaidni','$vaidir','$vaitel','$vaiemail')");
	
 	if(!$queryadd)
	{
		// echo "Error con el registro: ".mysqli_error($conn);
		 echo "<script>alert('DNI duplicado, intenta otra vez');</script>";
		 
	}else
	{
		echo "<script>window.location= 'index.php?pag=1' </script>";
	}
}
?>



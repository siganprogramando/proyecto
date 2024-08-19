<?php
include_once("conexion.php"); 

?>
<!--Busca por VaidrollTeam para más proyectos. -->
<html>
<head>    
		<title>Profesionales</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="style.css">
		
</head>
<body>
    <?php
 
    $filasmax = 5;
 
    if (isset($_GET['pag'])) 
	{
        $pagina = $_GET['pag'];
    } else 
	{
        $pagina = 1;
    }
 
 if(isset($_POST['btnbuscar']))
{
$buscar = $_POST['txtbuscar'];

 $sqlusu = mysqli_query($conn, "SELECT * FROM usuarios where dni = '".$buscar."'");

}
else
{
 $sqlusu = mysqli_query($conn, "SELECT * FROM usuarios ORDER BY nom ASC LIMIT " . (($pagina - 1) * $filasmax)  . "," . $filasmax);
}
 
    $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_usuarios FROM usuarios");
 
    $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_usuarios'];
	
    ?>
	<div class="cont" >
	<form method="POST">
	<h1>Lista de usuarios</h1>
	
	<a href="index.php">Inicio</a>
	
		<?php echo "<a href=\"agregar.php?pag=$pagina\">Crear usuario</a>";?>
			<input type="submit" value="Buscar" name="btnbuscar">
			<input type="text" name="txtbuscar"  placeholder="Ingresar DNI de usuario" autocomplete="off" style='width:20%'>
			</form>
    <table>
			<tr>
			<th>Nombre</th>
			<th>DNI</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Correo</th>
			<th>Acción</th>
			</tr>
 
        <?php
 
        while ($mostrar = mysqli_fetch_assoc($sqlusu)) 
		{
			
            echo "<tr>";
            echo "<td>".$mostrar['nom']."</td>";
			echo "<td>".$mostrar['dni']."</td>";
            echo "<td>".$mostrar['dir']."</td>";    
			echo "<td>".$mostrar['tel']."</td>";  
			echo "<td>".$mostrar['email']."</td>";  
            echo "<td style='width:24%'>
			<a href=\"ver.php?dni=$mostrar[dni]&pag=$pagina\">Ver</a> 
			<a href=\"editar.php?dni=$mostrar[dni]&pag=$pagina\">Modificar</a> 
			<a href=\"eliminar.php?dni=$mostrar[dni]&pag=$pagina\" onClick=\"return confirm('¿Estás seguro de eliminar a $mostrar[nom]?')\">Eliminar</a>
			</td>";  
			
        }
 
        ?>
    </table>
	<div style='text-align:right'>
	<br>
	<?php echo "Total de usuarios: ".$maxusutabla;?>
	</div>
	</div>
<div style='text-align:right'>
<br>
</div>
    <div style="text-align:center">
        <?php
        if (isset($_GET['pag'])) {
		   if ($_GET['pag'] > 1) {
                ?>
					<a href="index.php?pag=<?php echo $_GET['pag'] - 1; ?>">Anterior</a>
            <?php
					} 
				else 
					{
                    ?>
					<a href="#" style="pointer-events: none">Anterior</a>
            <?php
					}
                ?>
 
        <?php
        } 
		else 
		{
            ?>
            <a href="#" style="pointer-events: none">Anterior</a>
            <?php
        }
 
        if (isset($_GET['pag'])) {
            if ((($pagina) * $filasmax) < $maxusutabla) {
                ?>
            <a href="index.php?pag=<?php echo $_GET['pag'] + 1; ?>">Siguiente</a>
        <?php
            } else {
                ?>
            <a href="#" style="pointer-events: none">Siguiente</a>
        <?php
            }
            ?>
        <?php
        } else {
            ?>
            <a href="index.php?pag=2">Siguiente</a>
        <?php
        }
 
        ?>
    </div>

    </form>
</div>
</body>
</html>


<?php include ("controladores/seguridad.php");?>
<html>
<head>
<title>Comprar Videos</title>
<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <a class="brand">ACT-II</a>
            <div class="container">
            <ul class="nav">
                <li class="active"><a href="home_admin.php">Home</a></li>
                <li><a href="videos_admin.php">Videos</a></li>
                <li><a href="usuarios.php">Usuarios</a></li>
                <li><a href="reportes.php">Reportes</a></li>
            </ul>
            <div class="nav-collapse collapse">
            <form class="navbar-search pull-right" action="buscar_admin.php" method="post">
                <input type="text" class="search-query" placeholder="Buscar video..." name="buscar">
            </form>
            </div>
        </div>
        </div>
    </div>
    <div class="hero-unit">
<h1>Comprar videos</h1></br>
Para usuario:
<form action="comprar_videos.php" method="post">
<select name="Ci">
<?php
	$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
	mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
	$sSQL ="SELECT Ci, Nombre FROM persona WHERE Rol = 'Cliente'";
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
	while( $row = mysql_fetch_array ( $result )) 
	{
		echo '<option value="'.$row["Ci"].'" selected>'.$row["Ci"]."-".$row["Nombre"].'</option>';
	}
	mysql_close($bd);

?>
</select>
<input type="submit" name="Editar" value="Seleccionar">
</form>

<?php
	if(isset($_POST["Nro"]))
	{
		$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
		mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
		$sSQL ="DELETE FROM carrito WHERE Nro='".$_POST["Nro"]."'";
		$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
		mysql_close($bd);
	}
?>

<?php
	if(isset($_POST["Sele"]))
	{
		$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
		mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
		$sSQL ="INSERT INTO carrito (Video_Nro, Persona_Ci, Cantidad) VALUES ('".$_POST["Sele"]."','".$_POST["Ci"]."','".$_POST["Canti"]."')";
		$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL sele");
		mysql_close($bd);
	}
?>

<?php
	if(isset($_POST["Ci"]))
	{
		echo "<form action=buscar_videos_venta.php method=post>";
		echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
		echo "<input type=submit value='Anadir Video' >";
		echo "</form>";
		
		echo "<br>";
		$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
		mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
		$sSQL ="SELECT * FROM carrito WHERE Persona_Ci='".$_POST["Ci"]."'";
		$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
		$tot = 0;
		echo "<table>";
		echo "<h1>Videos reservados</h1>";
		echo "<tr> <td>Nombre</td> <td>Precio Unidad</td> <td>Formato</td> <td>Cantidad</td> <td>Total</td> <td></td></tr>";
		while( $row = mysql_fetch_array ( $result )) 
		{
			$bd1 = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión1");
			mysql_select_db("bdsisweb",$bd1) or die ("Error en la selección de la base de datos1");
			$sSQL1 ="SELECT V.Nombre, V.Precio, V.Formato, R.Cantidad FROM (SELECT * FROM video WHERE Nro='".$row["Video_Nro"]."') V, carrito R WHERE R.Video_Nro = V.Nro and R.Nro = '".$row["Nro"]."'";
			$result1 = mysql_query($sSQL1,$bd1) or die ("Error en la consulta SQL1");
			while( $row1 = mysql_fetch_array ( $result1 )) 
			{
				$aux =0;
				$aux2 = 0;
				$aux += $row["Cantidad"];
				$aux2 += $row1["Precio"];
				$aux = $aux*$aux2;
				echo "<tr> <td>".$row1["Nombre"]."</td> <td>".$row1["Precio"]."</td> <td>".$row1["Formato"]."</td> <td>".$row1["Cantidad"]."</td> <td>".$aux."</td> </tr>";
			}
			echo "<td>";
			echo "<form action=comprar_videos.php method=post>";
			echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
			echo "<input type=hidden name=Nro value=".$row["Nro"].">";
			echo "<input type=submit value=Quitar>";
			echo "</form>";
			echo "</td>";
			$tot+=$aux;
		}
		echo "</table>";
		echo "Total a pagar: ".$tot."<br>";
		echo "<form action=comprar.php method=post>";
		echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
		echo "<input type=hidden name=Total value=".$tot.">";
		echo "<input type=submit value=Comprar>";
		echo "</form>";
		
	}
?>
</body>
</html>
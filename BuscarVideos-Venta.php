<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>

<h3>Buscar<br /></h3>
<form action="BuscarVideos-Venta.php" method="post">
	Por Nombre: <input type="text" name="pornombre" /> 
     <?php
        echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
    ?>
    <input type="submit" value="Buscar" />
</form>

<form action="BuscarVideos-Venta.php" method="post">
	Por Categor&iacute;a 
    <select name="Categoria">
	<?php
        $bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
        mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
        $sSQL ="SELECT * FROM categoria";
        $result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
        while( $row = mysql_fetch_array ( $result )) 
        {
            echo '<option value="'.$row["Nro_Categoria"].'" selected>'.$row["Nombre"].'</option>';
        }
        mysql_close($bd);
    ?> 
	</select> <input type="submit" value="Buscar" />
    <?php
        echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
    ?>
</form>

<form action="BuscarVideos-Venta.php" method="post">
	Por Sub Categor&iacute;a 
    <select name="SubCategoria">
	<?php
        $bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
        mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
        $sSQL ="SELECT * FROM sub_categoria";
        $result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
        while( $row = mysql_fetch_array ( $result )) 
        {
            echo '<option value="'.$row["Nro_Categoria"].'" selected>'.$row["Nombre"].'</option>';
        }
        mysql_close($bd);
    ?> 
	</select> <input type="submit" value="Buscar" />
</form>

<form action="BuscarVideos-Venta.php" method="post">
	Por Formato:
    <select name="Formato">
    	<option value="dvd" selected>DVD</option>
        <option value="bluRay" selected>Blue-Ray</option>
        <option value="3d" selected>3D</option>
    </select> 
     <?php
        echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
    ?>
    <input type="submit" value="Buscar" />
</form>
<?php
	if( isset($_POST["pornombre"]) )
	{
		echo "<table>";
		echo "<tr><td>Nombre</td><td>Formato</td><td>Precio</td><td>Cantidad</td></tr>";
		$bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
        mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
        $sSQL ="SELECT * FROM video";
        $result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
        while( $row = mysql_fetch_array ( $result )) 
        {
			if( strpos($row["Nombre"],$_POST["pornombre"]) !== false )
			{
				echo "<tr>";
				echo "<td>";
           		echo $row["Nombre"];
				echo "</td>";
				echo "<td>";
           		echo $row["Formato"];
				echo "</td>";
				echo "<td>";
           		echo $row["Precio"];
				echo "</td>";
				echo "<td>";
           		echo $row["Cantidad"];
				echo "</td>";
				echo "<td>";
           			echo "<form action=ComprarVideos.php method=post>";
					echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
					echo "<input type=hidden name=Sele value=".$row["Nro"].">";
					echo "Cantidad a comprar: <input type=number max=".$row["Cantidad"]." min=1 name=Canti> ";
					echo "<input type=submit value=Reservar>";
					echo "</form>";
				echo "</td>";
				echo "</tr>";
				
			}
        }
        mysql_close($bd);
		echo "</table>";
	}

?>

<?php
	if( isset($_POST["Categoria"]) )
	{
		echo "<table>";
		echo "<tr><td>Nombre</td><td>Formato</td><td>Precio</td><td>Cantidad</td></tr>";
		$bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
        mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
		$sSQL ="SELECT V.Nro, V.Nombre, V.Formato, V.Precio, V.Cantidad FROM video V, categoria_video CV WHERE V.Nro = CV.Video_Nro and CV.Categoria_Nro = '".$_POST["Categoria"]."'";
        $result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
        while( $row = mysql_fetch_array ( $result )) 
        {
			echo "<tr>";
			echo "<td>";
           	echo $row["Nombre"];
			echo "</td>";
			echo "<td>";
           	echo $row["Formato"];
			echo "</td>";
			echo "<td>";
           	echo $row["Precio"];
			echo "</td>";
			echo "<td>";
           	echo $row["Cantidad"];
			echo "</td>";
			echo "<td>";
           		echo "<form action=ComprarVideos.php method=post>";
				echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
				echo "<input type=hidden name=Sele value=".$row["Nro"].">";
				echo "Cantidad a comprar: <input type=number max=".$row["Cantidad"]." min=1 name=Canti> ";
				echo "<input type=submit value=Reservar>";
				echo "</form>";
			echo "</td>";
			echo "</tr>";
        }
        mysql_close($bd);
		echo "</table>";
	}

?>

<?php
	if( isset($_POST["SubCategoria"]) )
	{
		echo "<table>";
		echo "<tr><td>Nombre</td><td>Formato</td><td>Precio</td><td>Cantidad</td></tr>";
		$bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
        mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
		$sSQL ="SELECT V.Nro, V.Nombre, V.Formato, V.Precio, V.Cantidad FROM video V, subcategoria_video CV WHERE V.Nro = CV.Video_Nro and CV.Sub_Categoria_Nro = '".$_POST["SubCategoria"]."'";
        $result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
        while( $row = mysql_fetch_array ( $result )) 
        {
			echo "<tr>";
			echo "<td>";
           	echo $row["Nombre"];
			echo "</td>";
			echo "<td>";
           	echo $row["Formato"];
			echo "</td>";
			echo "<td>";
           	echo $row["Precio"];
			echo "</td>";
			echo "<td>";
           	echo $row["Cantidad"];
			echo "</td>";
			echo "<td>";
           		echo "<form action=ComprarVideos.php method=post>";
				echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
				echo "<input type=hidden name=Sele value=".$row["Nro"].">";
				echo "Cantidad a comprar: <input type=number max=".$row["Cantidad"]." min=1 name=Canti> ";
				echo "<input type=submit value=Reservar>";
				echo "</form>";
			echo "</td>";
			echo "</tr>";
        }
        mysql_close($bd);
		echo "</table>";
	}
?>

<?php
	if( isset($_POST["Formato"]) )
	{
		echo "<table>";
		echo "<tr><td>Nombre</td><td>Formato</td><td>Precio</td><td>Cantidad</td></tr>";
		$bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
        mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
        $sSQL ="SELECT * FROM video WHERE Formato = '".$_POST["Formato"]."'";
        $result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
        while( $row = mysql_fetch_array ( $result )) 
        {
			echo "<tr>";
			echo "<td>";
           	echo $row["Nombre"];
			echo "</td>";
			echo "<td>";
           	echo $row["Formato"];
			echo "</td>";
			echo "<td>";
           	echo $row["Precio"];
			echo "</td>";
			echo "<td>";
           	echo $row["Cantidad"];
			echo "</td>";
			echo "<td>";
           		echo "<form action=ComprarVideos.php method=post>";
				echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
				echo "<input type=hidden name=Sele value=".$row["Nro"].">";
				echo "Cantidad a comprar: <input type=number max=".$row["Cantidad"]." min=1 name=Canti> ";
				echo "<input type=submit value=Reservar>";
				echo "</form>";
			echo "</td>";
			echo "</tr>";
        }
        mysql_close($bd);
		echo "</table>";
	}
?>
</body>
</html>
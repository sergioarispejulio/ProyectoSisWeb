<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Buscar</title>
<link rel="stylesheet" href="css/bootstrap.css">
<script>
function validarNro(e) {
	var key;
	if(window.event) // IE
	{
		key = e.keyCode;
	}
	else if(e.which) // Netscape/Firefox/Opera
	{
		key = e.which;
	}
	if (key < 48 || key > 57)
	{
		return false;
	}
	return true;
}
</script>
</head>

<body>

<h3>Buscar<br /></h3>
<form action="BuscarVideos.php" method="post">
	Por Nombre: <input type="text" name="pornombre" /> <input type="submit" value="Buscar" />
</form>

<form action="BuscarVideos.php" method="post">
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
</form>

<form action="BuscarVideos.php" method="post">
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

<form action="BuscarVideos.php" method="post">
	Por Formato:
    <select name="Formato">
    	<option value="dvd" selected>DVD</option>
        <option value="bluRay" selected>Blue-Ray</option>
        <option value="3d" selected>3D</option>
    </select> <input type="submit" value="Buscar" />
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
			echo "</tr>";
        }
        mysql_close($bd);
		echo "</table>";
	}
?>


<!-- echo "<form>";
echo "<input type=hidden name=posicion value=".$row["Nro"]."  />";
echo "<input type=hidden name=precio value=".$row["Precio"]."  />";
echo "<input type=hidden name=cant_actu value=".$row["Cantidad"]."  />;
echo "<input type=text name=cant onkeypress=javascript:return validarNro(event) />";
echo "<input type=submit value=Ordenar />"
echo "</form>" -->
</body>
</html>
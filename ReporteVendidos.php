<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>

<?php
		$bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
		mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
		$sSQL ="SELECT Nombre, Formato, Precio, Cantidad FROM video order by CantVendidos DESC";
		$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL1");
		echo "<table>";
		echo "<tr> <td>Nombre Video</td> <td>Formato</td> <td>Precio</td> <td>Cantidad Disponible</td> </tr>";
		while( $row = mysql_fetch_array ( $result )) 
		{
			echo "<tr> <td>".$row["Nombre"]."</td> <td>".$row["Formato"]."</td> <td>".$row["Precio"]."</td> <td>".$row["Cantidad"]."</td> </tr>";
		}
		echo "</table>";
		mysql_close($bd);
?>

</body>
</html>
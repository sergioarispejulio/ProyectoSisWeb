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
		$sSQL ="SELECT Ci, Nombre, Fecha_Nacimiento FROM persona WHERE Rol = 'Cliente' order by Ci DESC";
		$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL1");
		$tot = mysql_num_rows($result);
		echo "<table>";
		echo "<tr> <td>Ci</td> <td>Nombre</td> <td>Fecha de Nacimiento</td> </tr>";
		while( $row = mysql_fetch_array ( $result )) 
		{
			echo "<tr> <td>".$row["Ci"]."</td> <td>".$row["Nombre"]."</td> <td>".$row["Fecha_Nacimiento"]."</td> </tr>";
			$bd1 = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión1");
			mysql_select_db("bdsisweb",$bd1) or die ("Error en la selección de la base de datos1");
			$sSQL ="SELECT VE.Nro, V.Nombre, V.Precio, V.Formato, VV.Cantidad FROM video V, venta VE, venta_video VV WHERE VE.Nro = VV.Venta_Nro and VV.Video_Nro = V.Nro and VE.Persona_Ci = '".$row["Ci"]."'";
			$result1 = mysql_query($sSQL,$bd1) or die ("Error en la consulta SQL2");
			echo "<tr> <td>Compras realizadas</td> </tr>";
			echo "<tr>";
			echo "<table>";
			echo "<tr> <td>Nro Venta</td> <td>Nombre</td> <td>Formato</td> <td>Cantidad</td> <td>Total Precio</td> </tr>";
			while( $row1 = mysql_fetch_array ( $result1 )) 
			{
				$aux = 0;
				$aux+= $row1["Precio"];
				$aux1 = 0;
				$aux1+= $row1["Cantidad"];
				$aux = $aux*$aux1;
				echo "<tr> <td>".$row1["Nro"]."</td> <td>".$row1["Nombre"]."</td> <td>".$row1["Formato"]."</td> <td>".$row1["Cantidad"]."</td> <td>".$aux."</td> </tr>";
			}
			echo "</table>";
			echo "</tr>";
		}
		echo "</table>";
		mysql_close($bd);
?>
</body>
</html>
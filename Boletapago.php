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
	$sSQL ="SELECT * FROM persona WHERE Ci = '".$_POST["Ci"]."'";
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL1");
	while( $valorespe = mysql_fetch_array ( $result )) 
	{
		echo "A nombre de: ".$valorespe["Nombre"]."<br>";
		echo "De Ci: ".$valorespe["Ci"]."<br>";
		echo "Se compraron los siguientes porductos";
	}
	$tot=0;
	$sSQL ="SELECT * FROM venta WHERW Nro = '".$_POST["Nro"]."'";
	$sSQL ="SELECT VE.Nro, V.Nombre, V.Precio, V.Formato, V.Precio, VV.Cantidad FROM video V, venta VE, venta_video VV WHERE VE.Nro = VV.Venta_Nro and VV.Video_Nro = V.Nro and VE.Persona_Ci = '".$_POST["Ci"]."' and VE.Nro = '".$_POST["Nro"]."'";
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL2");
	echo "<table>";
	echo "<tr> <td>Nro Venta</td> <td>Nombre</td> <td>Formato</td> <td>Cantidad</td> <td>Precio</td> <td>Total Precio</td> </tr>";
	while( $row1 = mysql_fetch_array ( $result )) 
	{
		$aux = 0;
		$aux+= $row1["Precio"];
		$aux1 = 0;
		$aux1+= $row1["Cantidad"];
		$aux = $aux*$aux1;
		$tot+= $aux;
		echo "<tr> <td>".$row1["Nro"]."</td> <td>".$row1["Nombre"]."</td> <td>".$row1["Formato"]."</td> <td>".$row1["Cantidad"]."</td> <td>".$row1["Precio"]."</td> <td>".$aux."</td> </tr>";
	}
	echo "</table>";
	echo "</tr>";
	echo "Total: ".$tot."<br>";
	mysql_close($bd);
?>
</body>
</html>
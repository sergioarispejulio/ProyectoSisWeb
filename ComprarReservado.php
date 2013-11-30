<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<form action="ComprarReservado.php" method="post">
<select name="Ci">
<?php
	$bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
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
<input type="submit" name="Editar" />
</form>

<?php
	if(isset($_POST["Nro"]))
	{
		$bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
		mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
		$sSQL ="DELETE FROM reserva WHERE Nro='".$_POST["Nro"]."'";
		$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
		mysql_close($bd);
	}
?>

<?php
	if(isset($_POST["Ci"]))
	{
		echo "<br>";
		$bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
		mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
		$sSQL ="SELECT * FROM reserva WHERE Persona_Ci='".$_POST["Ci"]."'";
		$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
		$tot = 0;
		echo "<table>";
		echo "<tr> <td>Nombre</td> <td>Precio Unidad</td> <td>Formato</td> <td>Cantidad</td> <td>Total</td> <td></td></tr>";
		while( $row = mysql_fetch_array ( $result )) 
		{
			$bd1 = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión1");
			mysql_select_db("bdsisweb",$bd1) or die ("Error en la selección de la base de datos1");
			$sSQL1 ="SELECT V.Nombre, V.Precio, V.Formato, R.Cantidad FROM (SELECT * FROM video WHERE Nro='".$row["Video_Nro"]."') V, reserva R WHERE R.Video_Nro = V.Nro and R.Nro = '".$row["Nro"]."'";
			$result1 = mysql_query($sSQL1,$bd1) or die ("Error en la consulta SQL1");
			$aux =0;
			$aux2 = 0;
			while( $row1 = mysql_fetch_array ( $result1 )) 
			{
				$aux += $row["Cantidad"];
				$aux2 += $row1["Precio"];
				$aux = $aux*$aux2;
				echo "<tr> <td>".$row1["Nombre"]."</td> <td>".$row1["Precio"]."</td> <td>".$row1["Formato"]."</td> <td>".$row1["Cantidad"]."</td> <td>".$aux."</td> </tr>";
			}
			echo "<td>";
			echo "<form action=ComprarReservado.php method=post>";
			echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
			echo "<input type=hidden name=Nro value=".$row["Nro"].">";
			echo "<input type=submit value=Quitar>";
			echo "</form>";
			echo "</td>";
			$tot+=$aux;
		}
		echo "</table>";
		echo "Total a pagar: ".$tot."<br>";
		echo "<form action=Comprar2.php method=post>";
		echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
		echo "<input type=hidden name=Total value=".$tot.">";
		echo "<input type=submit value=Comprar>";
		echo "</form>";
		
	}
?>

</body>
</html>
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
	$sSQL ="INSERT INTO venta (Persona_Ci) VALUES ('".$_POST["Ci"]."')";
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL1");
	$sSQL ="SELECT * FROM reserva WHERE Persona_Ci='".$_POST["Ci"]."'";
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL2");
	$tot = mysql_num_rows($result);
	$sSQL = "SELECT * FROM venta order by Nro DESC limit 1";
	$valor = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL3");
	while( $valorespe = mysql_fetch_array ( $valor )) 
	{
		while( $row = mysql_fetch_array ( $result )) 
		{
				$sSQL ="INSERT INTO venta_video (Video_Nro, Venta_Nro, Cantidad) VALUES ('".$row["Video_Nro"]."','".$valorespe["Nro"]."','".$row["Cantidad"]."')";
				$result1 = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL3");
				$sSQL ="UPDATE video SET CantVendidos=CantVendidos+'".$row["Cantidad"]."' WHERE Nro='".$row["Video_Nro"]."'";
				$result1 = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL4");
				$sSQL ="DELETE FROM reserva WHERE Persona_Ci='".$_POST["Ci"]."'";
				$result1 = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL5");
		}
		$nue =$valorespe["Nro"];
	}
	mysql_close($bd);
	echo "Venta Registrada<br>";
	echo "<form action=Boletapago.php method=post>";
		echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
		echo "<input type=hidden name=Nro value=".$nue.">";
		echo "<input type=submit value=GenerarBoleta>";
	echo "</form>";
	
?>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php
	if(isset($_POST["Ci"]) == false || isset($_POST["Nombre"]) == false || isset($_POST["Dia"])== false  ||  isset($_POST["Mes"]) == false ||  isset($_POST["Ano"]) == false )
	{
		header("Location: Modificar-Vista.php?errordatos=si");
	}
	$bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
	mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
	$sSQL ="SELECT Ci FROM persona";
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
	while( $row = mysql_fetch_array ( $result )) 
	{
		if($row["Ci"] == $_POST["Ci"] && !($row["Ci"] == $_POST["Ciantiguo"]))
		{
			header("Location: Modificar-Vista.php?errorusuario=si");
		}
	}
	mysql_close($bd);
	$fecha = new DateTime();
	$fecha->setDate($_POST["Ano"], $_POST["Mes"],$_POST["Dia"]);
	$str = $fecha->format('Y-m-d');
	$bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
	mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
	$sSQL ="UPDATE persona SET Ci = ".$_POST["Ci"].", Nombre = ".$_POST["Nombre"].", Fecha_Nacimiento = ".$str." WHERE Ci = ".$_POST["Ciantiguo"];
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
	mysql_close($bd);
	echo "Actualización exitosa";

?>
</body>
</html>
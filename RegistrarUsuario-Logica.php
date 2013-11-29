<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php

	if(isset($_POST["Ci"]) == false || isset($_POST["Nombre"]) == false || isset($_POST["Contra"]) == false || isset($_POST["Dia"])== false  ||  isset($_POST["Mes"]) == false ||  isset($_POST["Ano"]) == false || isset($_POST["Login"]) == false)
	{
		header("Location: RegistrarUsuario-Vista.php?errordatos=si");
	}
	$contra =  $_POST["Contra"];
	if(strlen($contra) < 8 || strlen($contra) > 20)
	{
		header("Location: RegistrarUsuario-Vista.php?errorcontrasena=si");
	}
	$bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
	mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
	$sSQL ="SELECT Ci FROM persona";
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
	while( $row = mysql_fetch_array ( $result )) 
	{
		if($row["Ci"] == $_POST["Ci"])
		{
			header("Location: RegistrarUsuario-Vista.php?errorusuario=si");
		}
	}
	mysql_close($bd);
	$encriptada = $contra;
	$str = $_POST["Ano"]."-".$_POST["Mes"]."-".$_POST["Dia"];
	$bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
	mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
	$sSQL ="INSERT INTO persona (Ci, Nombre, Fecha_Nacimiento, Login, Contrasena, Rol) VALUES ('".$_POST["Ci"]."','".$_POST["Nombre"]."','".$str."','".$_POST["Login"]."','".$encriptada."','Cliente')";
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
	mysql_close($bd);
	echo "Ingreso exitoso";

?>
</body>
</html>
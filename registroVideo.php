<?php
$nombre = $_POST["nombre"];
$validar = false;
$db = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("bdsisweb",$db);
$res = mysql_query("SELECT nombre FROM video WHERE nombre = '$nombre'",$db);
while($row = mysql_fetch_row($res)){
	if($row["Nombre"]==$_POST["nombre"] && $row["Formato"]==$_POST["formato"])
		$validar=true;
}
if($validar==false)
{
	$res = mysql_query("SELECT * FROM video",$db);
	$nombre = $_POST["nombre"];
	$precio = $_POST["cantidad"];
	$cantidad = $_POST["precio"];
	$formato = $_POST["formato"];
	$res = mysql_query("INSERT INTO  video (nombre, formato, precio, cantidad) VALUES ('".$nombre."', '".$formato."', '".$precio."', '".$cantidad."')",$db) or die ("Error en la consulta SQL");
	echo "Registrado";
	mysql_close($db);
}
else{
	echo "Ya existe registro";
}		
	
?>
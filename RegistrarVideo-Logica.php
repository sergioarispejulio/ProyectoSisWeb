<?php
$nombre = $_POST["nombre"];
$validar = false;
$db = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("bdsisweb",$db);
$res = mysql_query("SELECT nombre FROM video WHERE nombre = '$nombre' and Formato='".$_POST["formato"]."'",$db);
while($row = mysql_fetch_row($res)){
	if($row[0]==$nombre)
		$validar=true;
}
if($validar==false)
{
	$res = mysql_query("SELECT * FROM video",$db);
	$nro = mysql_num_rows($res);
	$nombre = $_POST["nombre"];
	$precio = $_POST["cantidad"];
	$cantidad = $_POST["precio"];
	$formato = $_POST["formato"];
	$fecha = date("d-m-y h:m:s");
	$res = mysql_query("INSERT INTO video(nombre, formato, precio, cantidad, fecha, CantVendidos) VALUES ('".$nombre."', '".$formato."', '".$precio."', '".$cantidad."', '".$fecha."','0')",$db);
	echo "Registrado";
	mysql_close($db);
}
else{
	echo "Ya existe registro";
}		
	
?>
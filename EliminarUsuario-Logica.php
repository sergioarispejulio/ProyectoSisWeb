<?php
	$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
	mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
	$sSQL ="DELETE FROM persona WHERE Ci=".$_POST["Ci"];
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
	mysql_close($bd);
	echo "Usuario Eliminado";
?>

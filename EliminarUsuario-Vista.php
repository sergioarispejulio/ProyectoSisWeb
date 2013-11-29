<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Eliminar Usuario</title>
<link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
<h1><center>Eliminar Usuario</center></h1>


Seleccione Usuario para eliminar<br />
<form action="EliminarUsuario-Logica.php" method="post">
<select name="Ci">
<?php
	$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
	mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
	$sSQL ="SELECT Ci, Nombre FROM persona";
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
	while( $row = mysql_fetch_array ( $result )) 
	{
		echo '<option value="'.$row["Ci"].'" selected>'.$row["Ci"]."-".$row["Nombre"].'</option>';
	}
	mysql_close($bd);

?>
</select>
<input type="submit" name="Eliminar" />
</form>
</body>
</html>
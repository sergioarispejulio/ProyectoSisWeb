<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script>
function validarNro(e) {
	var key;
	if(window.event) // IE
	{
		key = e.keyCode;
	}
	else if(e.which) // Netscape/Firefox/Opera
	{
		key = e.which;
	}
	if (key < 48 || key > 57)
	{
		return false;
	}
	return true;
}
</script>
</head>

<body>
<h1><center>Editar Usuario</center></h1>

<br /><br />
Seleccione Usuario para editar<br />
<form action="ModificarUsuario-Vista.php" method="post">
<select name="Ci">
<?php
	$bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
	mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
	$sSQL ="SELECT Ci, Nombre FROM persona";
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
	while( $row = mysql_fetch_array ( $result )) 
	{
		echo '<option value="'.$row["Ci"].'" selected>'.$row["Nombre"].'</option>';
	}
	mysql_close($bd);

?>
</select>
<input type="submit" name="Editar" />
</form>
<?php if (isset($_GET["errordatos"]))
	{
		echo "<bgcolor=red><span style=color:ffffff><b>Alg&iacute;n campo estaba vacio, tiene que rellenar todos los datos</b></span>";
	} ?>
<?php if (isset($_GET["errorusuario"]))
	{
		echo "<bgcolor=red><span style=color:ffffff><b>Usuario ya existente</b></span>";
	} ?>
<?php
	if(isset($_POST["Ci"]))
	{
		$bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
		mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
		$sSQL ="SELECT * FROM persona WHERE Ci=".$_POST["Ci"];
		$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
		while( $row = mysql_fetch_array ( $result )) 
		{
			$partes = substr($row["Fecha_Nacimiento"], 0, 10);
			$partes = explode("-", $partes);
			echo "<form action=ModificarUsuario-Logica.php method=post>";
			echo "<input type=hidden value=".$_POST["Ci"]." name=Ciantiguo />";
			echo "Ci: <input type=text name=Ci onkeypress=javascript:return validarNro(event) value=".$row["Ci"]."><br />";
			echo "Nombre Completo: <input type=text name=Nombre value=".$row["Nombre"]."><br />";
			echo "Login: <input type=text name=Login maxlength=45 value=".$row["Login"]." /><br />";
			echo "Fecha Nacimiento<br />";
			echo "<select name=Dia>";
				for ($i=1; $i<=31; $i++) {
					if ($i == $partes[2])
						echo '<option value="'.$i.'" selected>'.$i.'</option>';
					else
						echo '<option value="'.$i.'">'.$i.'</option>';
				}
			echo "</select>";
			echo "<select name=Mes>";
				for ($i=1; $i<=12; $i++) {
					if ($i == $partes[1])
						echo '<option value="'.$i.'" selected>'.$i.'</option>';
					else
						echo '<option value="'.$i.'">'.$i.'</option>';
				}
			echo "</select>";
			echo "<select name=Ano>";
				for($i=date('o'); $i>=1910; $i--){
					if ($i == $partes[0])
						echo '<option value="'.$i.'" selected>'.$i.'</option>';
					else
						echo '<option value="'.$i.'">'.$i.'</option>';
				}
			echo "</select>";
			echo "<br />";
			echo "<input type=submit value=Registrarse />"; 
		echo "</form>";
		}
		mysql_close($bd);
	}
?>
</body>
</html>
<?php include ("controladores/seguridad.php");?>
<html>
<head>
<title>Modificar usuario</title>
<link rel="stylesheet" href="css/bootstrap.css">
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
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <a class="brand">ACT-II</a>
            <div class="container">
            <ul class="nav">
                <li class="active"><a href="home_admin.php">Home</a></li>
                <li><a href="videos_admin.php">Videos</a></li>
                <li><a href="usuarios.php">Usuarios</a></li>
                <li><a href="reportes.php">Reportes</a></li>
            </ul>
            <div class="nav-collapse collapse">
            <form class="navbar-search pull-right" action="buscar_admin.php" method="post">
                <input type="text" class="search-query" placeholder="Buscar video..." name="buscar">
            </form>
            </div>
        </div>
        </div>
    </div>

    <div class="hero-unit">
    <h1>Modificar Usuario</h1>

<br /><br />
Seleccione Usuario para editar:<br />
<form action="modificar_usuario.php" method="post">
<select name="Ci">
<?php
	$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
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
		$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
		mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
		$sSQL ="SELECT * FROM persona WHERE Ci=".$_POST["Ci"];
		$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
		while( $row = mysql_fetch_array ( $result )) 
		{
			$partes = substr($row["Fecha_Nacimiento"], 0, 10);
			$partes = explode("-", $partes);
			echo "<form action=controladores/modificar_usuario.php method=post>";
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
			echo "<input type=submit value=Guardar />"; 
		echo "</form>";
		}
		mysql_close($bd);
	}
?>
</br>
<a href="usuarios.php">Volver</a>
</div>
</body>
</html>
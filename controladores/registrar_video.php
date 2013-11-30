<html>
<head>
<title>Registrar video</title>
<link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <a class="brand">ACT-II</a>
            <div class="container">
            <ul class="nav">
                <li class="active"><a href="../home_admin.php">Home</a></li>
                <li><a href="../videos_admin.php">Videos</a></li>
                <li><a href="../usuarios.php">Usuarios</a></li>
                <li><a href="../reportes.php">Reportes</a></li>
            </ul>
            <div class="nav-collapse collapse">
            <form class="navbar-search pull-right" action="../buscar_admin.php" method="post">
                <input type="text" class="search-query" placeholder="Buscar video..." name="buscar">
            </form>
            </div>
        </div>
        </div>
    </div>

    <div class="hero-unit">
    	<h1>Registrar Video</h1>
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
		$nro_video = mysql_num_rows($res);
		$nombre = $_POST["nombre"];
		$descrip = $_POST["descrip"];
		$actores = $_POST["actores"];
		$director = $_POST["director"];
		$produccion = $_POST["produccion"];
		$precio = $_POST["precio"];
		$cantidad = $_POST["cantidad"];
		$formato = $_POST["formato"];
		$fecha = date("d-m-y h:m:s");
		$res = mysql_query("INSERT INTO video(nombre, formato, precio, cantidad, fecha, CantVendidos, descripcion, actores, director, produccion) VALUES ('".$nombre."', '".$formato."', '".$precio."', '".$cantidad."', '".$fecha."','0', '".$descrip."', '".$actores."', '".$director."', '".$produccion."')",$db);
		echo "Registrado";
		$categoria = $_POST["categoria"];
		$nro_cat = mysql_query("SELECT Nro FROM categoria WHERE nombre = '$categoria'",$db);
		$res = mysql_query("INSERT INTO categoria_video(Categoria_Nro,Video_Nro) VALUES('".$nro_cat."','".$nro_video."')",$db);
		$categoria = $_POST["categoria"];
		$nro_cat = mysql_query("SELECT Nro FROM categoria WHERE nombre = '$categoria'",$db);
		$res = mysql_query("INSERT INTO categoria_video(Categoria_Nro,Video_Nro) VALUES('".$nro_cat."','".$nro_video."')",$db);
		mysql_close($db);
	}
	else{
		echo "Ya existe registro";
	}			
?>
    </br>
    <a href="../videos_admin.php">Volver</a>
    </div>
</body>
</html>
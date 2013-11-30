<html>
<head>
<title>Modificar video</title>
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
    	<h1>Modificar Video</h1>
<?php
	$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
	mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
	$sSQL ="UPDATE video SET Nro = '".$_POST["Nro"]."', Nombre = '".$_POST["Nombre"]."', Descripcion = '".$_POST["Descrip"]."', Actores = '".$_POST["Actores"]."', Director = '".$_POST["Director"]."', Produccion = '".$_POST["Produccion"]."', Formato= '".$_POST["Formato"]."' WHERE Nro = '".$_POST["Nro"]."'";
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL 2");
	mysql_close($bd);
	echo "Actualizacion exitosa";
?>
    </br>
    <a href="../videos_admin.php">Volver</a>
    </div>
</body>
</html>
<html>
<head>
<title>Modificar usuario</title>
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
    <h1>Modificar Usuario</h1>
<?php
	if(isset($_POST["Ci"]) == false || isset($_POST["Nombre"]) == false || isset($_POST["Dia"])== false  ||  isset($_POST["Mes"]) == false ||  isset($_POST["Ano"]) == false )
	{
		header("Location: ../modificar_usuario.php?errordatos=si");
	}
	$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
	mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
	$sSQL ="SELECT Ci FROM persona";
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL 1");
	while( $row = mysql_fetch_array ( $result )) 
	{
		if($row["Ci"] == $_POST["Ci"] && !($row["Ci"] == $_POST["Ciantiguo"]))
		{
			header("Location: ../modificar_usuario.php?errorusuario=si");
		}
	}
	mysql_close($bd);
	$str = $_POST["Ano"]."-".$_POST["Mes"]."-".$_POST["Dia"];
	$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
	mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
	$sSQL ="UPDATE persona SET Ci = '".$_POST["Ci"]."', Nombre = '".$_POST["Nombre"]."', Fecha_Nacimiento = '".$str."', Login = '".$_POST["Login"]."' WHERE Ci = '".$_POST["Ciantiguo"]."'";
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL 2");
	mysql_close($bd);
	echo "Actualización exitosa";

?>
    </br>
    <a href="../usuarios.php">Volver</a>
    </div>
</body>
</html>
<html>
<head>
<title>Reporte formato</title>
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
    <h1>Reporte formato mas solicitado</h1></br>
<?php
		$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
		mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
		$sSQL ="SELECT Formato COUNT(*) as cant FROM video GROUP BY Formato";
		$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL1");
		echo "<table class=table table-hover>";
		echo "<tr> <td>Formato</td> <td>Cantidad</td> </tr>";
		while( $row = mysql_fetch_array ( $result )) 
		{
			echo "<tr> <td>".$row["Formato"]."</td> <td>cant</td> </tr>";
		}
		echo "</table>";
		mysql_close($bd);
?>
</br>
<a href="../reportes.php">Volver</a>
</div>
</body>
</html>
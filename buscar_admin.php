<?php include ("controladores/seguridad.php");?>
<html>
<head>
<title>Buscar</title>
<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <a class="brand">ACT-II</a>
            <div class="container">
            <ul class="nav">
                <li class="active"><a href="home_admin.php">Home</a></li>
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
<h1>Buscar</h1></br>
<?php
	echo "<table class=table table-hover>";
	echo "<tr><td><b>Nombre</td><td><b>Actores</td><td><b>Director</td><td><b>Produccion</td><td><b>Descripcion</td><td><b>Formato</td><td><b>Precio</td><td><b>Cantidad</td></tr>";
	$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
    mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
    $sSQL ="SELECT * FROM video";
    $result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
    while( $row = mysql_fetch_array ( $result )) 
    {
		if( stristr($row["Nombre"],$_POST["buscar"]) !== false )
        {
            echo "<tr>";
            echo "<td>";
            echo $row["Nombre"];
            echo "</td>";
            echo "<td>";
            echo $row["Actores"];
            echo "</td>";
            echo "<td>";
            echo $row["Director"];
            echo "</td>";
            echo "<td>";
            echo $row["Produccion"];
            echo "</td>";
            echo "<td>";
            echo $row["Descripcion"];
            echo "</td>";
            echo "<td>";
            echo $row["Formato"];
            echo "</td>";
            echo "<td>";
            echo $row["Precio"];
            echo "</td>";
            echo "<td>";
            echo $row["Cantidad"];
            echo "</td>";
            echo "</tr>";                         
        }
    }
    mysql_close($bd);
	echo "</table>";
?>
	</div>
</body>
</html>
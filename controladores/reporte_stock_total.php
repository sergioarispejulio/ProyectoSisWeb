<html>
<head>
<title>Reporte stock total</title>
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
    <h1>Reporte stock total</h1></br>
<?php
	 if( isset($_POST["Sele"]) )
     {
		$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
		mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
		$sSQL ="UPDATE video SET Cantidad = Cantidad+'".$_POST["Canti"]."' WHERE Nro='".$_POST["Sele"]."'";
		$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL3");
		mysql_close($bd);
	 }
?>
<?php
		$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
		mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
		$sSQL ="SELECT Nro, Nombre, Formato, Precio, Cantidad FROM video";
		$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL1");
		echo "<table  class=table table-hover>";
		echo "<tr> <td>Nombre Video</td> <td>Formato</td> <td>Precio</td> <td>Cantidad Disponible</td> </tr>";
		while( $row = mysql_fetch_array ( $result )) 
		{
			echo "<tr> <td>".$row["Nombre"]."</td> <td>".$row["Formato"]."</td> <td>".$row["Precio"]."</td> <td>".$row["Cantidad"]."</td> ";
			 							echo "<td>";
										echo "<form action=reporte_stock_total.php method=post>";
                                        echo "<input type=hidden name=Sele value=".$row["Nro"].">";
                                        echo "Cantidad a aumentar: <input type=number min=1 name=Canti> ";
                                        echo "<input type=submit value='Aumentar Stock'>";
                                        echo "</form>";
										echo "<td></tr>";
		}
		echo "</table>";
		mysql_close($bd);
?>
</br>
<a href="../reportes.php">Volver</a>
</body>
</html>
<html>
<head>
<title>Comprar</title>
<link rel="stylesheet" href="css/bootstrap.css">
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
<h1>Comprar</h1></br>
<?php
	$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
	mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
	$sSQL ="INSERT INTO venta (Persona_Ci) VALUES ('".$_POST["Ci"]."')";
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL1");
	$sSQL ="SELECT * FROM carrito WHERE Persona_Ci='".$_POST["Ci"]."'";
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL2");
	$tot = mysql_num_rows($result);
	$sSQL = "SELECT * FROM venta order by Nro DESC limit 1";
	$valor = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL3");
	while( $valorespe = mysql_fetch_array ( $valor )) 
	{
		while( $row = mysql_fetch_array ( $result )) 
		{
				$sSQL ="INSERT INTO venta_video (Video_Nro, Venta_Nro, Cantidad) VALUES ('".$row["Video_Nro"]."','".$valorespe["Nro"]."','".$row["Cantidad"]."')";
				$result1 = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL3");
				$sSQL ="UPDATE video SET Cantidad = Cantidad-'".$row["Cantidad"]."', CantVendidos=CantVendidos+'".$row["Cantidad"]."' WHERE Nro='".$row["Video_Nro"]."'";
				$result1 = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL4");
				$sSQL ="DELETE FROM carrito WHERE Persona_Ci='".$_POST["Ci"]."'";
				$result1 = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL5");
		}
		$nue =$valorespe["Nro"];
	}
	mysql_close($bd);
	echo "Venta Registrada<br>";
	echo "<form action=boleta_pago.php method=post>";
		echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
		echo "<input type=hidden name=Nro value=".$nue.">";
		echo "<input type=submit value=GenerarBoleta>";
	echo "</form>";
	
?>
</div>
</body>
</html>
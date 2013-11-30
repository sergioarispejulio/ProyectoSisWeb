<?php include ("controladores/seguridad.php");?>
<html>
<head>
	<title>Boleta de pago</title>
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
	<div class="navbar navbar-inverse">
  		<div class="navbar-inner">
            <a class="brand">ACT-II</a>
            <div class="container">
            <ul class="nav">
                <li class="active"><a href="index.php">Home</a></li>
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
		<h1>Boleta de pago</h1>
<?php
	$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
	mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
	$sSQL ="SELECT * FROM persona WHERE Ci = '".$_POST["Ci"]."'";
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL1");
	while( $valorespe = mysql_fetch_array ( $result )) 
	{
		echo "A nombre de: ".$valorespe["Nombre"]."<br>";
		echo "Cedula de identidad: ".$valorespe["Ci"]."<br>";
		echo "Se compraron los siguientes productos:";
	}
	$tot=0;
	$sSQL ="SELECT * FROM venta WHERW Nro = '".$_POST["Nro"]."'";
	$sSQL ="SELECT VE.Nro, V.Nombre, V.Precio, V.Formato, V.Precio, VV.Cantidad FROM video V, venta VE, venta_video VV WHERE VE.Nro = VV.Venta_Nro and VV.Video_Nro = V.Nro and VE.Persona_Ci = '".$_POST["Ci"]."' and VE.Nro = '".$_POST["Nro"]."'";
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL2");
	echo "<table class=table table-hover>";
	echo "<tr> <td>Nro Venta</td> <td>Nombre</td> <td>Formato</td> <td>Cantidad</td> <td>Precio</td> <td>Total Precio</td> </tr>";
	while( $row1 = mysql_fetch_array ( $result )) 
	{
		$aux = 0;
		$aux+= $row1["Precio"];
		$aux1 = 0;
		$aux1+= $row1["Cantidad"];
		$aux = $aux*$aux1;
		$tot+= $aux;
		echo "<tr> <td>".$row1["Nro"]."</td> <td>".$row1["Nombre"]."</td> <td>".$row1["Formato"]."</td> <td>".$row1["Cantidad"]."</td> <td>".$row1["Precio"]."</td> <td>".$aux."</td> </tr>";
	}
	echo "</table>";
	echo "</tr>";
	echo "Total: ".$tot."<br>";
	mysql_close($bd);
?>
	</div>
</body>
</html>
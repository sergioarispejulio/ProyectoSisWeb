<?php include ("controladores/seguridad.php");?>
<html>
<head>
<title>Reportes</title>
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
	<h1>Reportes</h1>
	<br>
	<a href="controladores/reporte_clientes.php">Reporte clientes</a>
	</br>
	<br>
	<a href="controladores/reporte_stock.php">Reporte stock</a>
	</br>
    <br>
    <a href="controladores/reporte_stock_total.php">Reporte stock total</a>
    </br>
    <br>
    <a href="controladores/reporte_ventas.php">Reporte ventas</a>
    </br>
	</div>	
</body>
</html>
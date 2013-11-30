<?php include ("controladores/seguridad.php");?>
<html>
<head>
<title>Videos</title>
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
                <li><a href="comprar_videos.php">Realizar Venta</a></li>
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
	<h1>Videos</h1>
	<br>
	<a href="registrar_video.php">Registrar video</a>
	</br>
	<br>
	<a href="modificar_video.php">Modificar video</a>
	</br>
	<br>
	<a href="eliminar_video.php">Eliminar video</a>
	</br>
	</div>	
</body>
</html>
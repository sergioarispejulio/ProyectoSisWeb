<?php include ("controladores/seguridad.php");?>
<html>
<head>
<title>Registrar video</title>
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
    <h1>Registrar Video</h1></br>
 	<form action="controladores/registrar_video.php" method="POST">
		Nombre:
		<input name="nombre" type="text" maxlength=20></br>
		Descripcion:
		<input name="descrip" type="text" maxlength=160></br>
		Actores:
		<input name="actores" type="text" maxlength=100></br>
		Director:
		<input name="director" type="text" maxlength=20></br>
		Produccion:
		<input name="produccion" type="text" maxlength=20></br>
		Precio:
		<input name="precio" type="text" maxlength=20></br>
		Cantidad:
		<input name="cantidad" type="text" maxlength=20></br>
		Formato: <select name="formato">
			<option value="dvd">DVD</option>
			<option value="bluRay">Blu-Ray</option>
			<option value="3d">3D</option>
		</select></br>
		Categoria: <select name="categoria">
			<option value="peliculas">Peliculas</option>
			<option value="series">Series</option>
			<option value="deportes">Deportes</option>
			<option value="educacion">Educacion</option>
			<option value="novelas">Novelas</option>
			<option value="musicales">Musicales</option>
			<option value="juegos">Juegos</option>
		</select></br>
		<!--
		SubCategoria: <select name="subcategoria">
			<option value="peliculas">Peliculas</option>
			<option value="series">Series</option>
			<option value="deportes">Deportes</option>
			<option value="educacion">Educacion</option>
			<option value="novelas">Novelas</option>
			<option value="musicales">Musicales</option>
			<option value="juegos">Juegos</option>
		</select></br>
		-->
		<input id="guardar" name="guardar" value="Registrar" type="submit"/>
  	</form>
  	</br>
	<a href="videos_admin.php">Volver</a>
 </body>
</html>
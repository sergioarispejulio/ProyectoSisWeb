<?php include ("controladores/seguridad.php");?>
<html>
<head>
<title>Modificar Video</title>
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
	<h1>Modificar Video</h1>
	<br /><br />
	Seleccione video para modificar:<br />
	<form action="modificar_video.php" method="post">
		<select name="Nro">
		<?php
			$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
			mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
			$sSQL ="SELECT Nro, Nombre, Formato FROM video";
			$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
			while( $row = mysql_fetch_array ( $result )) 
			{
				echo '<option value="'.$row["Nro"].'" selected>'.$row["Nombre"].'-'.$row["Formato"].'</option>';
			}
			mysql_close($bd);

		?>
		</select>
		<input type="submit" name="Modificar" />
	</form>
	<?php
		if(isset($_POST["Nro"]))
		{
			$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
			mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
			$sSQL ="SELECT * FROM video WHERE Nro=".$_POST["Nro"];
			$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
			while( $row = mysql_fetch_array ( $result )) 
			{
				echo "<form action=controladores/modificar_video.php method=post>";
				echo "<input type=hidden value=".$_POST["Nro"]." name=Nro >";
				echo "Nombre: <input type=text name=Nombre value=".$row["Nombre"]."><br />";
				echo "Descripcion: <input type=text name=Descrip value=".$row["Descripcion"]."><br />";
				echo "Actores: <input type=text name=Actores value=".$row["Actores"]."><br />";
				echo "Director: <input type=text name=Director value=".$row["Director"]."><br />";
				echo "Produccion: <input type=text name=Produccion value=".$row["Produccion"]."><br />";
				echo "Formato: ";
				echo "<select name=Formato>";
					if ($row["Formato"] == "dvd")
						echo "<option value=dvd selected>DVD</option>";
					else
						echo "<option value=dvd>DVD</option>";
					if ($row["Formato"] == "bluRay")
						echo "<option value=bluRay selected>Blu-Ray</option>";
					else
						echo "<option value=bluRay>Blu-Ray</option>";
					if ($row["Formato"] == "3d")
						echo "<option value=3d selected>3D</option>";
					else
						echo "<option value=3d>3D</option>";
				echo "</select></br>";
				echo "<input type=submit value=Guardar>"; 
			echo "</form>";
			}
			mysql_close($bd);
		}
	?>
  	</br>
	<a href="videos_admin.php">Volver</a>
</div>
</body>
</html>
<?php include ("controladores/seguridad.php");?>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <a class="brand">ACT-II</a>
            <div class="container">
            <ul class="nav">
                <li class="active"><a href="home_usuario.php">Home</a></li>
                <li><a href="videos_usuario.php">Videos</a></li>
            </ul>
            <div class="nav-collapse collapse">
            <form class="navbar-search pull-right" action="buscar_usuario.php" method="post">
                <input type="text" class="search-query" placeholder="Buscar video..." name="buscar">
            </form>
            </div>
        </div>
        </div>
    </div>

    <div class="hero-unit">
	<h1>Bienvenido Usuario!</h1></br>
    <a href="salir.php">Salir</a>
	</div>	
</body>
</html>
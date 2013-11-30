
<html>
<head>
<title>Registrar usuario</title>
<link rel="stylesheet" href="css/bootstrap.css">
<script>
function validarNro(e) {
	var key;
	if(window.event) // IE
	{
		key = e.keyCode;
	}
	else if(e.which) // Netscape/Firefox/Opera
	{
		key = e.which;
	}
	if (key < 48 || key > 57)
	{
		return false;
	}
	return true;
}
</script>
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
    <h1>Registrar Usuario</h1></br>
<?php if (isset($_GET["errordatos"]))
	{
		echo "<bgcolor=red><span style=color:ffffff><b>Alg&iacute;n campo estaba vacio, tiene que rellenar todos los datos</b></span>";
	} ?>
<?php if (isset($_GET["errorusuario"]))
	{
		echo "<bgcolor=red><span style=color:ffffff><b>Usuario ya existente</b></span>";
	} ?>
<?php if (isset($_GET["errorcontrasena"]))
	{
		echo "<bgcolor=red><span style=color:ffffff><b>Error en la Contraseña, tiene que tener almenos de 8 caracteres como m&iacute;nimo y 20 como m&aacute;ximo</b></span>";
	}?>

<form action="controladores/registrar_usuario.php" method="post">
	Ci: <input type="text" name="Ci" onKeyPress="javascript:return validarNro(event)" /><br />
	Nombre Completo: <input type="text" name="Nombre" /><br />
    Login: <input type="text" name="Login" maxlength="45" /><br />
    Contraseña: <input type="password" name="Contra" maxlength="20" />Minimo 8 caracteres!<br />
    Fecha Nacimiento<br />
    <select name="Dia">
        <?php
        for ($i=1; $i<=31; $i++) {
            if ($i == date('j'))
                echo '<option value="'.$i.'" selected>'.$i.'</option>';
            else
                echo '<option value="'.$i.'">'.$i.'</option>';
        }
        ?>
	</select>
    <select name="Mes">
        <?php
        for ($i=1; $i<=12; $i++) {
            if ($i == date('m'))
                echo '<option value="'.$i.'" selected>'.$i.'</option>';
            else
                echo '<option value="'.$i.'">'.$i.'</option>';
        }
        ?>
	</select>
    <select name="Ano">
        <?php
        for($i=date('o'); $i>=1910; $i--){
            if ($i == date('o'))
                echo '<option value="'.$i.'" selected>'.$i.'</option>';
            else
                echo '<option value="'.$i.'">'.$i.'</option>';
        }
        ?>
	</select>
    <br />
    
    <input type="submit" value="Registrarse"/></br> 
    <a href="usuarios.php">Volver</a>
</form>
</body>
</html>
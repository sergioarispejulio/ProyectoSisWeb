<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registrar Usuario</title>
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
<h1><center>Registro de Usuario</center></h1>
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
		echo "<bgcolor=red><span style=color:ffffff><b>Error en la Contraseña, tiene que tener almenos de 8 caracteres</b></span>";
	}?>

<form action="RegistrarUsuario-Logica.php" method="post">
	Ci: <input type="text" name="Ci" onkeypress="javascript:return validarNro(event)" /><br />
	Nombre Completo: <input type="text" name="Nombre" /><br />
    Login: <input type="text" name="Login" /><br />
    Contraseña: <input type="password" name="Contra" maxlength="20" /><br />
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
    Rol
    <select name="rol">
        <option value="Cliente">Cliente</option>
        <option value="Admin">Administrador</option>
    </select>
    </br>
    
    <input type="submit" value="Registrarse"/> 
</form>
</body>
</html>
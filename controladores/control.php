<?php
//vemos si el usuario y contraseña es váildo
$pass = $_POST["contrasena"];
$login = $_POST["usuario"];
$encriptada = md5($pass);
$db = mysql_connect("127.0.0.1", "root", "");
if (!$db){
	echo "error en base de datos: ".mysql_error($db);
}
else {
	mysql_select_db("bdsisweb",$db);
	$res = mysql_query("SELECT login, contrasena FROM persona WHERE login = '$login' and contrasena = '$encriptada'", $db);
	$rol = mysql_query("SELECT rol FROM persona WHERE login = '$login'"); 
	if( $fila=mysql_fetch_array($res) )
    {              
        //usuario y contraseña válidos
		//defino una sesion y guardo datos
		session_start();
		$_SESSION["autentificado"]= "SI";
		while ($row = mysql_fetch_row($rol)){ 
        	if($row[0] == "Cliente")
        		header("Location: ../home_usuario.php");
        	if($row[0] == "Admin")
        		header("Location: ../home_admin.php");
		}
		//header ("Location: BuscarVideos.php");
	}else {
		//si no existe le mando otra vez a la portada
		echo "No esta autentificado".mysql_error($db);
		mysql_close($db);
		
	}
}
?>
<?php
//vemos si el usuario y contraseña es váildo
function encrypt($string, $key) {
   $result = '';
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
   }
   return base64_encode($result);
}

$pass = $_POST["contrasena"];
$login = $_POST["usuario"];
$encriptada = encrypt($pass,"XZ");
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
        		header("Location: BuscarVideos.php");
        	else
        		header("Location: IndexAdmin.php");
		}
		//header ("Location: BuscarVideos.php");
	}else {
		//si no existe le mando otra vez a la portada
		echo "No esta autentificado".mysql_error($db);
		mysql_close($db);
		
	}
}
?>
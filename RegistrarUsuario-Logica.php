<?php
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


	if(isset($_POST["Ci"]) == false || isset($_POST["Nombre"]) == false || isset($_POST["Login"]) == false || isset($_POST["Contra"]) == false || isset($_POST["Dia"])== false  ||  isset($_POST["Mes"]) == false ||  isset($_POST["Ano"]) == false )
	{
		header("Location: RegistrarUsuario-Vista.php?errordatos=si");
	}
	$contra =  $_POST["Contra"];
	if(strlen($contra) < 8)
	{
		header("Location: RegistrarUsuario-Vista.php?errorcontrasena=si");
	}
	$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
	mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
	$sSQL ="SELECT Ci FROM persona";
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
	while( $row = mysql_fetch_array ( $result )) 
	{
		if($row["Ci"] == $_POST["Ci"])
		{
			header("Location: RegistrarUsuario-Vista.php?errorusuario=si");
		}
	}
	mysql_close($bd);
	$encriptada = encrypt($contra,"XZ");
	$fecha = new DateTime();
	$fecha->setDate($_POST["Ano"], $_POST["Mes"],$_POST["Dia"]);
	$str = $fecha->format('Y-m-d');
	$bd = mysql_connect("127.0.0.1","root","") or die ("Error: No es posible establecer la conexión");
	mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
	$sSQL ="INSERT INTO persona (Ci, Nombre, Fecha_Nacimiento, Contrasena, Login, Rol) VALUES ('".$_POST["Ci"]."','".$_POST["Nombre"]."','".$str."','".$encriptada."','".$_POST["Login"]."','".$_POST["rol"]."')";
	$result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
	mysql_close($bd);
	echo "Ingreso exitoso";

?>

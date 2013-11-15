<html>
 <head>
  <title>Registrar video</title>
  <h1>Registrar Video</h1>
 </head>
 <body>
 	<form action="registroVideo.php" method="POST">
		Nombre:
		<input name="nombre" type="text" maxlength=20></br>
		Precio:
		<input name="precio" type="text" maxlength=20></br>
		Cantidad:
		<input name="cantidad" type="text" maxlength=20></br>
		Formato: <select name="formato">
			<option value="dvd">DVD</option>
			<option value="bluRay">Blu-Ray</option>
			<option value="3d">3D</option>
		</select></br>

		<input id="guardar" name="guardar" value="Registrar" type="submit"/>
  	</form>
 </body>
</html>
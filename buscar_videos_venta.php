<?php include ("controladores/seguridad.php");?>
<html>
<head>
<title>Buscar Videos</title>
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
<h1>Buscar</h1></br>
<form action="buscar_videos_venta.php" method="post">
        Por Nombre: <input type="text" name="pornombre" /> 
     <?php
        echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
    ?>
    <input type="submit" value="Buscar" />
</form>

<form action="buscar_videos_venta.php" method="post">
        Por Categor&iacute;a 
    <select name="Categoria">
        <?php
        $bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
        mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
        $sSQL ="SELECT * FROM categoria";
        $result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
        while( $row = mysql_fetch_array ( $result )) 
        {
            echo '<option value="'.$row["Nro_Categoria"].'" selected>'.$row["Nombre"].'</option>';
        }
        mysql_close($bd);
    ?> 
        </select> <input type="submit" value="Buscar" />
    <?php
        echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
    ?>
</form>

<form action="buscar_videos_venta.php" method="post">
        Por Sub Categor&iacute;a 
    <select name="SubCategoria">
        <?php
        $bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
        mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
        $sSQL ="SELECT * FROM sub_categoria";
        $result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
        while( $row = mysql_fetch_array ( $result )) 
        {
            echo '<option value="'.$row["Nro_Categoria"].'" selected>'.$row["Nombre"].'</option>';
        }
        mysql_close($bd);
    ?> 
        </select> <input type="submit" value="Buscar" />
</form>

<form action="buscar_videos_venta.php" method="post">
        Por Formato:
    <select name="Formato">
            <option value="dvd" selected>DVD</option>
        <option value="bluRay" selected>Blu-Ray</option>
        <option value="3d" selected>3D</option>
    </select> 
     <?php
        echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
    ?>
    <input type="submit" value="Buscar" />
</form>
<?php
        if( isset($_POST["pornombre"]) )
        {
                echo "<table class=table table-hover>";
                echo "<tr><td><b>Nombre</b></td><td><b>Formato</td><td><b>Precio</td><td><b>Cantidad</td></tr>";
                $bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
        mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
        $sSQL ="SELECT * FROM video";
        $result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
        while( $row = mysql_fetch_array ( $result )) 
        {
                        if( stristr($row["Nombre"],$_POST["pornombre"]) !== false )
                        {
                                echo "<tr>";
                                echo "<td>";
                           echo $row["Nombre"];
                                echo "</td>";
                                echo "<td>";
                           echo $row["Formato"];
                                echo "</td>";
                                echo "<td>";
                           echo $row["Precio"];
                                echo "</td>";
                                echo "<td>";
                           echo $row["Cantidad"];
                                echo "</td>";
                                echo "<td>";
                                   echo "<form action=comprar_videos.php method=post>";
                                        echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
                                        echo "<input type=hidden name=Sele value=".$row["Nro"].">";
                                        echo "Cantidad a comprar: <input type=number max=".$row["Cantidad"]." min=1 name=Canti> ";
                                        echo "<input type=submit value=Reservar>";
                                        echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                                
                        }
        }
        mysql_close($bd);
                echo "</table>";
        }

?>

<?php
        if( isset($_POST["Categoria"]) )
        {
                echo "<table class=table table-hover>";
                echo "<tr><td><b>Nombre</b></td><td><b>Formato</td><td><b>Precio</td><td><b>Cantidad</td></tr>";
                $bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
        mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
                $sSQL ="SELECT V.Nro, V.Nombre, V.Formato, V.Precio, V.Cantidad FROM video V, categoria_video CV WHERE V.Nro = CV.Video_Nro and CV.Categoria_Nro = '".$_POST["Categoria"]."'";
        $result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
        while( $row = mysql_fetch_array ( $result )) 
        {
                        echo "<tr>";
                        echo "<td>";
                   echo $row["Nombre"];
                        echo "</td>";
                        echo "<td>";
                   echo $row["Formato"];
                        echo "</td>";
                        echo "<td>";
                   echo $row["Precio"];
                        echo "</td>";
                        echo "<td>";
                   echo $row["Cantidad"];
                        echo "</td>";
                        echo "<td>";
                           echo "<form action=comprar_videos.php method=post>";
                                echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
                                echo "<input type=hidden name=Sele value=".$row["Nro"].">";
                                echo "Cantidad a comprar: <input type=number max=".$row["Cantidad"]." min=1 name=Canti> ";
                                echo "<input type=submit value=Reservar>";
                                echo "</form>";
                        echo "</td>";
                        echo "</tr>";
        }
        mysql_close($bd);
                echo "</table>";
        }

?>

<?php
        if( isset($_POST["SubCategoria"]) )
        {
                echo "<table class=table table-hover>";
                echo "<tr><td><b>Nombre</b></td><td><b>Formato</td><td><b>Precio</td><td><b>Cantidad</td></tr>";
                $bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
        mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
                $sSQL ="SELECT V.Nro, V.Nombre, V.Formato, V.Precio, V.Cantidad FROM video V, subcategoria_video CV WHERE V.Nro = CV.Video_Nro and CV.Sub_Categoria_Nro = '".$_POST["SubCategoria"]."'";
        $result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
        while( $row = mysql_fetch_array ( $result )) 
        {
                        echo "<tr>";
                        echo "<td>";
                   echo $row["Nombre"];
                        echo "</td>";
                        echo "<td>";
                   echo $row["Formato"];
                        echo "</td>";
                        echo "<td>";
                   echo $row["Precio"];
                        echo "</td>";
                        echo "<td>";
                   echo $row["Cantidad"];
                        echo "</td>";
                        echo "<td>";
                           echo "<form action=comprar_videos.php method=post>";
                                echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
                                echo "<input type=hidden name=Sele value=".$row["Nro"].">";
                                echo "Cantidad a comprar: <input type=number max=".$row["Cantidad"]." min=1 name=Canti> ";
                                echo "<input type=submit value=Reservar>";
                                echo "</form>";
                        echo "</td>";
                        echo "</tr>";
        }
        mysql_close($bd);
                echo "</table>";
        }
?>

<?php
        if( isset($_POST["Formato"]) )
        {
                echo "<h3>Busqueda:</h3>";
                echo "<table class=table table-hover>";
                echo "<tr><td><b>Nombre</td><td><b>Formato</td><td><b>Precio</td><td><b>Cantidad</td></tr>";
                $bd = mysql_connect("localhost","root","") or die ("Error: No es posible establecer la conexión");
        mysql_select_db("bdsisweb",$bd) or die ("Error en la selección de la base de datos");
        $sSQL ="SELECT * FROM video WHERE Formato = '".$_POST["Formato"]."'";
        $result = mysql_query($sSQL,$bd) or die ("Error en la consulta SQL");
        while( $row = mysql_fetch_array ( $result )) 
        {
                        echo "<tr>";
                        echo "<td>";
                   echo $row["Nombre"];
                        echo "</td>";
                        echo "<td>";
                   echo $row["Formato"];
                        echo "</td>";
                        echo "<td>";
                   echo $row["Precio"];
                        echo "</td>";
                        echo "<td>";
                   echo $row["Cantidad"];
                        echo "</td>";
                        echo "<td>";
                           echo "<form action=comprar_videos.php method=post>";
                                echo "<input type=hidden name=Ci value=".$_POST["Ci"].">";
                                echo "<input type=hidden name=Sele value=".$row["Nro"].">";
                                echo "Cantidad a comprar: <input type=number max=".$row["Cantidad"]." min=1 name=Canti> ";
                                echo "<input type=submit value=Reservar>";
                                echo "</form>";
                        echo "</td>";
                        echo "</tr>";
        }
        mysql_close($bd);
                echo "</table>";
        }
?>
</div>
</body>
</html>
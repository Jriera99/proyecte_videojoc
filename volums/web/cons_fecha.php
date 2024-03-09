<html>
<link rel="stylesheet" href="css/index.css">
<body style="background-color: bfcde6;">

<header>
<h1 style="font-family: "Courier New", monospace;">
<a href="index.php">PROJECTE VIDEOJOCS PHP - FORMULARIS</a>
</h1>
<img src="img/phpj.png" alt="imgphp" width="80" height="80">
</header>

<nav>
<ul>
<li><a href="form_videojoc.php">VIDEOJOC</a></li>
<li><a href="form_plataforma.php">PLATAFORMA</a></li>
<li><a href="form_mostrar_desenvolupador.php">DESENVOLUPADOR</a></li>
<li><a href="form_mostrar_genere.php">GENERE</a></li>
<li><a style="color: 50ff24;" href="jsonDB.php">CARREGA JSON I.SESSIÓ</a></li>
<li><a style="color: blue;" href="nexo.php">ALTRES</a></li>
<li><a style="color: orange;" href="index.php">EXIT</a></li></ul>
</nav>
<br>
<nav>
<ul>
<li><a href="alta_usuari.php">ALTA</a></li>
<li><a href="cons_fecha.php">FECHA</a></li></ul>
</nav>
<?php
// formulario conectador con form_consulta_videojoc para consultar por fecha
//include de las classes necesarias
include "dades_connexio_BD.php";
include "clase_videojoc.php";

$videojocs = new videojoc();
$arrayValues = $videojocs->consultdata($servername, $username, $password, $_GET["data_llancament"]);

if (!empty($arrayValues)) {
    echo "<table width=\"100%\">\n";
    echo "<tr>\n";
    // añadir las cabeceras de la tabla
    foreach ($arrayValues[0] as $key => $useless) {
        echo "<th>$key</th>";
    }
    echo "</tr>";
    // mostrar los datos
    foreach ($arrayValues as $row) {
        echo "<tr>";
        foreach ($row as $key => $val) {
            echo "<td>$val</td>";
        }
        echo "</tr>\n";
    }
    echo "</table>";
}

?>
<form action="form_consulta_videojoc.php" method="GET">
<input type="submit" value="volver">
</form>
<?php
// Start the session
session_start();
?>
<html>
<link rel="stylesheet" href="css/index.css">
<body>

<header>
<h1 style="font-family: "Courier New", monospace;">
<a href="index.php">PROJECTE VIDEOJOCS PHP - FORMULARIS</a>
</h1>
<img src="img/phpf.png" alt="imgphp" width="80" height="80">
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
</ul>
</nav>
<br>
<nav>
<ul>
<li><a href="form_mostrar_videojoc.php">MOSTRAR</a></li>
<li><a href="form_videojoc.php">INTRODUIR</a></li>
<li><a href="consulta_videojoc.php">CONSULTAR</a></li>
<li><a href="mod_videojoc.php">MODIFICAR</a></li>
</ul>
</nav>
<?php
include "dades_connexio_BD.php";
include "clase_videojoc.php";

$videojocs = new videojoc();
$resultadoConsulta = $videojocs->consultaTots($servername, $username, $password);
// Fetch los resultados como un array asociativo
$arrayValues = $resultadoConsulta->fetchAll(PDO::FETCH_ASSOC);

echo "<table width=\"100%\">\n";
echo "<tr>\n";
foreach ($arrayValues[0] as $key => $useless) {
    echo "<th>$key</th>";
}
echo "</tr>";
foreach ($arrayValues as $row) {
    echo "<tr>";
    foreach ($row as $key => $val) {
        echo "<td>$val</td>";
    }
    echo "</tr>\n";
}
echo "</table>";
?>
<?php
    if (isset($_SESSION['nom']) && isset($_SESSION['contrasenya'])) {
       echo '<form action="eliminar_videojoc.php" method="GET">';
       echo 'eliminar(id): <input type="text" name="id">';
       echo '<input type="submit" value="eliminar">';
       echo '</form>';

       echo '<form action="mod_videojoc.php" method="GET">';
       echo '<input type="submit" value="modifica">';
       echo '</form>';
    }
?>
<html>
<link rel="stylesheet" href="css/index.css">
<body style="background-color: ff9e81;">

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
<li><a style="color: 50ff24;" href="ini_sesion.php">INICIAR SESSIÓ</a></li>
<li><a style="color: red;" href="tanca_sesio.php">TANCAR SESSIÓ</a></li></ul>
</nav>
<h1> TANCA SESSIÓ </h1>
<?php
session_start(); // Inicia una sesión de PHP

// Destruye la sesión actual del usuario
session_destroy();

// activamos el almacenamiento del búfer de salida
ob_start();

?>


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
<br>
<nav>
<ul>
<li><a href="alta_usuari.php">ALTA USUARI</a></li>
<li><a href="alta_desenvolupador.php">ALTA DESENVOLUPADOR</a></li>
<li><a href="alta_plataforma.php">ALTA PLATAFORMA</a></li>
<li><a href="alta_genere.php">ALTA GENERE</a></li>
</ul>
</nav>
<?php
// Start the session
session_start();
include "dades_connexio_BD.php";
include "clase_usuari.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener valores del formulario si se envió
    $nom = test_input($_POST["nom"]);
    $contrasenya = test_input($_POST["contrasenya"]);

    $client = new usuari();
    $client->inserir($servername, $username, $password, $nom, $contrasenya);

    echo "<br>";
    echo 'El nom introduït és: ' . $nom . "<br>";
    echo 'El contraseña introduït és: ' . $contrasenya . "<br>";
    echo "<br>";
}


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    nom: <input type="text" name="nom" value="<?php echo $nom; ?>"><br>
    contraseña: <input type="text" name="contrasenya" value="<?php echo $contrasenya; ?>"><br>
    <?php
    if (isset($_SESSION['nom']) && isset($_SESSION['contrasenya'])) {
        echo '<input type="submit">';
    }
    ?>
</form>

</body>
</html>

<?php
// Start the session
session_start();
?>

<html>
<link rel="stylesheet" href="css/index.css">
<body style="background-color: b7ffa5;">

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
<h1> INICI SESSIÓ </h1>
<h2>Perquè funcioni, s'ha de crear en la base de dades una nova taula d'usuaris.</h2>
<h2>(També, s'ha d'iniciar sessió 2 vegades perquè funcioni.)</h2>
<br>
<?php

include "dades_connexio_BD.php";
include "clase_usuari.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $nom = isset($_GET["nom"]) ? test_input($_GET["nom"]) : "";
    $contrasenya = isset($_GET["contrasenya"]) ? test_input($_GET["contrasenya"]) : "";
    

    $usuari1 = new usuari();
    $resultat = $usuari1->consultaTots($servername, $username, $password, $nom, $contrasenya);
    $arrayValues = $resultat->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($arrayValues)) {
        // Verifica las credenciales del usuario aquí
        // Por ejemplo, si el usuario se autentica correctamente
        $_SESSION["nom"] = $nom; // Guarda el nombre del usuario en la sesión
       $_SESSION["contrasenya"] = $contrasenya;

    } else {
        echo "Invalid username or password.";
    }

    $nom = "";
    $contrasenya = "";
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <!-- Envía el formulario a la base de datos -->
    nom: <input type="text" name="nom" value="<?php echo $nom;?>">
    <br><br>
    contrasenya: <input type="password" name="contrasenya" value="<?php echo $contrasenya;?>">
    <br><br>
    <input type="submit" value="Submit"><!-- Boton para subir los datos  -->
</form>

</body>
</html>
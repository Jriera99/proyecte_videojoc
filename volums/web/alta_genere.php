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
session_start(); // Start the session
//include de las classes necesarias
include "dades_connexio_BD.php";
include "clase_genere.php";

// Definir variables y control para que no inserte datos vacios en la base de datos
if ($_SERVER["REQUEST_METHOD"] == "GET" and $_GET["nom"] != null) {
    $nom = test_input($_GET["nom"]);

//creamos una instancias de la clase genere y llamamos a la funcion inerir.
    $client = new genere();
    $client -> inserir($servername, $username, $password, $nom );
    echo "Inserción realizada.";
    //mostramos los valores introducidos
    echo "<br>";
    echo 'El nom introduït és: ' . $nom. "<br>";
    echo "<br>";
  
  
  }
  //funcion para depurar y validar los datos introduciodos.
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  
  }
  
  ?>

<!-- formulario que envia los datos de la misma pagina con el metodo get-->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
    nom: <input type="text" name="nom"><br>
    <?php
    //verificamos si tienes iniciada la session y enviamos el formulario
    if (isset($_SESSION['nom']) && isset($_SESSION['contrasenya'])) {
        echo '<input type="submit">';
    }
    ?>
</form>

</body>
</html>
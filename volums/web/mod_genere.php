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
<li><a href="form_mostrar_genere.php">MOSTRAR</a></li>
<li><a href="consulta_genere_vid.php">CONSULTAR</a></li>
<li><a href="mod_genere.php">MODIFICAR</a></li>
</ul>
</nav>
<?php
// Start the session
session_start();
include "dades_connexio_BD.php";
include "clase_genere.php";
// Definir variables y control para que no inserte datos vacios en la base de datos
if ($_SERVER["REQUEST_METHOD"] == "GET" and $_GET["nom"] != null) {
    $id = test_input($_GET["id"]);
    $nom = test_input($_GET["nom"]);

    $client = new genere();
    $client -> modificar ($servername,$username,$password, $id,$nom);
    echo "<br>";
    echo 'El id introduït és: ' . $id. "<br>";
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
<?php
echo "Llista desplegable";
echo "<select name='id'>";
$des = new genere();
$resultat =$des->consultaTots($servername,$username,$password);
$arrayValues = $resultat->fetchAll(PDO::FETCH_ASSOC);
foreach ($arrayValues as $row)
{
      echo "<option value='". $row['id']. "'>" .  $row['id'] . "</option>";
}
echo "</select>";
echo "<br>";
?>
<br>
nom: <input type="text" name="nom"><br>

<?php
    if (isset($_SESSION['nom']) && isset($_SESSION['contrasenya'])) {
        echo '<input type="submit">';
    }
    ?>
</form>

</body>
</html>
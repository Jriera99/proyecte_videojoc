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
<h1> Formulari Videojoc </h1>
<?php
session_start(); // Start the session
?>

<?php

//include de las classes necesarias
include "dades_connexio_BD.php";
include "clase_videojoc.php";
include "clase_desenvolupador.php";

// Definir variables y control para que no inserte datos vacios en la base de datos
if ($_SERVER["REQUEST_METHOD"] == "GET" and $_GET["nom"] != null) {
    $nom = test_input($_GET["nom"]);
    $data_llancament = test_input($_GET["data_llancament"]);
    $pegi = test_input($_GET["pegi"]);
    $id_desenvolupador = test_input($_GET["id_desenvolupador"]);
    $id_plataforma = test_input($_GET["id_plataforma"]);

//creamos una instancias de la clase videojoc y llamamos a la funcion inerir.
    $client = new videojoc();
    $client -> inserir($servername, $username, $password, $nom ,$data_llancament, $pegi ,$id_desenvolupador ,$id_plataforma);
    echo "Inserción realizada.";
    //mostramos los valores introducidos
    echo "<br>";
    echo 'El nom introduït és: ' . $nom. "<br>";
    echo 'El data_llancament introduït és: ' . $data_llancament. "<br>";
    echo 'El pegi introduït és: ' . $pegi. "<br>";
    echo 'El id_desenvolupador introduït és: ' . $id_desenvolupador. "<br>";
    echo 'El id_plataforma introduït és: ' . $id_plataforma. "<br>";
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
    <input type="submit" style="width: 100%; padding: 10px; background-color: #ffbf00; color: white; border: none; border-radius: 5px; cursor: pointer;">
    nom: <input type="text" name="nom"><br>
    data_llancament: <input type="text" name="data_llancament"><br>
    pegi: <input type="text" name="pegi"><br>
    id_plataforma: <input type="text" name="id_plataforma"><br>
    <?php
    //lista desplegable 
    echo "Llista desplegable";
    echo "<select name='id_desenvolupador'>";
    $des = new desenvolupador();
    $resultat =$des->consultaTots("db","root","iesmanacor");
    $arrayValues = $resultat->fetchAll(PDO::FETCH_ASSOC); 
    //imprimimos los datos
    foreach ($arrayValues as $row)
    {
          echo "<option value='". $row['id']. "'>" .  $row['nom'] . "</option>";
    }
    echo "</select>";
    echo "<br>";
    ?>
    

    <?php
    //verificamos si tienes iniciada la session y enviamos el formulario
    if (isset($_SESSION['nom']) && isset($_SESSION['contrasenya'])) {
        echo '<input type="submit">';
    }
    ?>

</form>

</body>
</html>
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
<h1> JSON inserit </h1>

<?php
// Configuración de la base de datos
$servername = "db";
$username = "root";
$password = "politecnic";

// Conexión a la base de datos
try {
    $conn = new PDO("mysql:host=$servername;dbname=videojocs", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Ruta al archivo JSON
$ruta_json = "games.json";

// Leer el contenido del archivo JSON
$json_content = file_get_contents($ruta_json);

// Decodificar el JSON a un array asociativo
$data = json_decode($json_content, true);

// Recorrer el array y ejecutar la inserción en la base de datos
foreach ($data as $registro) {
    // Suponiendo que tienes un archivo JSON con campos específicos
    $nom_desenvolupador = $registro['Desenvolupador'];

    try {
        // Iniciar una transacción
        $conn->beginTransaction();

        // Ejecutar la consulta de inserción para Desenvolupador
        $consulta_desenvolupador = "INSERT INTO desenvolupador (nom) VALUES (:nom)";
        $stmt = $conn->prepare($consulta_desenvolupador);
        $stmt->bindParam(':nom', $nom_desenvolupador);
        $stmt->execute();
        $last_desenvolup = $conn->lastInsertId();

        $nom_videojoc = $registro['Nom'];
        $data_llancament = $registro['Llançament'];

        // Ejecutar la consulta de inserción para Videojoc
        $consulta_videojoc = "INSERT INTO videojoc (nom, data_llancament, pegi, id_desenvolupador) VALUES (:nom, :data_llancament, NULL, :id_desenvolupador)";
        $stmt = $conn->prepare($consulta_videojoc);
        $stmt->bindParam(':nom', $nom_videojoc);
        $stmt->bindParam(':data_llancament', $data_llancament);
        $stmt->bindParam(':id_desenvolupador', $last_desenvolup, PDO::PARAM_INT);
        $stmt->execute();

        // Confirmar la transacción
        $conn->commit();

        echo "Registro insertado correctamente.\n";
    } catch (PDOException $ex) {
        // Revertir la transacción en caso de error
        $conn->rollBack();
        echo "Excepción capturada: " . $ex->getMessage() . "\n";
    }
}

$conn = null;
?>
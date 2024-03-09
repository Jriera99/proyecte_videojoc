<?php
//creamos la class
class usuari {
  public function connectar_bd ($servername,$username,$password)
  {
    try {
      $conn = new PDO("mysql:host=$servername;dbname=videojocs", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      echo "Connection failed2: " . $e->getMessage();
    }
    return $conn;
}

public function inserir($servername, $username, $password, $nom, $contrasenya)
{
    $conn = new PDO("mysql:host=$servername;dbname=videojocs", $username, $password);
    $sql = "INSERT INTO usuaris (nom, contrasenya) VALUES ('$nom', '$contrasenya')";
    $conn->exec($sql);
    $conn = null;   // Cerrar la conexión

}

// función para consultar por la id dentro de la base de datos
public function consultaTots ($servername, $username,$password,$nom,$contrasenya)
{
    $conn = $this->connectar_bd($servername,$username,$password);
    
    try {
        $sql="SELECT nom, contrasenya FROM usuaris WHERE nom='$nom' AND contrasenya='$contrasenya'";
       $stmt = $conn->prepare($sql);
       $result = $stmt->execute();
       $conn=null; //cierra conexión con la base de datos
       return($stmt);  // Devuelve el objeto PDOStatement
    }
    catch(PDOException $e) {
    echo "Error: " . $e->getMessage(); // imprime info de errores 
    }
}
}
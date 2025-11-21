
<?php

class Database {
    
    public $conn;

    public function conectar() {
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=inventario", "root", "");
            return true; // Retorna true si hay conexión
        } catch (PDOException $e) { //El tipo de error 
            echo "Error: " . $e->getMessage();
            return false; // Retorna false si falla
        }
    }
  
}

// Uso:
$db = new Database(); //crea obj (una instancia) de clase 

if ($db->conectar()) {
    echo "Conectado a la BD";

	// Prevenir inyección SQL usando consultas preparadas
    $consulta = "SELECT * FROM usuarios WHERE usuario = ? AND password = ?";
        
    // Ejecutar de forma segura
    $stmt = $db->conn->prepare($consulta); //obj de consult
    $stmt->execute([$_POST['user'], $_POST['pass']]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC); //de registro a registro

	if ($resultado) {
 		echo "<script type=''>
 			alert('El usuario fue encontrado.!');
 		 </script>";
    } else {
        echo "Usuario no encontrado";
    }

} else {
	echo "<script type=''>
 	alert('conexion fallida...revise si el servicio de mysql esta cargado.!');
 	</script>";
    echo "No se pudo conectar";
}
	 
?> 




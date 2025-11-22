<?php
class Database {
    //Atributos
    private $host = "localhost";
    private $db_name = "inventario";
    private $username = "root";
    private $password = "";
    public $conn;

    //Establecer la conexión con la bd
    public function conectar() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                $this->username, 
                $this->password
            ); //Establece la conexión
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Maneja los errores
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // MÉTODO PARA BUSCAR USUARIO (LOGIN)
    public function buscarUsuario($usuario, $password) {
        try {
            $sql = "SELECT * FROM usuarios WHERE usuario = ? AND password = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$usuario, $password]);
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    // MÉTODO PARA AGREGAR USUARIO (REGISTRO)
    public function agregarUsuario($usuario, $password, $nombre = "") {
        try {
            $sql = "INSERT INTO usuarios (usuario, password, nombre) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$usuario, $password, $nombre]);
        } catch (PDOException $e) { //PDO es la forma moderna de conectarse a bd en PHP.
            return false;
        }
    }

    // MÉTODO PARA VERIFICAR SI USUARIO EXISTE PARA CREARLO
    public function usuarioExiste($usuario) {
        try {
            $sql = "SELECT id FROM usuarios WHERE usuario = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$usuario]);
            return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
        } catch (PDOException $e) { //PDO es la forma moderna de conectarse a bd en PHP.
            return false;
        }
    }
}
?>
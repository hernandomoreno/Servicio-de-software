<?php
require_once 'Database.php';

$db = new Database();

if ($db->conectar()) {
    if (isset($_POST['registrar'])) {
        $usuario = $_POST['user'];
        $password = $_POST['pass'];
        $email = $_POST['email'] ?? ''; // Email opcional
        
        // VERIFICAR SI USUARIO YA EXISTE
        if ($db->usuarioExiste($usuario)) {
            echo "❌ El usuario ya existe";
            echo '<br><a href="nuevoregistro.html">Volver a intentar</a>';
        } else {
            // AGREGAR NUEVO USUARIO
            if ($db->agregarUsuario($usuario, $password, $email)) {
                echo "✅ Usuario registrado exitosamente";
                echo '<br><a href="index.html">Iniciar sesión</a>';
            } else {
                echo "❌ Error al registrar usuario";
            }
        }
    }
} else {
    echo "❌ Error de conexión a la base de datos";
}
?>
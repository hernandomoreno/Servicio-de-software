<?php
require_once 'Database.php';

//Crea una instancia de la clase convirtiendose en objeto
$db = new Database();

if ($db->conectar()) {
    //verif si existe el dato submit envia mediante el método POST.
    if (isset($_POST['submit'])) {
        //$_POST arreglo superglobal que contiene todos los datos enviados desde un formulario HTML usando method="POST".
        $usuario = $_POST['user'];
        $password = $_POST['pass'];
        $nombre = $_POST['nombre'] ?? ''; // Garantizar que $nombre siempre tenga un valor
        
        // VERIFICAR SI USUARIO YA EXISTE
        if ($db->usuarioExiste($usuario)) {
            echo "❌ El usuario ya existe";
            echo '<br><a href="nuevoregistro.html">Volver a intentar</a>';
        } else {
            // AGREGAR NUEVO USUARIO
            if ($db->agregarUsuario($usuario, $password, $nombre)) {
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
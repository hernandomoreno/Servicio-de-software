<?php
require_once 'database.php'; //incluye/importa el archivo de clase Database una sola vez

//Instanciando 
$db = new Database(); 

if ($db->conectar()) {
    if (isset($_POST['submit'])) { //verif si existe el dato submit envia mediante el método POST.
        $usuario = $_POST['user'];
        $password = $_POST['pass'];
        
        // BUSCAR USUARIO
        $usuarioEncontrado = $db->buscarUsuario($usuario, $password);
        
        if ($usuarioEncontrado) {
            echo "<script type=''>
 			alert('✔️ El usuario fue encontrado.!');
 		    </script>";
            echo '<br><a href="index.html">Volver a intentar</a>';
        } else {
            echo "❌ Usuario o contraseña incorrectos";
            echo '<br><a href="index.html">Volver a intentar</a>';
        }
    }
} else {
    echo "❌ Error de conexión a la base de datos";
}
?>
<?php
    if(isset($_POST['btnRegistro'])) {
        include 'conn.php';

        $nombre = ($_POST['nombre']);
        $email = ($_POST['usuario']);
        $password = ($_POST['password']);

        $passHash = password_hash($password, PASSWORD_DEFAULT);

        $sentenciaSQL = $pdo->prepare("INSERT INTO usuarios (nombre,usuario,password)
                                       VALUES (:nombre,:usuario,:password)");
        $sentenciaSQL->bindParam("nombre",$nombre,PDO::PARAM_STR);
        $sentenciaSQL->bindParam("usuario",$email,PDO::PARAM_STR);
        $sentenciaSQL->bindParam("password",$passHash,PDO::PARAM_STR);
        $respuesta = $sentenciaSQL->execute();
        
        echo json_encode($respuesta);
        
        $pdo = null;
    }
?>
<?php 

    session_start();
    $id_usuario = $_SESSION['id_usuario'];
    
    if(isset($_POST['btnPerfil'])){
        include 'conn.php';
        $password = ($_POST['password']);
        $passHash = password_hash($password, PASSWORD_DEFAULT);
        
        $sentenciaSQL = $pdo->prepare("UPDATE usuarios SET
        nombre=:nombre,
        password=:password
        WHERE id_usuario=:id_usuario");

        $respuesta = $sentenciaSQL->execute(array(
            "id_usuario" => $id_usuario,
            "nombre" => $_POST['nombre'],
            "password" => $passHash     
        ));

        echo json_encode($respuesta);

        $sentenciaSQL = null;
        $pdo = null;
    }
?>
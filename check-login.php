<?php 
    if(isset($_POST['btnIngresar'])) {
        include 'conn.php';
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        
        $result = $pdo->query($sql);
        $row = $result->fetch();

        if($row) {
            $hash = $row['password'];

            if(password_verify($password, $hash)) {
                session_start();

                $_SESSION['loggedin'] = true;
                $_SESSION['name'] = $row['nombre'];
                $_SESSION['id_usuario'] = $row['id_usuario'];

                echo json_encode(true);
            } else {
                echo json_encode(false);
            }
        } else {
            echo json_encode(false);
        }
        
        

        
    }
?>
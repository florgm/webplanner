<?php
    session_start();
    $id_usuario = $_SESSION['id_usuario'];

    include 'conn.php';

    $accion = (isset($_GET['accion']))?$_GET['accion']:'leer';

    switch($accion) {
        case 'agregar':
            $sentenciaSQL = $pdo->prepare("INSERT INTO
            tareas(id_usuario,tarea,completado)
            VALUES(:id_usuario,:tarea,:completado)");

            $sentenciaSQL->execute(array(
                "id_usuario" => $_POST['id_usuario'],
                "tarea" => $_POST['tarea'],
                "completado" => $_POST['completado'],
            ));
            
            if($sentenciaSQL->rowCount() == 1) { 
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'datos' => array(
                        'tarea' => $_POST['tarea'],
                        'completado' => $_POST['completado'],
                        'id_tarea' => $pdo->lastInsertId()
                    )
                );
            }
            
            break;

        case 'modificar':
            $sentenciaSQL = $pdo->prepare("UPDATE tareas SET
                completado=:completado
                WHERE id_tarea=:id_tarea");
        
            $respuesta = $sentenciaSQL->execute(array(
                "completado" => $_POST['completado'],
                "id_tarea" => $_POST['id_tarea'],
            ));

            break;

        case 'borrar':
            $respuesta=false;
            
            if(isset($_POST['id_tarea'])) {
                $sentenciaSQL = $pdo->prepare('DELETE FROM tareas WHERE id_tarea=:id_tarea');
                $respuesta = $sentenciaSQL->execute(array("id_tarea"=>$_POST['id_tarea']));
            }
            break;

        default:
            $sentenciaSQL = $pdo->prepare("SELECT * FROM tareas WHERE id_usuario=:id_usuario");
            $sentenciaSQL->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $sentenciaSQL->execute();

            $respuesta = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
            break;
    }

    echo json_encode($respuesta);  
?>
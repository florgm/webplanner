<?php 
header('Content-Type: application/json');

session_start();
$id_usuario = $_SESSION['id_usuario'];

include 'conn.php';

$accion = (isset($_GET['accion']))?$_GET['accion']:'leer';

switch($accion) {
    case 'agregar':
        $sentenciaSQL = $pdo->prepare("INSERT INTO
        eventos(id_usuario,title,descripcion,color,textColor,start,end)
        VALUES(:id_usuario,:title,:descripcion,:color,:textColor,:start,:end)");

        $respuesta = $sentenciaSQL->execute(array(
            "id_usuario" => $_POST['id_usuario'],
            "title" => $_POST['title'],
            "descripcion" => $_POST['descripcion'],
            "color" => $_POST['color'],
            "textColor" => $_POST['textColor'],
            "start" => $_POST['start'],
            "end" => $_POST['end']
        ));
        echo json_encode($respuesta);
        break;
    case 'borrar':
        $respuesta=false;
        if(isset($_POST['id_evento'])) {
            $sentenciaSQL = $pdo->prepare('DELETE FROM eventos WHERE id_evento=:id_evento');
            $respuesta = $sentenciaSQL->execute(array("id_evento"=>$_POST['id_evento']));
        }

        echo json_encode($respuesta);
        break;
    case 'modificar':
        $sentenciaSQL = $pdo->prepare("UPDATE eventos SET
        title=:title,
        descripcion=:descripcion,
        color=:color,
        textColor=:textColor,
        start=:start,
        end=:end
        WHERE id_evento=:id_evento");

        $respuesta = $sentenciaSQL->execute(array(
            "id_evento" => $_POST['id_evento'],
            "title" => $_POST['title'],
            "descripcion" => $_POST['descripcion'],
            "color" => $_POST['color'],
            "textColor" => $_POST['textColor'],
            "start" => $_POST['start'],
            "end" => $_POST['end']
        ));
        echo json_encode($respuesta);
        break;
    default:
        //Seleccionar los eventos del calendario
        $sentenciaSQL = $pdo->prepare("SELECT * FROM eventos WHERE id_usuario=:id_usuario");
        $sentenciaSQL->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $sentenciaSQL->execute();

        $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        break;
}


?>
<?php
    session_start();
    $cerrar_sesion = $_GET['cerrar_sesion'];
    if($cerrar_sesion) {
        session_destroy();
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Roboto+Mono&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f24e46116.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <link rel="stylesheet" href="css/estilo.css">
    <link rel="icon" type="image/jpg" href="img/icono_logo.jpg">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>    
    <script src="js/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>

    <script src="js/check-login.js"></script>

    <title>WebPlanner</title>
</head>
<body>
    <div class="box">
        <img src="img/icono_blanco.png" height="200"> 
        <h1>WebPlanner</h1>
        
        <form action="check-login.php" name='loginForm' id='loginForm' method="POST" novalidate>
            <div class="form-group">
                <input type="email" class="form-control" id="usuario" name="usuario" placeholder="Correo Electrónico" 
                ata-bv-notempty="true"
                data-bv-notempty-message="Ingresa tu correo electrónico"

                data-bv-emailaddress="true"
                data-bv-emailaddress-message="El correo ingresado no es válido"
                required>
            </div>
            
            <div class="form-group">
                    <input type="password" class="form-control" id='password' name="password" placeholder="Contraseña" 
                    data-bv-notempty="true"
                    data-bv-notempty-message="Ingresa la contraseña" required>
            </div>
            
            <input type="hidden" name="btnIngresar" value='1'>
            <button  class="btn" type="submit">Ingresar</button>
        </form>
        
        
        <div class="registro">
            <h5>¿No tienes una cuenta? 
                <a href="registro.html">Registrate</a>
            </h4>   
        </div> 

        <button id="popover" type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="right" data-trigger="hover" data-content="AppWeb para la planificación de eventos y tareas a corto y largo plazo">
            ¿Qué es WebPlanner?
    </button>
        <br>
        <a href="https://github.com/florgm/webplanner" target="_blank">
            <i class="fab fa-github"></i>
        </a>
    </div>
</body>
</html>
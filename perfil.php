<?php
    include_once 'sesiones.php';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Roboto+Mono&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f24e46116.js"></script>
    
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/calendario.css">
    
    <link rel="icon" type="image/jpg" href="img/icono_logo.jpg">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
    
    <script src="js/modificar-usuario.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <title>WebPlanner</title>
</head>
<body>
<nav  class="navbar navbar-light bg-light">

<div class="navbar-header">
        <img src="img/icono_logo.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
        <a href="#">WebPlanner</a>
</div>
<ul class="nav justify-content-center">
    <li class="nav-item fecha">
            <script type="text/javascript">
                var d = new Date();                
                var mes = ["Enero", "Febrero", "Marzo", "Abril","Mayo","Junio","Julio","Agosto","Sepriembre","Septiembre","Octubre","Noviembre","Diciembre"];
                document.write('Hoy es ' + d.getDate() + ' de ' + mes[d.getMonth()]);
            </script>
    </li>
</ul>

<ul class="nav justify-content-end" id="nav">
        <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Perfil</a>
            <div class="dropdown-menu">
                <a class="dropdown-item verde" href="#">Editar Perfil</a>
                <a class="dropdown-item rojo" href="login.php?cerrar_sesion=true">Cerrar sesión</a>
            </div>
        </li>

        <li class="nav-item">
                <a class="nav-link" href="principal.php">Calendario</a>
        </li>       
</ul>

</nav>  
    
    <div class="contenedor-modificar">
        <h1>Editar Perfil</h1>
        <form action="modificar-usuario.php" id="perfilForm" name="perfilForm" class="needs-validation" method="POST" novalidate>
            
            <h4>Nombre</h4>

            <div class="form-group">
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" 
                data-bv-notempty="true"
                data-bv-notempty-message="Ingresa tu nombre">
              
            </div>

            <h4>Contraseña</h4>

            <div class="form-group">
                <input type="password" class="form-control" id='password' name="password" placeholder="Contraseña" 
                data-bv-notempty="true"
                data-bv-notempty-message="Ingresa la contraseña" required>
            </div>


            <div class="form-group">
                <input type="password" class="form-control" id='repassword' name="repassword" placeholder="Repetir contraseña" required
                data-bv-notempty="true"
                data-bv-notempty-message="Repite la contraseña"

                data-bv-identical="true"
                data-bv-identical-field="password"
                data-bv-identical-message="Las contraseñas no coinciden" >
            </div>


            <input type="hidden" name="btnPerfil" value='1'>
            <button class="btn" type="submit">Cambiar</button>
            
        </form> 
    </div>       
  
    <?php
        session_start();
        $nombre = $_SESSION['name'];
    ?>

    <script>            
        var nombre = '<?php echo $nombre; ?>';
        $('#nombre').val(nombre);
    </script>
</body>
</html>


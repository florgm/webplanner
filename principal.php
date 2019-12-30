<?php
    include_once 'sesiones.php';
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <link href="https://fonts.googleapis.com/css?family=Lobster|Roboto+Mono&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f24e46116.js"></script>
    
    <link rel="stylesheet" href="css/calendario.css">
    <link rel="icon" type="image/jpg" href="img/icono_logo.jpg">

    <script src="js/jquery.min.js"></script>
    <script src="js/moment.min.js"></script>

    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <script src="js/fullcalendar.min.js"></script>
    
    <script src="js/es.js"></script>

    <script src="js/bootstrap-clockpicker.js"></script>
    <link rel="stylesheet" href="css/bootstrap-clockpicker.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- <script src="js/principal.js"></script> -->

    <title>WebPlanner</title>
</head>
<body>
    <!-- Barra de navegacion -->
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
                        <a class="dropdown-item verde" href="perfil.php">Editar Perfil</a>
                        <a class="dropdown-item rojo" href="login.php?cerrar_sesion=true">Cerrar sesión</a>
                    </div>
                </li>

                <li class="nav-item">
                        <a class="nav-link" href="#">Calendario</a>
                </li>       
        </ul>
    
    </nav>

    <section>        
        <div class="container">
            <div id="CalendarioWeb"></div> 
        </div>

        <script>
            $(document).ready(function() {
                cargarTareas();
                $('#CalendarioWeb').fullCalendar({
                    header: {
                        left:'today, prev,next',
                        center:'title',
                        right:'month,agendaWeek,agendaDay'
                    },

                    dayClick:function(date,jsEvent,view) {
                        $('#btnAgregar').prop("disabled",false);
                        $('#btnModificar').prop("disabled",true);
                        $('#btnBorrar').prop("disabled",true);
                        limpiarFormulario();
                        $('#txtFecha').val(date.format());
                        $('#ModalEventos').modal();
                    },
                    
                    events: {url: 'eventos.php'},

                    eventClick:function(calEvent,jsEvent,view) {
                        $('#btnAgregar').prop("disabled",true);
                        $('#btnModificar').prop("disabled",false);
                        $('#btnBorrar').prop("disabled",false);

                        $('#tituloEvento').html(calEvent.title);

                        //Mostrar la info del evento en los inputs
                        $('#txtID').val(calEvent.id_evento);
                        $('#txtTitulo').val(calEvent.title);
                        $('#txtDescripcion').val(calEvent.descripcion);
                        $('#txtColor').val(calEvent.color);

                        FechaHora = calEvent.start._i.split(" ");
                        $('#txtFecha').val(FechaHora[0]);
                        $('#txtHora').val(FechaHora[1]);


                        $('#ModalEventos').modal();
                    },

                    editable:true,

                    eventDrop:function(calEvent) {
                        $('#txtID').val(calEvent.id_evento);
                        $('#txtTitulo').val(calEvent.title);
                        $('#txtDescripcion').val(calEvent.descripcion);
                        $('#txtColor').val(calEvent.color);

                        var fechaHora = calEvent.start.format().split("T");
                        $('#txtFecha').val(fechaHora[0]);
                        $('#txtHora').val(fechaHora[1]);   

                        RecolectarDatosGUI();
                        EnviarInformacion('modificar',NuevoEvento,true);
                    }
                });

                
            })
        </script>
    
        <!-- Modal (ABM) -->
        <div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
        
                    <div class="modal-header">
                        <h5 class="modal-title" id="tituloEvento"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        
                    <div class="modal-body">

                        <input type="hidden" id="txtIDUsuario" name="txtIDUsuario">
                        <input type="hidden" id="txtID" name="txtID">
                        <input type="hidden" id="txtFecha" name="txtFecha">
                        
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label >Título:</label>
                                <input type="text" id="txtTitulo" class="form-control" placeholder="Título del evento">
                            </div>
    
                            <div class="form-group col-md-4">
                                <label>Hora:</label>
                                <div class="input-group clockpicker" data-autoclose="true"> 
                                    <input type="text" id="txtHora" value="10:30" class="form-control">
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Descripción:</label>
                            <textarea id="txtDescripcion" rows="3" class="form-control"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Color:</label>
                            <input type="color" value="#ff0000" id="txtColor" class="form-control" style="height:36px;">    
                        </div>
                        
    
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
                        <button type="button" id='btnModificar' class="btn btn-success">Modificar</button>
                        <button type="button" id='btnBorrar' class="btn btn-danger">Borrar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php 
        session_start();
        $id_usuario = $_SESSION['id_usuario'];
    ?>

    <script>
        var NuevoEvento;
        var idUsuario = '<?php echo $id_usuario ?>';
        
        $('#btnAgregar').click(function() {
            RecolectarDatosGUI();
            EnviarInformacion('agregar',NuevoEvento);
        })

        $('#btnModificar').click(function() {
            RecolectarDatosGUI();
            EnviarInformacion('modificar',NuevoEvento);
        })

        $('#btnBorrar').click(function() {
            RecolectarDatosGUI();
            EnviarInformacion('borrar',NuevoEvento);
        })

        function RecolectarDatosGUI() {
            NuevoEvento = {
                id_usuario:idUsuario,
                id_evento:$('#txtID').val(),
                title:$('#txtTitulo').val(),
                start:$('#txtFecha').val()+" "+$('#txtHora').val(),
                color:$('#txtColor').val(),
                descripcion: $('#txtDescripcion').val(),
                textColor:"#FFFFFF",
                end:$('#txtFecha').val()+" "+$('#txtHora').val()
            };
        }

        function EnviarInformacion(accion,objEvento,modal) {
            //Mandar la informacion sin que la página se refresque
            $.ajax({
                type:'POST',
                url:'eventos.php?accion='+accion,
                data:objEvento,
                success:function(msg) {
                    if(msg) {
                        $('#CalendarioWeb').fullCalendar('refetchEvents');
                        if(!modal) {
                            $('#ModalEventos').modal('toggle');
                        }
                    }
                },
                error:function() {
                    alert("Hay un error");
                }

            });
        }

        $('.clockpicker').clockpicker();

        function limpiarFormulario() {
            $('#txtID').val('');
            $('#txtTitulo').val('');
            $('#txtDescripcion').val('');
            $('#txtColor').val('#FF0000');
        }
    
    </script>

    <aside>
        <div class="contenedor-tareas">
            <form id="formularioTareas" action="#">
                <legend>Tareas</legend>

                <div class="campos-tareas">
                    <div class="campo-tarea">
                        <input class="txtb" type="text" id="txtTarea" name="txtTarea" placeholder="Tarea">
                        <button class="btn flecha" type="submit" value="Agregar">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </form>
        
            <div class="contenedor-lista-tareas">
                <div class="contenedor-tareas-nocomp">
                    <table id="lista-tareas-nocomp">
                        <thead>
                            <tr>
                                <th>No completadas</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                        </tbody>
                    </table>
                </div>

                <div class="contenedor-tareas-comp">
                    <table id="lista-tareas-comp">
                        <thead>
                            <tr>
                                <th>Completadas</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </aside>

    <script>
        const formularioTareas = document.querySelector('#formularioTareas'),
              listadoTareasNoCompletadas = document.querySelector('#lista-tareas-nocomp tbody'),
              listadoTareasCompletadas = document.querySelector('#lista-tareas-comp tbody'); 

        eventListeners();

        function eventListeners() {
            formularioTareas.addEventListener('submit', leerFormulario);

            listadoTareasCompletadas.addEventListener('click', modificarTarea);
            listadoTareasNoCompletadas.addEventListener('click', modificarTarea);
        }

        function leerFormulario(e) {
            e.preventDefault();

            const tarea = document.querySelector('#txtTarea').value;

            if(tarea != '') {
                var nuevaTarea = {
                    id_usuario:idUsuario,
                    tarea:tarea,
                    completado:'0'
                };

                agregarTarea(nuevaTarea);
            }

        }

        function agregarTarea(nuevaTarea) {
            $.ajax({
                type:'POST',
                url:'tareas.php?accion=agregar',
                data:nuevaTarea,
                success:function(msg) {
                    if(msg) {
                        const respuesta = JSON.parse(msg);
                        
                        const nuevaTarea = document.createElement('tr');

                        nuevaTarea.innerHTML = `
                            <td>${respuesta.datos.tarea}</td>
                        `;

                        const contenedorCompletar = document.createElement('td');
                        const iconoCompletar = document.createElement('i');
                        iconoCompletar.classList.add('fas', 'fa-check');

                        const btnCompletar = document.createElement('button');
                        btnCompletar.appendChild(iconoCompletar);
                        btnCompletar.setAttribute('data-id', respuesta.datos.id_tarea);
                        btnCompletar.classList.add('btn', 'btn-completar');

                        contenedorCompletar.appendChild(btnCompletar);
                        nuevaTarea.appendChild(contenedorCompletar);

                        const contenedorBorrado = document.createElement('td');
                        const iconoBorrar = document.createElement('i');
                        iconoBorrar.classList.add('fas', 'fa-trash-alt');

                        const btnEliminar = document.createElement('button');
                        btnEliminar.appendChild(iconoBorrar);
                        btnEliminar.setAttribute('data-id', respuesta.datos.id_tarea);
                        btnEliminar.classList.add('btn', 'btn-borrar');

                        contenedorBorrado.appendChild(btnEliminar);

                        nuevaTarea.appendChild(contenedorBorrado);

                        listadoTareasNoCompletadas.appendChild(nuevaTarea);

                        limpiarTarea();
                    }
                },
                error:function() {
                    alert("Hay un error");
                }

            });
        }

        function limpiarTarea() {
            $('#txtTarea').val('');
        }

        var cargandoTareas = 'Cargar';

        function cargarTareas() {
            $.ajax({
                type:'POST',
                url:'tareas.php?accion=leer',
                data:cargandoTareas,
                success:function(msg) {
                    if(msg) {
                        const respuesta = JSON.parse(msg);

                        respuesta.forEach(tareas => {
                            if(tareas.completado == 0) {
                                const tareaNoComp = document.createElement('tr');
                                
                                tareaNoComp.innerHTML = `
                                    <td>${tareas.tarea}</td>
                                `;
                                
                                const contenedorCompletar = document.createElement('td');
                                const iconoCompletar = document.createElement('i');
                                iconoCompletar.classList.add('fas', 'fa-check');

                                const btnCompletar = document.createElement('button');
                                btnCompletar.appendChild(iconoCompletar);
                                btnCompletar.setAttribute('data-id', tareas.id_tarea);
                                btnCompletar.classList.add('btn', 'btn-completar');

                                contenedorCompletar.appendChild(btnCompletar);
                                tareaNoComp.appendChild(contenedorCompletar);

                                const contenedorBorrado = document.createElement('td');
                                const iconoBorrar = document.createElement('i');
                                iconoBorrar.classList.add('fas', 'fa-trash-alt');

                                const btnEliminar = document.createElement('button');
                                btnEliminar.appendChild(iconoBorrar);
                                btnEliminar.setAttribute('data-id', tareas.id_tarea);
                                btnEliminar.classList.add('btn', 'btn-borrar');

                                contenedorBorrado.appendChild(btnEliminar);

                                tareaNoComp.appendChild(contenedorBorrado);

                                listadoTareasNoCompletadas.appendChild(tareaNoComp);
                            } else {
                                const tareaComp = document.createElement('tr');

                                tareaComp.innerHTML = `
                                    <td>${tareas.tarea}</td>
                                `;

                                const contenedorBorrado = document.createElement('td');
                                const iconoBorrar = document.createElement('i');
                                iconoBorrar.classList.add('fas', 'fa-trash-alt');

                                const btnEliminar = document.createElement('button');
                                btnEliminar.appendChild(iconoBorrar);
                                btnEliminar.setAttribute('data-id', tareas.id_tarea);
                                btnEliminar.classList.add('btn', 'btn-borrar');

                                contenedorBorrado.appendChild(btnEliminar);

                                tareaComp.appendChild(contenedorBorrado);

                                listadoTareasCompletadas.appendChild(tareaComp);
                            }
                        });
                    }
                },
                error:function() {
                    alert("Hay un error");
                }

            });
        }

        function modificarTarea(e) {
            if(e.target.parentElement.classList.contains('btn-borrar')) {
                var nuevaTarea = {
                    id_tarea:e.target.parentElement.getAttribute('data-id')
                };
                
                $.ajax({
                    type:'POST',
                    url:'tareas.php?accion=borrar',
                    data:nuevaTarea,
                    success:function(msg) {
                        if(msg) {
                            e.target.parentElement.parentElement.parentElement.remove();
                        }
                    },
                    error:function() {
                        alert("Hay un error");
                    }
                });
            } else if(e.target.parentElement.classList.contains('btn-completar')) {
                var nuevaTarea = {
                    id_tarea:e.target.parentElement.getAttribute('data-id'),
                    completado:1
                };

                $.ajax({
                    type:'POST',
                    url:'tareas.php?accion=modificar',
                    data:nuevaTarea,
                    success:function(msg) {
                        if(msg) {
                            const completada = e.target.parentElement.parentElement.parentElement;
                            e.target.parentElement.parentElement.remove();
                            listadoTareasCompletadas.appendChild(completada);

                        }
                    },
                    error:function() {
                        alert("Hay un error");
                    }
                });
            }


        }

    </script>
</body>
</html>
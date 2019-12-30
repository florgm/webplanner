$(document).ready(function() {
    console.log("Anda");
    // $(function () {
    //      $('#popover').popover();
    // })
    
    var contador = 0;
    $('#loginForm').bootstrapValidator();

    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        contador++;

        if(contador === 2) {
            var datos = $(this).serializeArray();
            
            $.ajax({
                type: $(this).attr('method'),
                data: datos,
                url: $(this).attr('action'),
                dataType: 'json',
                success: function(msg) {
                    if(msg) {
                        document.location.href='principal.php';
                    } else {
                        Swal.fire({
                            title: '<strong>Error</strong>',
                            type: 'error',
                            text: 'El usuario ingresado no existe o la contraseña es incorrecta',
                            showCloseButton: false,
                            showCancelButton: false,
                            focusConfirm: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Reintentar',
                            confirmButtonAriaLabel: 'Reintentar',
                        }).then((result) => {
                            if (result.value) {
                                document.location.href='login.php';
                            } 
                        })
                    }
                }   
            })
        }
    });
});
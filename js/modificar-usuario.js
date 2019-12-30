$(document).ready(function(){
    var contador = 0;
    $('#perfilForm').bootstrapValidator();
    $('#perfilForm').on('submit', function(e){
        contador++;
        e.preventDefault();
        if(contador === 2){
            var datos = $(this).serializeArray();
            $.ajax({
                type: $(this).attr('method'),
                data: datos,
                url: $(this).attr('action'),
                dataType: 'json',
                success: function(msg) {
                    if(msg) {
                        Swal.fire({
                            title: 'Éxito!',
                            text: "Cambio registrado correctamente",
                            type: 'success',
                            showCloseButton: false,
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ingresa'
                          }).then((result) => {
                            if (result.value) {
                              document.location.href='login.php';
                            }
                        })
                    } else {
                        Swal.fire({
                        title: '<strong>Error</strong>',
                        type: 'error',
                        text: 'No se pudo realizar el cambio',
                        showCloseButton: false,
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText: 'Login',
                        confirmButtonAriaLabel: 'Login',
                        cancelButtonText: 'Reintentar',
                        cancelButtonAriaLabel: 'Reintentar',
                        }).then((result) => {
                            if (result.value) {
                                document.location.href='login.php';
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                $('#nombre').val('');
                                $('#usuario').val('');
                                $('#password').val('');
                                $('#repassword').val('');
                            }
                        })
                    }
                }
            })
            contador = 0;
        }
    });
})
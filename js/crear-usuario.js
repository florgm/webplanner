$(document).ready(function() {
    var contador = 0;
    var forms = document.getElementsByClassName('needs-validation');

    $('#registrationForm').bootstrapValidator();

    var validation = Array.prototype.filter.call(forms, function(form) {
        $('#registrationForm').on('submit', function(e) {
            contador++;
            console.log("Anda!");
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                e.preventDefault();
            
                if(contador === 2) {
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
                                    text: "Usuario registrado correctamente",
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
                                text: 'El usuario ya está registrado',
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
            }
            form.classList.add('was-validated');
        })
    })
});
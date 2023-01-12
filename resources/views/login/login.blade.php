@extends('layout.login')

@section('title')
    Konecta
@endsection

@section('content')
    <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_hy4txm7l.json" background="transparent" speed="1"
        style="width: 50%; margin: auto;" loop autoplay></lottie-player>
    <x-form-login id="formLogin">
        <button class="btn btn-info btn-block btn-lg text-white" type="button" onclick="login();">
            Iniciar Sesión <i class="fal fa-sign-in"></i>
        </button>
    </x-form-login>
@endsection

@section('script')
    <script>
        function login() {
            if ($('#email').val() == "") {
                Command: toastr["warning"](
                    "Por favor digite su correo electronico.",
                    "Falta Correo Electronico"
                );
                return false;
            }
            else if ($('#password').val() == "") {
                Command: toastr["warning"](
                    "Por favor digite su nombre de contraseña.",
                    "Falta Conreaseña"
                );
                return false;
            }
            else {
                var data = $("#formLogin").serialize();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/check',
                    data: data,
                    success: function(response) {
                        if (response == 1) {
                            window.location.replace('/inicio');
                        } else if (response == 3) {
                            Swal.fire({
                                icon: "error",
                                title: "<strong>Credenciales Incorrectas</strong>",
                                html: "<h5>Si no recuerda sus credenciales dirijase a sistemas.</h5>",
                                showCloseButton: true,
                                showConfirmButton: false,
                                cancelButtonText: "Cerrar",
                                cancelButtonColor: "#dc3545",
                                showCancelButton: true,
                                backdrop: true,
                            });
                        }
                    }
                });
            }
            toastr.options = {
                closeButton: false,
                debug: false,
                newestOnTop: true,
                progressBar: true,
                positionClass: "toast-top-right",
                preventDuplicates: true,
                onclick: null,
                showDuration: 300,
                hideDuration: 100,
                timeOut: 5000,
                extendedTimeOut: 1000,
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
            };
        }
    </script>
@endsection

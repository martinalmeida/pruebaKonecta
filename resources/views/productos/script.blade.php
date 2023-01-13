@section('script')
    <script type="text/javascript">
        let edit = false;
        var peticion = null;
        var tablaProductos = "";

        $(document).ready(function() {
            tablaProductos = $('#tablaProductos').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('table.producto') }}",
                columns: [{
                        data: 'nombreProducto',
                        name: 'nombreProducto'
                    },
                    {
                        data: 'referencia',
                        name: 'referencia'
                    },
                    {
                        data: 'precio',
                        name: 'precio'
                    },
                    {
                        data: 'peso',
                        name: 'peso'
                    },
                    {
                        data: 'categoria',
                        name: 'categoria'
                    },
                    {
                        data: 'cantidad',
                        name: 'cantidad'
                    },
                    {
                        data: 'creado',
                        name: 'creado'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'estado',
                        name: 'estado'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                responsive: true,
                lengthChange: false,
                dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [{
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        titleAttr: 'Generate PDF',
                        className: 'btn-outline-danger btn-sm mr-1'
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        titleAttr: 'Generate Excel',
                        className: 'btn-outline-success btn-sm mr-1'
                    }
                ]
            });
            $("#categoriaId").select2({
                placeholder: "Selecciona la categoria a la que pertenece el producto",
                allowClear: true,
            });
            selects();
        });

        function selects() {
            $.ajax({
                dataType: "json",
                url: "{{ route('select.categoria') }}",
                type: "GET",
                success: function(result) {

                    var html = "";
                    for (let i = 0; i < result.length; i++) {
                        html += '<option value="' +
                            result[i].id +
                            '">' +
                            result[i].categoria +
                            '</option>';
                    }
                    $("#categoriaId").html(html);

                },
                error: function(xhr) {
                    console.log(xhr);
                    Swal.fire({
                        icon: "error",
                        title: "<strong>Error!</strong>",
                        html: "<h5>Se ha presentado un error, por favor informar al area de Sistemas.</h5>",
                        showCloseButton: true,
                        showConfirmButton: false,
                        cancelButtonText: "Cerrar",
                        cancelButtonColor: "#dc3545",
                        showCancelButton: true,
                        backdrop: true,
                    });
                },
            });
        }

        function register(form) {
            if ($('#nombreProducto').val() == 0 || $('#referencia').val() == 0 || $('#precio').val() == 0 || $('#peso')
                .val() == 0 || $('#categoriaId').val() == null) {
                Command: toastr["error"](
                    "Por favor digite todos los campos del formulario para poder guardarlo.",
                    "Formulario Incompleto"
                );
            }
            else {
                edit == true ? peticion = "/updateProducto" : peticion = "/createProducto";
                data = $("#" + form).serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: peticion,
                    data: data,
                    success: function(result) {
                        if (result.status == true) {
                            Command: toastr["success"](
                                "El registro se ha guardado exitosamente.",
                                "Registro Guardado"
                            );
                            tablaProductos.clear().draw();
                            $("#ModalRegistro").modal("hide");
                        }
                        else {
                            Command: toastr["error"](
                                "El registro no se ha logrado guardar.",
                                "Fallo al Registrar"
                            );
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr);
                        Swal.fire({
                            icon: "error",
                            title: "<strong>Error!</strong>",
                            html: "<h5>Se ha presentado un error, por favor informar al area de Sistemas.</h5>",
                            showCloseButton: true,
                            showConfirmButton: false,
                            cancelButtonText: "Cerrar",
                            cancelButtonColor: "#dc3545",
                            showCancelButton: true,
                            backdrop: true,
                        });
                        $("#ModalRegistro").modal("hide");
                    },
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

        function listData(id) {
            $("#inputsEdit").html("");
            edit = true;
            $.ajax({
                type: 'GET',
                url: '/producto/' + id,
                success: function(result) {
                    $("#btnRegistro").text("Editar Registro");
                    $("#btnRegistro").attr("onclick", "register('frmRegistro');");
                    $("#btnRegistro").removeClass("btn btn-info");
                    $("#btnRegistro").addClass("btn btn-success");
                    $("#nombreProducto").val(result[0].nombreProducto);
                    $("#referencia").val(result[0].referencia);
                    $("#precio").val(result[0].precio);
                    $("#peso").val(result[0].peso);
                    $("#categoriaId").val(result[0].categoriaId);
                    $("#categoriaId").val(result[0].categoriaId).trigger("change");
                    $("#inputsEdit").html('<input type="hidden" id="idProducto" name="idProducto" value="' +
                        result[0].id + '">');
                    $("#ModalRegistro").modal({
                        backdrop: "static",
                        keyboard: false,
                    });
                },
                error: function(xhr) {
                    console.log(xhr);
                    Swal.fire({
                        icon: "error",
                        title: "<strong>Error!</strong>",
                        html: "<h5>Se ha presentado un error, por favor informar al area de Sistemas.</h5>",
                        showCloseButton: true,
                        showConfirmButton: false,
                        cancelButtonText: "Cerrar",
                        cancelButtonColor: "#dc3545",
                        showCancelButton: true,
                        backdrop: true,
                    });
                    $("#ModalRegistro").modal("hide");
                },
            });
        }

        function statusChange(id, status) {
            $.ajax({
                type: 'GET',
                url: '/statusProducto/' + id + '/' + status,
                success: function(result) {
                    if (result.status == true) {
                        Command: toastr["success"](
                            "Estado del registro cambiado exitosamente.",
                            "Estado Cambiado"
                        );
                    }
                    else {
                        Command: toastr["error"](
                            "El estado del registro no se pudo cambiar.",
                            "Estado No Cambiado"
                        );
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
                    tablaProductos.clear().draw();
                },
                error: function(xhr) {
                    console.log(xhr);
                    Swal.fire({
                        icon: "error",
                        title: "<strong>Error!</strong>",
                        html: "<h5>Se ha presentado un error, por favor informar al area de Sistemas.</h5>",
                        showCloseButton: true,
                        showConfirmButton: false,
                        cancelButtonText: "Cerrar",
                        cancelButtonColor: "#dc3545",
                        showCancelButton: true,
                        backdrop: true,
                    });
                },
            });
        }

        function deleteRegister(id) {
            Swal.fire({
                icon: "warning",
                title: "Eliminar Registro?",
                text: "Eliminar el registro del sistema!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Eliminar Registro",
                preConfirm: function() {
                    $.ajax({
                        type: 'GET',
                        url: '/deleteProducto/' + id,
                        success: function(result) {
                            if (result.status == true) {
                                Command: toastr["success"](
                                    "el registro se ha eliminado exitosamente.",
                                    "Registro Eliminado"
                                );
                            }
                            else {
                                Command: toastr["error"](
                                    "el registro no se ha eliminado.",
                                    "Registro no Eliminado"
                                );
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
                            tablaProductos.clear().draw();
                        },
                        error: function(xhr) {
                            console.log(xhr);
                            Swal.fire({
                                icon: "error",
                                title: "<strong>Error!</strong>",
                                html: "<h5>Se ha presentado un error, por favor informar al area de Sistemas.</h5>",
                                showCloseButton: true,
                                showConfirmButton: false,
                                cancelButtonText: "Cerrar",
                                cancelButtonColor: "#dc3545",
                                showCancelButton: true,
                                backdrop: true,
                            });
                        },
                    });
                },
            });
        }

        function showModalRegistro() {
            reset();
            $("#btnRegistro").text("Crear Nuevo Registro");
            $("#btnRegistro").attr("onclick", "register('frmRegistro');");
            $("#ModalRegistro").modal({
                backdrop: "static",
                keyboard: false,
            });
            edit = false;
            $("#inputsEdit").html("");
        }

        function reset() {
            edit = false;
            vercampos("#frmRegistro", 1);
            limpiarcampos("#frmRegistro");
            $("#imagenBase64").html("");
            $("#btnRegistro").removeClass("btn btn-success");
            $("#btnRegistro").addClass("btn btn-info");
        }

        function filterFloat(evt, input) {
            // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
            var key = window.Event ? evt.which : evt.keyCode;
            var chark = String.fromCharCode(key);
            var tempValue = input.value + chark;
            if (key >= 48 && key <= 57) {
                if (filter(tempValue) === false) {
                    return false;
                } else {
                    return true;
                }
            } else {
                if (key == 8 || key == 13 || key == 0) {
                    return true;
                } else if (key == 46) {
                    if (filter(tempValue) === false) {
                        return false;
                    } else {
                        return true;
                    }
                } else {
                    return false;
                }
            }
        }

        function filter(__val__) {
            var preg = /^([0-9]+\.?[0-9]{0,2})$/;
            if (preg.test(__val__) === true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection

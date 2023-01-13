@section('script')
    <script type="text/javascript">
        let edit = false;
        var peticion = null;
        var tablaVentas = "";

        $(document).ready(function() {
            tablaVentas = $('#tablaVentas').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('table.ventas') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nombreProducto',
                        name: 'nombreProducto'
                    },
                    {
                        data: 'categoria',
                        name: 'categoria'
                    },
                    {
                        data: 'personaVenta',
                        name: 'personaVenta'
                    },
                    {
                        data: 'cantidad',
                        name: 'cantidad'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
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
            $("#stockId").select2({
                placeholder: "Selecciona el producto a vender",
                allowClear: true,
            });
            selects();
        });

        function selects() {
            $.ajax({
                dataType: "json",
                url: "{{ route('select.productoStock') }}",
                type: "GET",
                success: function(result) {

                    var html = "";
                    for (let i = 0; i < result.length; i++) {
                        html += '<option value="' +
                            result[i].id +
                            '">' +
                            result[i].nombreProducto +
                            '</option>';
                    }
                    $("#stockId").html(html);

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
            if ($('#stockId').val() == null || $('#cantidad').val() == 0 || $('#personaVenta').val() == 0 || $(
                    '#descripcion').val() == 0) {
                Command: toastr["error"](
                    "Por favor digite todos los campos del formulario para poder guardarlo.",
                    "Formulario Incompleto"
                );
            }
            else {
                edit == true ? peticion = "/updateVenta" : peticion = "/createVenta";
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
                            tablaVentas.clear().draw();
                            $("#ModalRegistro").modal("hide");
                        }
                        else {
                            Command: toastr["warning"](
                                "El stock es menor a la cantidad que se desea vender.",
                                "No hay stock suficiente"
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
                url: '/venta/' + id,
                success: function(result) {
                    $("#btnRegistro").text("Editar Registro");
                    $("#btnRegistro").attr("onclick", "register('frmRegistro');");
                    $("#btnRegistro").removeClass("btn btn-info");
                    $("#btnRegistro").addClass("btn btn-success");
                    $("#stockId").val(result[0].stockId);
                    $("#stockId").val(result[0].stockId).trigger("change");
                    $("#cantidad").val(result[0].cantidad);
                    $("#personaVenta").val(result[0].personaVenta);
                    $("#descripcion").val(result[0].descripcion);
                    $("#inputsEdit").html('<input type="hidden" id="idVenta" name="idVenta" value="' +
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
                url: '/statusVenta/' + id + '/' + status,
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
                    tablaVentas.clear().draw();
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
                        url: '/deleteVenta/' + id,
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
                            tablaVentas.clear().draw();
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
    </script>
@endsection

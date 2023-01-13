@section('script')
    <script type="text/javascript">
        let edit = false;
        var peticion = null;
        var tablaStock = "";

        $(document).ready(function() {
            tablaStock = $('#tablaStock').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('table.stock') }}",
                columns: [{
                        data: 'nombreProducto',
                        name: 'nombreProducto'
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
                        data: 'cantidad',
                        name: 'cantidad'
                    },
                    {
                        data: 'canti2',
                        name: 'canti2'
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
            $("#productoId").select2({
                placeholder: "Selecciona el producto a añadir stock",
                allowClear: true,
            });
            selects();
        });

        function selects() {
            $.ajax({
                dataType: "json",
                url: "{{ route('select.producto') }}",
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
                    $("#productoId").html(html);

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

        function editStock(form) {
            if ($('#idStock').val() == 0 || $('#cantidad').val() == 0) {
                Command: toastr["error"](
                    "Por favor digite todos los campos del formulario para poder guardarlo.",
                    "Formulario Incompleto"
                );
            }
            else {
                data = $("#" + form).serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/updateStock',
                    data: data,
                    success: function(result) {
                        if (result.status == true) {
                            Command: toastr["success"](
                                "El registro se ha guardado exitosamente.",
                                "Registro Guardado"
                            );
                            tablaStock.clear().draw();
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
                url: '/stock/' + id,
                success: function(result) {
                    $("#btnRegistro").text("Editar Stock");
                    $("#btnRegistro").attr("onclick", "editStock('frmRegistro');");
                    $("#btnRegistro").addClass("btn btn-warning text-white");
                    $("#productoId").prop("disabled", true);
                    $("#productoId").val(result[0].productoId);
                    $("#productoId").val(result[0].productoId).trigger("change");
                    $("#cantidad").val(result[0].cantidad);
                    $("#inputsEdit").html('<input type="hidden" id="idStock" name="idStock" value="' +
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

<?php

require_once realpath(__DIR__ . "/../../../core/ViewHelpers.php");

startSection('title'); ?>
    Asistencias
<?php endSection(); ?>
<?php startSection('content'); ?>
    <button class="btn btn-outline-primary mb-2" type="button" id="addModal"><i class="fas fa-plus"></i></button>

    <div class="card shadow-lg">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover display responsive nowrap" id="tablaAsistencias" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Entreda</th>
                            <th>Salida</th>
                            <th>Entrenador</th>
                            <th>Rutina</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frmAsistencia" onsubmit="save(event);" autocomplete="off">
                    <input type="hidden" id="id" name="id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <input type="hidden" id="customer_id" name="customer_id" required>
                                    <label for="customers"><i class="fas fa-users"></i> Buscar Cliente</label>
                                    <input type="text" id="customers" class="form-control" placeholder="Buscar..." required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="coaches"><i class="fas fa-user"></i> Buscar Entrenador</label>
                                    <input type="hidden" id="coach_id" name="coach_id" required>
                                    <input type="text" id="coaches" placeholder="Buscar..." class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="routines"><i class="fas fa-list"></i> Buscar Asistencia</label>
                                    <input type="hidden" id="routine_id" name="routine_id" required>
                                    <input type="text" id="routines" placeholder="Buscar..." class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-primary" type="submit" id="btnAccion">Registrar</button>
                        <button class="btn btn-outline-danger" type="button" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endSection(); ?>
<?php startSection('scripts'); ?>
    <script>
        var tablaAsistencias;

        tablaAsistencias = $('#tablaAsistencias').DataTable({
            responsive: true,
            processing: true,
            serverSide: false,
            ajax: {
                url: `${api_admin_url}/attendances`,
                dataSrc: '',
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
            },
            columns: [
                { 'data': 'id' },
                {
                    data: 'customer',
                    render: function (data) {
                        return `${data.name} ${data.lastname}`;
                    }
                },
                { 'data': 'date' },
                { 'data': 'check_in_time' },
                {
                    data: 'check_out_time',
                    render: function (data) {
                        if (data != null) {
                            return data;
                        }
                        return '-';
                    }
                },
                {
                    data: 'coach',
                    render: function (data) {
                        return `${data.name} ${data.paternal_surname} ${data.maternal_surname}`;
                    }
                },
                {
                    data: 'routine',
                    render: function (data) {
                        return data.description;
                    }
                },
                {
                    data: 'id',
                    render: function (data, type, full) {
                        if (full.status == 1) {
                            return `<button type="button" class="btn btn-inverse-success btn-fw update-status" data-id="${data}" data-status="${full.status}">Entrada</button>`;
                        } else {
                            return `<button type="button" class="btn btn-inverse-danger btn-fw update-status" data-id="${data}" data-status="${full.status}" disabled>Salida</button>`;
                        }
                    }
                },
                {
                    data: 'id',
                    render: function (data) {
                        return `<button class="btn btn-outline-primary" type="button" onclick="editModal(${data});"><i class="fas fa-edit"></i></button>`;
                    }
                }
            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
            },
            resonsieve: true,
            iDisplayLength: 10,
            order: [
                [0, "desc"]
            ]
        });

        $('#addModal').click(function () {
            document.getElementById("title").textContent = "Nueva Asistencia";
            document.getElementById("btnAccion").textContent = "Registrar";
            document.getElementById("frmAsistencia").reset();
            document.getElementById("id").value = "";
            $('#attendanceModal').modal('show');
        });

        function editModal(id) {
            document.getElementById("title").textContent = "Actualizar Asistencia";
            document.getElementById("btnAccion").textContent = "Modificar";

            $.ajax({
                type: "get",
                url: `${api_admin_url}/attendances/${id}`,
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
                dataType: "json",
                success: function(response) {
                    document.getElementById("id").value = response.id;
                    document.getElementById('customer_id').value = response.customer.id;
                    document.getElementById("customers").value = response.customer.name + " " + response.customer.lastname;
                    document.getElementById('coach_id').value = response.coach.id;
                    document.getElementById("coaches").value = response.coach.name + " " + response.coach.paternal_surname + " " +response.coach.maternal_surname;
                    document.getElementById('routine_id').value = response.routine.id;
                    document.getElementById("routines").value = response.routine.day + " - " + response.routine.description;
                    $('#attendanceModal').modal('show');
                }
            });
        }

        $("#customers").autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    url: `${api_admin_url}/customers`,
                    headers: {
                        'Authorization': `Bearer ${token}`,
                    },
                    data: {
                        search: request.term
                    },
                    dataType: "json",
                    success: function (data) {
                        let results = [];
                        results = $.map(data, function(item) {
                            return {
                                label: `${item.name} ${item.lastname}`,
                                id: item.id
                            };
                        })
                        response(results);
                    }
                });
            },
            select: function (event, ui) {
                document.getElementById('customer_id').value = ui.item.id;
                // document.getElementById('customers').value = ui.item.label;
            }
        });

        $("#coaches").autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    url: `${api_admin_url}/coaches`,
                    headers: {
                        'Authorization': `Bearer ${token}`,
                    },
                    data: {
                        search: request.term
                    },
                    dataType: "json",
                    success: function (data) {
                        let results = [];
                        results = $.map(data, function(item) {
                            return {
                                label: `${item.name} ${item.paternal_surname} ${item.maternal_surname}`,
                                id: item.id
                            };
                        })
                        response(results);
                    }
                });
            },
            select: function (event, ui) {
                document.getElementById('coach_id').value = ui.item.id;
                // document.getElementById('coaches').value = ui.item.label;
            }
        });

        $("#routines").autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    url: `${api_admin_url}/routines`,
                    headers: {
                        'Authorization': `Bearer ${token}`,
                    },
                    data: {
                        search: request.term
                    },
                    dataType: "json",
                    success: function (data) {
                        let results = [];
                        results = $.map(data, function(item) {
                            return {
                                label: `${item.day} - ${item.description}`,
                                id: item.id
                            };
                        })
                        response(results);
                    }
                });
            },
            select: function (event, ui) {
                document.getElementById('routine_id').value = ui.item.id;
                // document.getElementById('routines').value = ui.item.label;
            }
        });

        function save(e) {
            e.preventDefault();
            const id = document.getElementById("id").value;
            const customer_id = document.getElementById('customer_id').value;
            const coach_id = document.getElementById('coach_id').value;
            const routine_id = document.getElementById('routine_id').value;

            if (customer_id == '' || coach_id == '' || routine_id == '') {
                alertas('Todo los campos son obligatorios', 'warning');
            } else {
                const frm = document.getElementById("frmAsistencia");
                let type, url;
                console.log('id: ', id);
                if (id == '') {
                    type = 'post';
                    url = `${api_admin_url}/attendances`;
                } else {
                    type = 'put';
                    url = `${api_admin_url}/attendances/${id}`;
                }
                $.ajax({
                    type,
                    url,
                    headers: {
                        'Authorization': `Bearer ${token}`,
                    },
                    data: {
                        customer_id,
                        coach_id,
                        routine_id,
                        user_id
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log('response', response);
                        alertas(response.message, 'success');
                        tablaAsistencias.ajax.reload();
                        frm.reset();
                        $('#attendanceModal').modal('hide');
                    }
                });
            }
        }

        $('#tablaAsistencias').on('click', '.update-status', function () {
            var id =  $(this).data('id');
            console.log('id', id);

            Swal.fire({
                title: 'Esta seguro?',
                text: "La asistencia se cambiara de estado y es irreversible",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "put",
                        url: `${api_admin_url}/attendances/status/${id}`,
                        headers: {
                            'Authorization': `Bearer ${token}`,
                        },
                        dataType: "json",
                        success: function(response) {
                            tablaAsistencias.ajax.reload();
                            alertas(response.message, 'success');
                        }
                    });
                }
            });
        });
    </script>
<?php endSection(); ?>
<?php

// Incluir el layout
include realpath(__DIR__ . "/../layouts/app.php");
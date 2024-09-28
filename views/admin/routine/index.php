<?php

require_once realpath(__DIR__ . "/../../../core/ViewHelpers.php");

startSection('title'); ?>
    Rutinas
<?php endSection(); ?>
<?php startSection('content'); ?>
    <button class="btn btn-outline-primary mb-2" type="button" id="addModal"><i class="fas fa-plus"></i></button>

    <div class="card shadow-lg">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover display responsive nowrap" id="tablaRutinas" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Dia</th>
                            <th>Descripción</th>
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

    <div class="modal fade" id="routineModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frmRutina" onsubmit="save(event);" autocomplete="off">
                    <input type="hidden" id="id" name="id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <label for="day">Día *</label>
                                    <input id="day" class="form-control" type="text" name="day" placeholder="Día" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Descripción *</label>
                                    <textarea id="description" class="form-control" name="description" placeholder="Descripción" rows="4" required></textarea>
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
        var tablaRutinas;

        tablaRutinas = $('#tablaRutinas').DataTable({
            responsive: true,
            processing: true,
            serverSide: false,
            ajax: {
                url: `${api_admin_url}/routines`,
                dataSrc: '',
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
            },
            columns: [
                { 'data': 'id' },
                { 'data': 'day' },
                { 'data': 'description' },
                {
                    data: 'id',
                    render: function (data, type, full) {
                        if (full.status == 1) {
                            return `<button type="button" class="btn btn-inverse-success btn-fw update-status" data-id="${data}" data-status="${full.status}">Habilitado</button>`;
                        } else {
                            return `<button type="button" class="btn btn-inverse-danger btn-fw update-status" data-id="${data}" data-status="${full.status}">Deshabilitado</button>`;
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
            document.getElementById("title").textContent = "Nueva Rutina";
            document.getElementById("btnAccion").textContent = "Registrar";
            document.getElementById("frmRutina").reset();
            document.getElementById("id").value = "";
            $('#routineModal').modal('show');
        });

        function editModal(id) {
            document.getElementById("title").textContent = "Actualizar Rutina";
            document.getElementById("btnAccion").textContent = "Modificar";

            $.ajax({
                type: "get",
                url: `${api_admin_url}/routines/${id}`,
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
                dataType: "json",
                success: function(response) {
                    document.getElementById("id").value = response.id;
                    document.getElementById("day").value = response.day;
                    document.getElementById("description").value = response.description;
                    $('#routineModal').modal('show');
                }
            });
        }

        function save(e) {
            e.preventDefault();
            const id = document.getElementById("id").value;
            const day = document.getElementById("day").value;
            const description = document.getElementById("description").value;

            if (day == '' || description == '') {
                alertas('Todo los campos son obligatorios', 'warning');
            } else {
                const frm = document.getElementById("frmRutina");
                let type, url;
                console.log('id: ', id);
                if (id == '') {
                    type = 'post';
                    url = `${api_admin_url}/routines`;
                } else {
                    type = 'put';
                    url = `${api_admin_url}/routines/${id}`;
                }
                $.ajax({
                    type,
                    url,
                    headers: {
                        'Authorization': `Bearer ${token}`,
                    },
                    data: {
                        day,
                        description
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log('response', response);
                        alertas(response.message, 'success');
                        tablaRutinas.ajax.reload();
                        frm.reset();
                        $('#routineModal').modal('hide');
                    }
                });
            }
        }

        $('#tablaRutinas').on('click', '.update-status', function () {
            var id =  $(this).data('id');
            var status =  $(this).data('status');
            console.log('id', id);
            
            if (status == 1) {
                var new_status = 0;
            } else {
                var new_status = 1;
            }
            Swal.fire({
                title: 'Esta seguro?',
                text: "La rutina se cambiara de estado",
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
                        url: `${api_admin_url}/routines/status/${id}`,
                        headers: {
                            'Authorization': `Bearer ${token}`,
                        },
                        data: {
                            status: new_status
                        },
                        dataType: "json",
                        success: function(response) {
                            tablaRutinas.ajax.reload();
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
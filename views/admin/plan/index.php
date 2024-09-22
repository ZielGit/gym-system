<?php

require_once realpath(__DIR__ . "/../../../core/ViewHelpers.php");

startSection('title'); ?>
    Plans
<?php endSection(); ?>
<?php startSection('content'); ?>
    <button class="btn btn-outline-primary mb-2" type="button" id="addModal"><i class="fas fa-plus"></i></button>

    <div class="card shadow-lg">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover display responsive nowrap" id="tablaPlanes" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Condición</th>
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

    <div class="modal fade" id="planModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frmPlan" onsubmit="save(event);" autocomplete="off">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <input type="hidden" id="id" name="id">
                                    <label for="name"><i class="fas fa-list"></i> Nombres</label>
                                    <input id="name" class="form-control" type="text" name="nombre" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="description"><i class="fas fa-list"></i> Descripción</label>
                                    <input id="description" class="form-control" type="text" name="description" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="price"><i class="fas fa-id-card"></i> Precio</label>
                                    <input id="price" class="form-control" type="number" name="price">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="condition"><i class="fas fa-list"></i> Condición</label>
                                    <input id="condition" class="form-control" type="text" name="condition" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><i class="fas fa-camera"></i> Foto (Opcional)</label>
                                    <input id="image" class="form-control" type="file" name="image">
                                </div>
                                <input type="hidden" id="foto_actual" name="foto_actual">
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
        var tablaPlanes;

        tablaPlanes = $('#tablaPlanes').DataTable({
            responsive: true,
            processing: true,
            serverSide: false,
            ajax: {
                url: `${api_admin_url}/plans`,
                dataSrc: '',
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
            },
            columns: [
                { 'data': 'id' },
                { 'data': 'name' },
                { 'data': 'description' },
                { 'data': 'price' },
                { 'data': 'condition' },
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
            document.getElementById("title").textContent = "Nuevo Plan";
            document.getElementById("btnAccion").textContent = "Registrar";
            document.getElementById("frmPlan").reset();
            document.getElementById("id").value = "";
            $('#planModal').modal('show');
        });

        function editModal(id) {
            document.getElementById("title").textContent = "Actualizar cliente";
            document.getElementById("btnAccion").textContent = "Modificar";

            $.ajax({
                type: "get",
                url: `${api_admin_url}/plans/${id}`,
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
                dataType: "json",
                success: function(response) {
                    document.getElementById("id").value = response.id;
                    document.getElementById("name").value = response.name;
                    document.getElementById("description").value = response.description;
                    document.getElementById("price").value = response.price;
                    document.getElementById("condition").value = response.condition;
                    $('#planModal').modal('show');
                }
            });
        }

        function save(e) {
            e.preventDefault();
            const id = document.getElementById("id").value;
            const name = document.getElementById("name").value;
            const description = document.getElementById("description").value;
            const price = document.getElementById("price").value;
            const condition = document.getElementById("condition").value;

            var formData = new FormData();
            formData.append('name', name);
            formData.append('description', description);
            formData.append('price', price);
            formData.append('condition', condition);
            formData.append('image', $('#image')[0].files[0]);
            if (name == '' || description == '' || price == '' || condition == '') {
                alertas('Todo los campos son obligatorios', 'warning');
            } else {
                const frm = document.getElementById("frmPlan");
                let type, url;
                console.log('id: ', id);
                if (id == '') {
                    type = 'post';
                    url = `${api_admin_url}/plans`;
                } else {
                    type = 'post';
                    url = `${api_admin_url}/plans/${id}`;
                }
                $.ajax({
                    type,
                    url,
                    headers: {
                        'Authorization': `Bearer ${token}`,
                    },
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('response', response);
                        alertas(response.message, 'success');
                        tablaPlanes.ajax.reload();
                        frm.reset();
                        $('#planModal').modal('hide');
                    }
                });
            }
        }

        $('#tablaPlanes').on('click', '.update-status', function () {
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
                text: "El plan se cambiara de estado",
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
                        url: `${api_admin_url}/plans/status/${id}`,
                        headers: {
                            'Authorization': `Bearer ${token}`,
                        },
                        data: {
                            status: new_status
                        },
                        dataType: "json",
                        success: function(response) {
                            tablaPlanes.ajax.reload();
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
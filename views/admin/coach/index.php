<?php

require_once realpath(__DIR__ . "/../../../core/ViewHelpers.php");

startSection('title'); ?>
    Entrenadores
<?php endSection(); ?>
<?php startSection('content'); ?>
    <button class="btn btn-outline-primary mb-2" type="button" id="addModal"><i class="fas fa-plus"></i></button>

    <div class="card shadow-lg">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover display responsive nowrap" id="tablaEntrenadores" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Tipo de Documento</th>
                            <th>Nro de Documento</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
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

    <div class="modal fade" id="coachModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frmCliente" onsubmit="save(event);" autocomplete="off">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <input type="hidden" id="id" name="id">
                                    <label for="document_type"><i class="fas fa-id-card"></i> Tipo de Documento</label>
                                    <select class="form-control" id="document_type">
                                        <option value="1">DNI</option>
                                        <option value="4">CARNÉ DE EXTRANJERÍA</option>
                                        <option value="6">RUC</option>
                                        <option value="7">PASAPORTE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="document_number"><i class="fas fa-id-card"></i> Número de Documento</label>
                                    <input id="document_number" class="form-control" type="number" name="dni" placeholder="Número de Documento">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name"><i class="fas fa-list"></i> Nombres</label>
                                    <input id="name" class="form-control" type="text" name="nombre" placeholder="Nombres del cliente" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="paternal_surname"><i class="fas fa-list"></i> Apellido Paterno</label>
                                    <input id="paternal_surname" class="form-control" type="text" placeholder="Apellido Paterno" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="maternal_surname"><i class="fas fa-list"></i> Apellido Materno</label>
                                    <input id="maternal_surname" class="form-control" type="text" placeholder="Apellido Materno" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="email"><i class="fas fa-home"></i> Correo</label>
                                    <input id="email" class="form-control" type="text" name="address" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="phone"><i class="fas fa-phone"></i> Teléfono</label>
                                    <input id="phone" class="form-control" type="number" name="telefono" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="address"><i class="fas fa-list"></i> Dirección</label>
                                    <input id="address" class="form-control" type="text" name="nombre" required>
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
        var tablaEntrenadores;
        const api_admin_url = "<?php echo $_ENV['API_ADMIN_URL']; ?>";
        const token = localStorage.getItem('token');

        tablaEntrenadores = $('#tablaEntrenadores').DataTable({
            responsive: true,
            processing: true,
            serverSide: false,
            ajax: {
                url: `${api_admin_url}/coaches`,
                dataSrc: '',
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
            },
            columns: [
                { 'data': 'id' },
                {
                    data: 'document_type',
                    render: function (data) {
                        if (data == 1) {
                            return `DNI`;
                        }
                        if (data == 4) {
                            return `FOREIGNER CARD`;
                        }
                        if (data == 6) {
                            return `RUC`;
                        }
                        if (data == 7) {
                            return `PASSPORT`;
                        }
                    }
                },
                { 'data': 'document_number' },
                { 'data': 'name' },
                { 'data': 'phone' },
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
            document.getElementById("title").textContent = "Nuevo Entrenador";
            document.getElementById("btnAccion").textContent = "Registrar";
            document.getElementById("frmCliente").reset();
            document.getElementById("id").value = "";
            $('#coachModal').modal('show');
        });

        function editModal(id) {
            document.getElementById("title").textContent = "Actualizar cliente";
            document.getElementById("btnAccion").textContent = "Modificar";

            $.ajax({
                type: "get",
                url: `${api_admin_url}/coaches/${id}`,
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
                dataType: "json",
                success: function(response) {
                    document.getElementById("id").value = response.id;
                    document.getElementById("document_type").value = response.document_type;
                    document.getElementById("document_number").value = response.document_number;
                    document.getElementById("name").value = response.name;
                    document.getElementById("paternal_surname").value = response.paternal_surname;
                    document.getElementById("maternal_surname").value = response.maternal_surname;
                    document.getElementById("email").value = response.email;
                    document.getElementById("phone").value = response.phone;
                    document.getElementById("address").value = response.address;
                    $('#coachModal').modal('show');
                }
            });
        }

        function save(e) {
            e.preventDefault();
            const id = document.getElementById("id").value;
            const document_type = document.getElementById("document_type").value;
            const document_number = document.getElementById("document_number").value;
            const name = document.getElementById("name").value;
            const paternal_surname = document.getElementById("paternal_surname").value;
            const maternal_surname = document.getElementById("maternal_surname").value;
            const email = document.getElementById("email").value;
            const phone = document.getElementById("phone").value;
            const address = document.getElementById("address").value;
            if (document_number == '' || name == '' || paternal_surname == '' || maternal_surname == '' || phone == '' || address == '') {
                alertas('Todo los campos son obligatorios', 'warning');
            } else {
                const frm = document.getElementById("frmCliente");
                let type, url;
                console.log('id: ', id);
                if (id == '') {
                    type = 'post';
                    url = `${api_admin_url}/coaches`;
                } else {
                    type = 'put';
                    url = `${api_admin_url}/coaches/${id}`;
                }
                $.ajax({
                    type,
                    url,
                    headers: {
                        'Authorization': `Bearer ${token}`,
                    },
                    data: {
                        document_type,
                        document_number,
                        name,
                        paternal_surname,
                        maternal_surname,
                        email,
                        phone,
                        address
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log('response', response);
                        alertas(response.message, 'success');
                        tablaEntrenadores.ajax.reload();
                        frm.reset();
                        $('#coachModal').modal('hide');
                    }
                });
            }
        }

        $('#tablaEntrenadores').on('click', '.update-status', function () {
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
                text: "El usuario se cambiara de estado",
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
                        url: `${api_admin_url}/coaches/status/${id}`,
                        headers: {
                            'Authorization': `Bearer ${token}`,
                        },
                        data: {
                            status: new_status
                        },
                        dataType: "json",
                        success: function(response) {
                            tablaEntrenadores.ajax.reload();
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
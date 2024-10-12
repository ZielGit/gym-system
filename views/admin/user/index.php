<?php

require_once realpath(__DIR__ . "/../../../core/ViewHelpers.php");

startSection('title'); ?>
    Usuarios
<?php endSection(); ?>
<?php startSection('content'); ?>
    <button class="btn btn-outline-primary mb-2" type="button" id="addModal"><i class="fas fa-plus"></i></button>

    <div class="card shadow-lg">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover display responsive nowrap" id="tablaUsuarios" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Tipo de Documento</th>
                            <th>Nro de Documento</th>
                            <th>Nombre</th>
                            <th>Correo</th>
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

    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frmUser" onsubmit="save(event);" autocomplete="off">
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
                                    <label for="password"><i class="fas fa-list"></i> Password</label>
                                    <input id="password" class="form-control" type="password" name="password" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="phone"><i class="fas fa-phone"></i> Teléfono</label>
                                    <input id="phone" class="form-control" type="number" name="telefono" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-camera"></i> Foto de Perfil (Opcional)</label>
                                    <input id="profile_photo" class="form-control" type="file" name="profile_photo">
                                    <img class="img-thumbnail mt-2 current_profile_photo" src="" alt="Profile Photo">
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
        var tablaUsuarios;

        tablaUsuarios = $('#tablaUsuarios').DataTable({
            responsive: true,
            processing: true,
            serverSide: false,
            ajax: {
                url: `${api_admin_url}/users`,
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
                { 'data': 'email' },
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
            document.getElementById("title").textContent = "Nuevo Usuario";
            document.getElementById("btnAccion").textContent = "Registrar";
            document.getElementById("frmUser").reset();
            document.getElementById("id").value = "";
            $('#userModal').modal('show');
        });

        function editModal(id) {
            document.getElementById("title").textContent = "Actualizar usuario";
            document.getElementById("btnAccion").textContent = "Modificar";

            $.ajax({
                type: "get",
                url: `${api_admin_url}/users/${id}`,
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
                    if (response.profile_photo_url != null) {
                        $('.current_profile_photo').attr("src", response.profile_photo_url);
                    } else {
                        $('.current_profile_photo').attr("src", '/images/user.png');
                    }
                    $('#userModal').modal('show');
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
            const password = document.getElementById("password").value;

            var formData = new FormData();
            formData.append('document_type', document_type);
            formData.append('document_number', document_number);
            formData.append('name', name);
            formData.append('paternal_surname', paternal_surname);
            formData.append('maternal_surname', maternal_surname);
            formData.append('email', email);
            formData.append('phone', phone);
            formData.append('password', password);
            formData.append('profile_photo', $('#profile_photo')[0].files[0]);
            if (document_number == '' || name == '' || paternal_surname == '' || maternal_surname == '') {
                alertas('Todo los campos son obligatorios', 'warning');
            } else {
                const frm = document.getElementById("frmUser");
                let type, url;
                if (id == '') {
                    type = 'post';
                    url = `${api_admin_url}/users`;
                } else {
                    type = 'post';
                    url = `${api_admin_url}/users/${id}`;
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
                        alertas(response.message, 'success');
                        tablaUsuarios.ajax.reload();
                        frm.reset();
                        $('#userModal').modal('hide');
                    }
                });
            }
        }

        $('#tablaUsuarios').on('click', '.update-status', function () {
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
                        url: `${api_admin_url}/users/status/${id}`,
                        headers: {
                            'Authorization': `Bearer ${token}`,
                        },
                        data: {
                            status: new_status
                        },
                        dataType: "json",
                        success: function(response) {
                            tablaUsuarios.ajax.reload();
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
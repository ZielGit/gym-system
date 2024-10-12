<?php

require_once realpath(__DIR__ . "/../../../core/ViewHelpers.php");

startSection('title'); ?>
    Usuario Perfil
<?php endSection(); ?>
<?php startSection('content'); ?>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Datos</h4>
                    </div>
                    <ul class="list-group list-group-flush">
                        <form onsubmit="save(event);">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
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
                                        <input id="document_number" class="form-control" type="number" name="dni">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="paternal_surname"><i class="fas fa-list"></i> Apellido Paterno</label>
                                        <input id="paternal_surname" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="maternal_surname"><i class="fas fa-list"></i> Apellido Materno</label>
                                        <input id="maternal_surname" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name"><i class="fas fa-list"></i> Nombre</label>
                                        <input id="name" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email"><i class="fas fa-envelope"></i> Correo</label>
                                        <input id="email" class="form-control" type="email" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="phone"><i class="fas fa-phone"></i> Teléfono</label>
                                        <input id="phone" class="form-control" type="number" name="telefono">
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2 mt-2">
                                <button class="btn btn-outline-primary" type="submit">Modificar</button>
                            </div>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-lg-6 col-md-6 col-sm-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Modificar Contraseña</h4>
                    </div>
                    <form id="frmCambiarPass" onsubmit="frmCambiarPass(event);">
                        <div class="form-group mb-3">
                            <label for="old_password"><i class="fas fa-key"></i> Contraseña Actual</label>
                            <input id="old_password" class="form-control" type="password" name="old_password" placeholder="Contraseña Actual" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="new_password"><i class="fas fa-lock"></i> Contraseña Nueva</label>
                            <input id="new_password" class="form-control" type="password" name="new_password" placeholder="Contraseña Nueva" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="confirm_password"><i class="fas fa-unlock"></i> Confirmar Contraseña</label>
                            <input id="confirm_password" class="form-control" type="password" name="confirm_password" placeholder="Confirmar Contraseña" required>
                        </div>
                        <div class="d-grid gap-2 mt-2">
                            <button class="btn btn-outline-primary" type="submit">Modificar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endSection(); ?>
<?php startSection('scripts'); ?>
    <script>
        $.ajax({
            type: "get",
            url: `${api_admin_url}/users/${user_id}`,
            headers: {
                'Authorization': `Bearer ${token}`,
            },
            dataType: "json",
            success: function(response) {
                document.getElementById("document_type").value = response.document_type;
                document.getElementById("document_number").value = response.document_number;
                document.getElementById("name").value = response.name;
                document.getElementById("paternal_surname").value = response.paternal_surname;
                document.getElementById("maternal_surname").value = response.maternal_surname;
                document.getElementById("email").value = response.email;
                document.getElementById("phone").value = response.phone;
            }
        });

        function save(e) {
            e.preventDefault();
            const document_type = document.getElementById("document_type").value;
            const document_number = document.getElementById("document_number").value;
            const name = document.getElementById("name").value;
            const paternal_surname = document.getElementById("paternal_surname").value;
            const maternal_surname = document.getElementById("maternal_surname").value;
            const email = document.getElementById("email").value;
            const phone = document.getElementById("phone").value;
            if (document_number == '' || name == '' || paternal_surname == '' || maternal_surname == '') {
                alertas('Todo los campos son obligatorios', 'warning');
            } else {
                $.ajax({
                    type: "put",
                    url: `${api_admin_url}/users/${user_id}`,
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
                        phone
                    },
                    dataType: "json",
                    success: function(response) {
                        alertas(response.message, 'success');
                    }
                });
            }
        }

        function frmCambiarPass(e) {
            e.preventDefault();
            const old_password = document.getElementById('old_password').value;
            const new_password = document.getElementById('new_password').value;
            const confirm_password = document.getElementById('confirm_password').value;
            if (old_password == '' || new_password == '' || confirm_password == '') {
                alertas('Todo los campos son obligatorios', 'warning');
                return false;
            } else {
                if (new_password != confirm_password) {
                    alertas('Las contraseñas no coinciden', 'warning');
                    return false;
                } else {
                    $.ajax({
                        type: "put",
                        url: `${api_admin_url}/users/password/${user_id}`,
                        headers: {
                            'Authorization': `Bearer ${token}`,
                        },
                        data: {
                            old_password,
                            new_password
                        },
                        dataType: "json",
                        success: function (response) {
                            alertas(response.message, 'success');
                            frm.reset();
                        },
                        error: function(xhr) {
                            alertas(xhr.responseJSON.message, 'error');
                        }
                    });
                }
            }
        }
    </script>
<?php endSection(); ?>
<?php

// Incluir el layout
include realpath(__DIR__ . "/../layouts/app.php");
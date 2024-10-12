<?php

require_once realpath(__DIR__ . "/../../../core/ViewHelpers.php");

startSection('title'); ?>
    Empresa
<?php endSection(); ?>

<?php startSection('content'); ?>
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="card-title">
                <h5>Empresa</h5>
            </div>
            <form id="frmEmpresa" onsubmit="modificarEmpresa(event)" autocomplete="off">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <input id="id" class="form-control" type="hidden" name="id" value="1">
                            <label for="ruc"><i class="fas fa-id-card"></i> Ruc</label>
                            <input id="ruc" class="form-control" type="number" name="ruc" placeholder="Ruc" min="0" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                        <label for="name"><i class="fas fa-list"></i> Razón Social</label>
                            <input id="name" class="form-control" type="text" name="name" placeholder="Nombre" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                        <label for="phone"><i class="fas fa-phone"></i> Teléfono</label>
                            <input id="phone" class="form-control" type="text" name="phone" placeholder="Teléfono">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group mb-3">
                        <label for="email"><i class="fas fa-envelope"></i> Correo</label>
                            <input id="email" class="form-control" type="text" name="email" placeholder="Correo Electrónico">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group mb-3">
                        <label for="tax_domicile"><i class="fas fa-home"></i> Domicilio Fiscal</label>
                            <input id="tax_domicile" class="form-control" type="text" name="tax_domicile" placeholder="Dirección" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><i class="fas fa-image"></i> Logo</label>
                            <input id="logo_path" class="form-control" type="file" name="logo_path">
                            <img class="img-thumbnail img-logo" src="" alt="LOGO-PNG">
                        </div>
                    </div>
                </div>
                    <div class="d-grid gap-2 my-3">
                        <button class="btn btn-outline-primary" type="submit" id="btnAccion">Modificar</button>
                    </div>
            </form>
        </div>
    </div>
<?php endSection(); ?>
<?php startSection('scripts'); ?>
    <script>
        const id = document.getElementById("id").value;

        $.ajax({
            type: "get",
            url: `${api_admin_url}/companies/${id}`,
            headers: {
                'Authorization': `Bearer ${token}`,
            },
            dataType: "json",
            success: function (response) {
                document.getElementById("ruc").value = response.ruc;
                document.getElementById("name").value = response.name;
                document.getElementById("phone").value = response.phone;
                document.getElementById("email").value = response.email;
                document.getElementById("tax_domicile").value = response.tax_domicile;
                if (response.logo_path != null) {
                    $('.img-logo').attr("src", response.logo_path);
                } else {
                    $('.img-logo').attr("src", '/novena/images/logo.png');
                }
            }
        });

        function modificarEmpresa(e) {
            e.preventDefault();
            const ruc = document.getElementById("ruc").value;
            const name = document.getElementById("name").value;
            const phone = document.getElementById("phone").value;
            const email = document.getElementById("email").value;
            const tax_domicile = document.getElementById("tax_domicile").value;

            if (ruc == '' || name == '' || tax_domicile == '') {
                alertas('Todo los campos son requerido', 'warning');
                return false;
            } else {
                var formData = new FormData();
                formData.append('ruc', ruc);
                formData.append('name', name);
                formData.append('phone', phone);
                formData.append('email', email);
                formData.append('tax_domicile', tax_domicile);
                formData.append('logo_path', $('#logo_path')[0].files[0]);
                console.log([...formData]);
                document.getElementById('btnAccion').textContent = 'Procesando...';
                $.ajax({
                    type: "post",
                    url: `${api_admin_url}/companies/${id}`,
                    headers: {
                        'Authorization': `Bearer ${token}`,
                    },
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        document.getElementById('btnAccion').textContent = 'Modificar';
                        alertas(response.message, 'success');
                    },
                    error: function(xhr) {
                        document.getElementById('btnAccion').textContent = 'Modificar';
                    }
                });
            }
        }
    </script>
<?php endSection(); ?>
<?php

// Incluir el layout
include realpath(__DIR__ . "/../layouts/app.php");
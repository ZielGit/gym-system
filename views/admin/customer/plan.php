<?php

require_once realpath(__DIR__ . "/../../../core/ViewHelpers.php");

startSection('title'); ?>
    Clientes - Plan
<?php endSection(); ?>
<?php startSection('content'); ?>
    <button class="btn btn-outline-info mb-2" type="button" data-toggle="modal" data-target="#modalPago">Agregar Pago</button>

    <div class="card shadow-lg">
        <div class="card-body">
            <form id="formulario" onsubmit="register(event)">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group mb-3">
                            <label for="customers"><i class="fas fa-users"></i> Buscar Cliente</label>
                            <input type="hidden" id="customer_id" name="customer_id" required>
                            <input type="text" id="customers" placeholder="Buscar..." class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group mb-3">
                            <label for="buscar_planes"><i class="fas fa-lista"></i> Buscar Plan</label>
                            <input type="hidden" id="plan_id" name="plan_id" required>
                            <input type="text" id="buscar_planes" class="form-control" placeholder="Buscar..." required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group mb-3">
                            <label for="precio_plan"><i class="fas fa-dollar-sign"></i> Precio Plan</label>
                            <input type="text" id="precio_plan" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="d-grid gap-2">
                            <label for="">Accion</label>
                            <button class="btn btn-outline-primary btn-block" type="submit"><i class="fas fa-sign-in-alt"></i><span id="btnAccion"> Procesar</span></button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row mb-2">
                <div class="col-md-4">
                    <label for="min">Desde</label>
                    <input class="form-control" id="min" type="date" name="plan_min">
                </div>
                <div class="col-md-4">
                    <label for="max">Hasta</label>
                    <input class="form-control" id="max" type="date" name="plan_max">
                </div>
            </div>
            <div class="table-responsive my-2">
                <table class="table table-striped table-hover display responsive nowrap" id="tablaPlanCliente" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>F. registro</th>
                            <th>N° Doc.</th>
                            <th>Cliente</th>
                            <th>Plan</th>
                            <th>P. Plan</th>
                            <th>F. Venc.</th>
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

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Pago</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <input class="form-control" id="cliente" type="text" readonly>
                        <input type="hidden" id="id">
                        <label for="cliente" class="form-label">Cliente</label>
                    </div>
                    <div class="form-group mb-3">
                        <input class="form-control" id="plan" type="text" readonly>
                        <label for="plan" class="form-label">Plan</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-outline-primary" onclick="generarPago();">Pagar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPago" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Pago</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frmPago" onsubmit="registrarPago(event)" autocomplete="off">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <input type="hidden" id="id_planCliente" name="id_planCliente" required>
                                    <label for="nombre_cliente"><i class="fas fa-users"></i> Buscar Cliente</label>
                                    <input type="text" id="nombre_cliente" class="form-control" placeholder="Buscar..." required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nombre_plan"><i class="fas fa-users"></i> Plan</label>
                                    <input type="text" id="nombre_plan" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="vencimiento"><i class="fas fa-users"></i> Vencimiento</label>
                                    <input type="text" id="vencimiento" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="precio"><i class="fas fa-users"></i> Precio Plan</label>
                                    <input type="text" id="precio" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-primary" type="submit">Procesar Pago</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endSection(); ?>
<?php startSection('scripts'); ?>
    <script>
        tablaPlanCliente = $('#tablaPlanCliente').DataTable({
            responsive: true,
            processing: true,
            serverSide: false,
            ajax: {
                url: `${api_admin_url}/plans/customer`,
                dataSrc: '',
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
            },
            columns: [
                { 'data': 'id' },
                { 'data': 'date' },
                { 'data': 'customer.document_number' },
                { 'data': 'customer.name' },
                { 'data': 'plan.name' },
                { 'data': 'plan.price' },
                { 'data': 'due_date' },
                {
                    data: 'id',
                    render: function (data, type, full) {
                        if (full.status == 1) {
                            return `<span class="badge bg-success">Activo</span>`
                        } else {
                            return `<span class="badge bg-danger">Desabilitado</span>`;
                        }
                    }
                },
                {
                    data: 'id',
                    render: function (data, type, full) {
                        if (full.status == 1) {
                            return `<div>
                                <button class="btn btn-outline-primary" type="button"><i class="fas fa-dollar-sign"></i></button>
                                <a class="btn btn-outline-danger" href="#"><i class="fas fa-eye"></i></a>
                                <button class="btn btn-outline-warning" type="button"><i class="fas fa-ban"></i></button>
                            </div>`
                        } else {
                            return `<a class="btn btn-outline-danger" href="#"><i class="fas fa-eye"></i></a>`;
                        }
                    }
                }
            ],
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
            },
            createdRow: function (row, data, index) {
                //pintar una celda
                if (data.fecha_venc < data.fecha_actual) {
                    $('td', row).eq(6).html('<span class="badge bg-danger">' + data.fecha_venc + '</span>');
                }
                if (data.fecha_venc < data.fecha_actual) {
                    $('td', row).css({
                        'background-color': '#ffff52'
                    });
                }
            },
            resonsieve: true,
            bDestroy: true,
            iDisplayLength: 10,
            order: [
                [0, "desc"]
            ]
        });

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
                if (document.getElementById('select_plan')) {
                    buscarPlanCli(ui.item.id);
                }
            }
        });

        // $("#nombre_cliente").autocomplete({
        //     minLength: 2,
        //     source: function (request, response) {
        //         $.ajax({
        //             url: base_url + 'clientes/buscarCliente',
        //             dataType: "json",
        //             data: {
        //                 plan: request.term
        //             },
        //             success: function (data) {
        //                 response(data);
        //             }
        //         });
        //     },
        //     select: function (event, ui) {
        //         document.getElementById('id_planCliente').value = ui.item.id;
        //         document.getElementById('nombre_plan').value = ui.item.plan;
        //         document.getElementById('precio').value = ui.item.precio;
        //         document.getElementById('vencimiento').value = ui.item.vencimiento;
        //     }
        // });

        $("#buscar_planes").autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    url: `${api_admin_url}/plans`,
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
                                id: item.id,
                                label: item.name,
                                price: item.price
                            };
                        })
                        response(results);
                    }
                });
            },
            select: function (event, ui) {
                document.getElementById('plan_id').value = ui.item.id;
                // document.getElementById('buscar_planes').value = ui.item.plan;
                document.getElementById('precio_plan').value = ui.item.price;
            }
        });

        function register(e) {
            e.preventDefault();
            const customer_id = document.getElementById("customer_id").value;
            const plan_id = document.getElementById("plan_id").value;
            const customer = document.getElementById("customers").value;
            const plan = document.getElementById("buscar_planes").value;
            const due_date = document.getElementById("min").value;
            const limit_date = document.getElementById("max").value;
            if (customer_id == '' || plan_id == '' || customer == '' || plan == '') {
                alertas('Todo los campos son obligatorios', 'warning');
            } else {
                const frm = document.getElementById("formulario");
                $.ajax({
                    type: "post",
                    url: `${api_admin_url}/plans/customer`,
                    headers: {
                        'Authorization': `Bearer ${token}`,
                    },
                    data: {
                        customer_id,
                        plan_id,
                        due_date,
                        limit_date,
                        user_id
                    },
                    dataType: "json",
                    success: function (response) {
                        alertas(response.message, 'success');
                        frm.reset();
                        tablaPlanCliente.ajax.reload();
                    }
                });
            }
        }
    </script>
<?php endSection(); ?>
<?php

// Incluir el layout
include realpath(__DIR__ . "/../layouts/app.php");
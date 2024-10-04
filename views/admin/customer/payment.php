<?php

require_once realpath(__DIR__ . "/../../../core/ViewHelpers.php");

startSection('title'); ?>
    Clientes - Ver Pagos
<?php endSection(); ?>
<?php startSection('content'); ?>
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-4">
                    <label for="">Desde</label>
                    <input class="form-control" id="min" type="date" name="pagos_min">
                </div>
                <div class="col-md-4">
                    <label for="">Hasta</label>
                    <input class="form-control" id="max" type="date" name="pagos_max">
                </div>
                <div class="col-md-4">
                    <div class="d-grid">
                        <label>Acción</label> <br>
                        <button class="btn btn-outline-primary" type="button" name="pagos" onclick="mostrarTodo(event)">Limpiar</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive my-2">
                <table class="table table-striped table-hover display responsive nowrap" id="tablaPago" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Fecha de Pago</th>
                            <th>Cliente</th>
                            <th>Plan</th>
                            <th>Precio</th>
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
<?php endSection(); ?>
<?php startSection('scripts'); ?>
    <script>
        tablaPago = $('#tablaPago').DataTable({
            responsive: true,
            processing: true,
            serverSide: false,
            ajax: {
                url: `${api_admin_url}/payments`,
                dataSrc: '',
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
            },
            columns: [
                { 'data': 'id' },
                {
                    'data': 'date'
                },
                {
                    'data': 'customer.name'
                },
                {
                    'data': 'plan.name'
                },
                {
                    'data': 'price'
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
            bDestroy: true,
            iDisplayLength: 10,
            order: [
                [0, "desc"]
            ]
        });
    </script>
<?php endSection(); ?>
<?php

// Incluir el layout
include realpath(__DIR__ . "/../layouts/app.php");
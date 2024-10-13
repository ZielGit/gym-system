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
                        <button class="btn btn-outline-primary" type="button" name="pagos" onclick="limpiar(event)">Limpiar</button>
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
                            return `<button type="button" class="btn btn-inverse-success btn-fw">Pagado</button>`;
                        } else {
                            return `<button type="button" class="btn btn-inverse-danger btn-fw" disabled>Reenbolso</button>`;
                        }
                    }
                },
                {
                    data: 'id',
                    render: function (data) {
                        return `<button type="button" class="btn btn-outline-info invoice-pdf" data-id="${data}"><i class="fas fa-file-pdf"></i></button>`;
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

        $('#min').change(function () {
            tablaPago.draw();
        });

        $('#max').change(function () {
            tablaPago.draw();
        });

        if (document.getElementById('min') && document.getElementById('max')) {
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    let desde = $('#min').val();
                    let hasta = $('#max').val();
                    let fecha_registro = data[1].trim();
                    if (desde == '' || hasta == '') {
                        return true;
                    }
                    if (fecha_registro >= desde && fecha_registro <= hasta) {
                        return true;
                    } else {
                        return false;
                    }
                }
            );
        }

        function limpiar(e) {
            document.getElementById('min').value = '';
            document.getElementById('max').value = '';
            tablaPago.draw();
        }

        $('#tablaPago').on('click', '.invoice-pdf', function () {
            var id =  $(this).data('id');
            $.ajax({
                type: "get",
                url: `${api_admin_url}/customers/payment/${id}/pdf`,
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (response) {
                    // Crear un blob a partir de la respuesta
                    var blob = new Blob([response], { type: 'application/pdf' });

                    // Crear una URL para el blob
                    var blobUrl = URL.createObjectURL(blob);

                    // Abrir el PDF en una nueva pestaña
                    window.open(blobUrl, '_blank');
                },
                error: function (xhr, status, error) {
                    console.error('Error al generar el PDF:', error);
                }
            });
        });
    </script>
<?php endSection(); ?>
<?php

// Incluir el layout
include realpath(__DIR__ . "/../layouts/app.php");
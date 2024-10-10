<?php

// Incluir helpers
require_once realpath(__DIR__ . "/../../core/ViewHelpers.php");

startSection('title'); ?>
    Dashboard
<?php endSection(); ?>

<?php startSection('content'); ?>
    <div class="row grid-margin">
        <div class="col-12">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="statistics-item">
                            <p><i class="icon-sm fa fa-user mr-2"></i> Usuarios</p>
                            <h2 id="users"></h2>
                        </div>
                        <div class="statistics-item">
                            <p><i class="icon-sm fas fa-users mr-2"></i> Clientes</p>
                            <h2 id="customers"></h2>
                        </div>
                        <div class="statistics-item">
                            <p><i class="icon-sm fas fa-list-alt mr-2"></i> Planes</p>
                            <h2 id="plans"></h2>
                        </div>
                        <div class="statistics-item">
                            <p><i class="icon-sm fas fa-check-circle mr-2"></i> Entrenadores</p>
                            <h2 id="coaches"></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-xl-6 col-md-6 col-sm-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="card-title">
                        <h6>Reporte Grafico de Ingreso por Mes
                            <select id="year" class="float-end" onchange="actualizarGrafico()">
                                <?php
                                $fecha = date('Y');
                                for ($i = 2021; $i <= $fecha; $i++) { ?>
                                <option value="<?php echo $i; ?>" <?php echo ($i == $fecha) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </h6>
                    </div>
                    <canvas id="ProductosVendidos"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 col-sm-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="card-title">
                        <h6>Ingreso por Día</h6>
                    </div>
                    <canvas id="ventaDia"></canvas>
                </div>
            </div>
        </div>
    </div>
<?php endSection(); ?>
<?php startSection('scripts'); ?>
    <script>
        $.ajax({
            type: "get",
            url: `${api_admin_url}/dashboard`,
            headers: {
                'Authorization': `Bearer ${token}`,
            },
            dataType: "json",
            success: function (response) {
                $('#users').text(response.users);
                $('#customers').text(response.customers);
                $('#plans').text(response.plans);
                $('#coaches').text(response.coaches);
            }
        });

        if (document.getElementById('ProductosVendidos')) {
            actualizarGrafico();
            ventasDia();
        }

        function actualizarGrafico() {
            const anio = document.getElementById('year').value;
            let ctx = document.getElementById('ProductosVendidos').getContext('2d');
            if (myChart) {
                myChart.destroy();
            }
            $.ajax({
                type: "get",
                url: `${api_admin_url}/dashboard/products-sold/${user_id}`,
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
                data: {
                    anio
                },
                dataType: "json",
                success: function (response) {
                    myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                            datasets: [{
                                label: 'Ingreso por Mes',
                                data: [response.ene, response.feb, response.mar, response.abr, response.may, response.jun, response.jul, response.ago, response.sep, response.oct, response.nov, response.dic],
                                backgroundColor: [
                                    'rgb(255, 202, 240)'
                                ]
                            }]
                        },
                        options: {
                            indexAxis: 'x',
                            elements: {
                                bar: {
                                    borderWidth: 2,
                                }
                            },
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: false,
                                    text: 'Pagos por Mes'
                                }
                            }
                        },
                    });
                }
            });
        }

        function ventasDia() {
            let ctx = document.getElementById('ventaDia').getContext('2d');
            $.ajax({
                type: "get",
                url: `${api_admin_url}/dashboard/sales/${user_id}`,
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
                dataType: "json",
                success: function (response) {
                    let nombre = [];
                    let cantidad = [];
                    for (let i = 0; i < response.length; i++) {
                        nombre.push(response[i].name);
                        cantidad.push(response[i].total);
                    }
                    let my_Chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: nombre,
                            datasets: [{
                                label: 'Ingreso por Día',
                                data: cantidad,
                                backgroundColor: [
                                    'rgb(200, 0, 00)'
                                ]
                            }]
                        },
                        options: {
                            indexAxis: 'x',
                            elements: {
                                bar: {
                                    borderWidth: 2,
                                }
                            },
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Ventas por Día'
                                }
                            }
                        },
                    });
                }
            });
        }
    </script>
<?php endSection(); ?>
<?php

// Incluir el layout
include realpath(__DIR__ . "/layouts/app.php");
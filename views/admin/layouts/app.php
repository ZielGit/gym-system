<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gimnasio - <?php yieldContent('title'); ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/melody/vendors/iconfonts/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="/melody/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/melody/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="/melody/css/style.css">
    <link rel="stylesheet" href="/melody/css/snackbar.min.css">
    <link href="/melody/css/jquery-ui.min.css" rel="stylesheet" />
    <?php yieldContent('styles'); ?>
    <!-- endinject -->
    <link rel="shortcut icon" href="/melody/images/favicon-32x32.png" />
</head>
<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php includePartial('admin.partials.navbar'); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <?php includePartial('admin.partials.sidebar'); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <?php yieldContent('content'); ?>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?php includePartial('admin.partials.footer'); ?>
            <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="/melody/vendors/js/vendor.bundle.base.js"></script>
    <script src="/melody/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="/melody/js/off-canvas.js"></script>
    <script src="/melody/js/hoverable-collapse.js"></script>
    <script src="/melody/js/misc.js"></script>
    <script src="/melody/js/jquery-ui.min.js"></script>
    <script src="/melody/js/snackbar.min.js"></script>
    <!-- endinject -->
    <script src="/melody/js/sweetalert2.all.min.js"></script>
    <script src="/melody/js/chart.min.js"></script>
    <script src="/melody/js/funciones.js"></script>
    <script>
        const api_admin_url = "<?php echo $_ENV['API_ADMIN_URL']; ?>";
        const token = localStorage.getItem('token');

        // if (!accessToken) {
        //     location.href = '/';
        // }

        // $.ajaxSetup({
        //     headers: {
        //         'Authorization': `Bearer ${token}`,
        //     },
        // });

        var user = JSON.parse(localStorage.getItem('user'));
        const user_id = user.id;
        const user_name = user.name;
        const user_email = user.email;
        $('.user-name').html(user_name);
        $('.user-email').html(user_email);

        $('#logout').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: `${api_admin_url}/logout`,
                dataType: "json",
                success: function(response) {
                    console.log('response', response);
                    localStorage.removeItem('token');
                    localStorage.removeItem('user');
                    location.href = '/';
                }
            });
        });

        function alertas(mensaje, icono) {
            Snackbar.show({
                text: mensaje,
                pos: 'top-right',
                backgroundColor: icono == 'success' ? '#079F00' : '#FF0303',
                actionText: 'Cerrar'
            });
        }
    </script>
    <?php yieldContent('scripts'); ?>
</body>
</html> 
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gimnasio - <?php yieldContent('title'); ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/assets/vendors/iconfonts/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/assets/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/snackbar.min.css">
    <link href="/assets/css/jquery-ui.min.css" rel="stylesheet" />
    <?php yieldContent('styles'); ?>
    <!-- endinject -->
    <link rel="shortcut icon" href="/assets/images/favicon-32x32.png" />
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
    <script src="/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="/assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="/assets/js/off-canvas.js"></script>
    <script src="/assets/js/hoverable-collapse.js"></script>
    <script src="/assets/js/misc.js"></script>
    <script src="/assets/js/jquery-ui.min.js"></script>
    <script src="/assets/js/snackbar.min.js"></script>
    <!-- endinject -->
    <script src="/assets/js/sweetalert2.all.min.js"></script>
    <script src="/assets/js/chart.min.js"></script>
    <script src="/assets/js/funciones.js"></script>
    <script>
        $('#logout').click(function(e) {
            e.preventDefault();

            $.ajax({
                type: "get",
                url: '/api/logout',
                dataType: "json",
                success: function(response) {
                    console.log('response', response);
                    localStorage.removeItem('token');
                    location.href = '/';
                }
            });
        });
    </script>
    <?php yieldContent('scripts'); ?>
</body>
</html> 
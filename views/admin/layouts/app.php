<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gimnasio - <?php yieldContent('title'); ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.2.0/css/all.min.css">
    <link rel="stylesheet" href="/melody/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/melody/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="/melody/css/style.css">
    <?php yieldContent('styles'); ?>
    <!-- endinject -->
    <link rel="shortcut icon" href="/melody/images/favicon.png" />
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
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        var user_name = user.name;
        var user_email = user.email;
        var user_profile_photo_url = user.profile_photo_url;

        $('.user-name').html(user_name);
        $('.user-email').html(user_email);
        if (user_profile_photo_url != null) {
            $('.user-profile-photo').attr("src", user_profile_photo_url);
        } else {
            $('.user-profile-photo').attr("src", '/images/user.png');
        }

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
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire({
                icon: icono,
                title: mensaje
            });
        }
    </script>
    <?php yieldContent('scripts'); ?>
    <!-- End custom js for this page-->
</body>
</html> 

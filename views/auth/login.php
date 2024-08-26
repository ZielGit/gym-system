<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Melody Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/assets/vendors/iconfonts/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="/assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="/assets/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/assets/images/favicon-32x32.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-4 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <img src="/assets/images/logo.png" alt="logo">
              </div>
              <h4>Welcome back!</h4>
              <h6 class="font-weight-light">Happy to see you again!</h6>
              <div class="alert alert-danger d-none" role="alert" id="alerta">
              </div>
              <div class="form-group">
                <label for="usuario">Email</label>
                <div class="input-group">
                  <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                      <i class="fa fa-user text-primary"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control form-control-lg border-left-0" id="email" placeholder="Email" name="email">
                </div>
              </div>
              <div class="form-group">
                <label for="clave">Password</label>
                <div class="input-group">
                  <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                      <i class="fa fa-lock text-primary"></i>
                    </span>
                  </div>
                  <input type="password" class="form-control form-control-lg border-left-0" id="password" placeholder="Password">
                </div>
              </div>
              <div class="my-3">
                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" id="login">LOGIN</button>
              </div>
            </div>
          </div>
          <div class="col-lg-8 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; <?php echo date('Y'); ?> All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="/assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="/assets/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="/assets/js/off-canvas.js"></script>
  <script src="/assets/js/hoverable-collapse.js"></script>
  <script src="/assets/js/misc.js"></script>
  <script src="/assets/js/sweetalert2.all.min.js"></script>
  <script>
    var token = localStorage.getItem('token');

    if (token) {
      console.log('Existe token');
    }

    $('#login').click(function(e) {
      e.preventDefault();

      $.ajax({
        type: "post",
        url: '/api/login',
        data: {
            email: $('#email').val(),
            password: $('#password').val()
        },
        dataType: "json",
        success: function(response) {
          console.log('response', response);
          localStorage.setItem('token', response.token);
          location.href = '/admin/dashboard';
        }
      });
    });
  </script>
  <!-- endinject -->
</body>
</html>
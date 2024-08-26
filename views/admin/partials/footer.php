</div>
<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date('Y'); ?>. All rights reserved.</span>
    </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="../Assets/vendors/js/vendor.bundle.base.js"></script>
<script src="../Assets/vendors/js/vendor.bundle.addons.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="../Assets/js/off-canvas.js"></script>
<script src="../Assets/js/hoverable-collapse.js"></script>
<script src="../Assets/js/misc.js"></script>
<script src="../Assets/js/jquery-ui.min.js"></script>
<script src="../Assets/js/snackbar.min.js"></script>
<!-- endinject -->
<script src="../Assets/js/sweetalert2.all.min.js"></script>
<script src="../Assets/js/chart.min.js"></script>
<script src="../Assets/js/funciones.js"></script>
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
</body>
</html>
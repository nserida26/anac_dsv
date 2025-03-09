<!DOCTYPE html>
<!--
   This is a starter template page. Use this page to start your new project from
   scratch. This page gets rid of all links and provides the needed markup only.
   -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $__env->yieldContent('title'); ?> | ANAC</title>
    <link href="<?php echo e(asset('assets/admin/imgs/logo.png')); ?>" rel="icon" type="image/png">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/fontawesome-free/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
    <?php echo $__env->yieldPushContent('css'); ?>
    <style>
        #scrollTopBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            border: none;
            outline: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 50%;
            font-size: 18px;
        }

        #scrollTopBtn:hover {
            background-color: #0056b3;
        }
    </style>
    <!-- Theme style -->


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/fonts/SansPro/SansPro.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/dist/css/adminlte.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/bootstrap-4.0.0-dist/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/mycustomstyle.css')); ?>">

</head>

<body class="fixed">

    <div class="wrapper">
        <!-- Navbar -->
        <?php echo $__env->make('admin.includes.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <?php echo $__env->make('admin.includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--  End Main Sidebar Container -->
        <!-- Content Wrapper. Contains page content -->
        <?php echo $__env->make('admin.includes.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- /.content-wrapper -->
        <?php echo $__env->make('admin.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Main Footer -->
    </div>
    <!-- ./wrapper -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Ready to Leave?')); ?></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-link" type="button" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>


                    <a href="<?php echo e(route('logout')); ?>" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <button id="scrollTopBtn" class="btn btn-primary" title="Retour en haut">
        <i class="fas fa-arrow-up"></i>
    </button>
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="<?php echo e(asset('assets/admin/plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo e(asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <!-- overlayScrollbars -->
    <script src="<?php echo e(asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('script'); ?>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('assets/admin/dist/js/adminlte.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/general.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('custom'); ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let scrollTopBtn = document.getElementById("scrollTopBtn");

            window.onscroll = function() {
                if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                    scrollTopBtn.style.display = "block";
                } else {
                    scrollTopBtn.style.display = "none";
                }
            };

            scrollTopBtn.onclick = function() {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            };
        });
    </script>

</body>

</html>
<?php /**PATH /Users/a/Documents/anac/resources/views/layouts/admin.blade.php ENDPATH**/ ?>
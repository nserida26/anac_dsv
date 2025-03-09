<!DOCTYPE html>
<!--
   This is a starter template page. Use this page to start your new project from
   scratch. This page gets rid of all links and provides the needed markup only.
   -->
<html lang="<?php echo e(LaravelLocalization::getCurrentLocale()); ?>"
    dir=<?php echo e(LaravelLocalization::getCurrentLocale() == 'ar' ? 'rtl' : 'ltr'); ?>>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $__env->yieldContent('title'); ?> | ANAC</title>
    <link href="<?php echo e(asset('assets/admin/imgs/logo.png')); ?>" rel="icon" type="image/png">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/fontawesome-free/css/all.min.css')); ?>">

    <?php echo $__env->yieldPushContent('css'); ?>
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/dist/css/adminlte.min.css')); ?>">
</head>

<body class="hold-transition layout-top-nav">

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">



            <!-- Right navbar links -->

            <ul class="<?php echo e(LaravelLocalization::getCurrentLocale() == 'fr' || LaravelLocalization::getCurrentLocale() == 'en' ? 'navbar-nav ml-auto' : 'navbar-nav'); ?>"
                >

                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- Rida -->
                        <img src="<?php echo e(asset('/assets/admin/imgs/default.png')); ?>"
                            class="img-profile rounded-circle avatar user-image" width="32px" height="32px"
                            alt="User Image" />

                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        
                        <?php $__currentLoopData = LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="dropdown-item <?php echo e(LaravelLocalization::getCurrentLocale() == $localeCode ? 'active' : ''); ?>"
                                rel="alternate" hreflang="<?php echo e($localeCode); ?>"
                                href="<?php echo e(LaravelLocalization::getLocalizedURL($localeCode, null, [], true)); ?>">
                                <i
                                    class="far fa-circle nav-icon <?php echo e(LaravelLocalization::getCurrentLocale() == $localeCode ? 'fas' : ''); ?>"></i>
                                <?php echo e($properties['native']); ?>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            <?php echo e(__('Logout')); ?>

                        </a>

                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        
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
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="<?php echo e(asset('assets/admin/plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo e(asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('script'); ?>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('assets/admin/dist/js/adminlte.min.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('custom'); ?>

</body>

</html>
<?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/daf/layouts/app.blade.php ENDPATH**/ ?>
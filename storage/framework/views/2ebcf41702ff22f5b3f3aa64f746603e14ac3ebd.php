<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links  Rida -->
    <ul class="navbar-nav">

        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">


        </li>


    </ul>


    <!-- Right navbar links -->

    <ul class="<?php echo e(LaravelLocalization::getCurrentLocale() == 'fr' || LaravelLocalization::getCurrentLocale() == 'en' ? 'navbar-nav ml-auto' : 'navbar-nav'); ?>"
        >

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <!-- Rida -->
                <img src="<?php echo e(asset('/assets/admin/imgs/default.png')); ?>"
                    class="img-profile rounded-circle avatar user-image" width="32px" height="32px"
                    alt="User Image" />

            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                

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
<?php /**PATH /Users/a/Documents/anac/resources/views/admin/includes/navbar.blade.php ENDPATH**/ ?>
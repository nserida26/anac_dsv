<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="<?php echo e(asset('/assets/admin/imgs/logo.png')); ?>" alt="MRT Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">ANAC</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) Rida -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo e(asset('/assets/admin/imgs/default.png')); ?>"
                    class="img-profile rounded-circle avatar user-image" width="160px" height="160px"
                    alt="User Image" />
            </div>
            <div class="info">
                <a href="#" class="d-block"></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item <?php echo e(Request::segment(1) === '/admin' ? 'active' : null); ?>">
                    <a href="<?php echo e(route('dashboard')); ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            <?php echo app('translator')->get('sidebar.dashboard'); ?>

                        </p>
                    </a>
                </li>
                <li class="nav-item <?php echo e(Request::segment(1) === '/admin' ? 'active' : null); ?>">
                    <a href="<?php echo e(route('demandes')); ?>" class="nav-link">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            <?php echo app('translator')->get('sidebar.demandes'); ?>

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p><?php echo app('translator')->get('sidebar.management'); ?>

                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(url('admin/users')); ?>" class="nav-link">
                                <i class="far fa-user nav-icon"></i>
                                <p><?php echo app('translator')->get('sidebar.users'); ?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(url('admin/roles')); ?>" class="nav-link ">
                                <i class="fas fa-user-shield nav-icon"></i>
                                <p><?php echo app('translator')->get('sidebar.roles'); ?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(url('admin/qualifications')); ?>" class="nav-link ">
                                <i class="fas fa-star nav-icon"></i>
                                <p><?php echo app('translator')->get('sidebar.qualifications'); ?></p>
                            </a>
                        </li>

                    </ul>
                </li>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php /**PATH /Users/a/Documents/anac/resources/views/admin/includes/sidebar.blade.php ENDPATH**/ ?>
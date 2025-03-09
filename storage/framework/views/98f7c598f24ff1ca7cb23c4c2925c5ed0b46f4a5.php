<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo app('translator')->get('register.register'); ?> | ANAC</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/fonts/ionicons/2.0.1/css/ionicons.min.css')); ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/dist/css/adminlte.min.css')); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/fonts/SansPro/SansPro.min.css')); ?>">
    <link href="<?php echo e(asset('assets/admin/imgs/logo.png')); ?>" rel="icon" type="image/png">
    <style>
        .register-box-msg,
        .register-box-msg {
            margin: 0;
            padding: 0 20px 20px;
            text-align: center;

            font-size: 1.5vw;
        }
    </style>
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <img src="<?php echo e(asset('assets/admin/imgs/logo.png')); ?> " class="rounded-circle avatar avatar font-weight-bold"
                alt="Logo Image" />
        </div>
        <div class="card card-outline card-primary">

            <div class="card-header text-center">
                <a href="#" class="h1"><b>ANAC</b></a>
            </div>
            <div class="card-body register-card-body">
                <?php if(Session::has('error')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo e(Session::get('error')); ?>

                    </div>
                <?php endif; ?>
                <p class="register-box-msg"><?php echo app('translator')->get('register.register'); ?></p>
                <form action="<?php echo e(route('register')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="input-group mb-3">
                        <input type="text" name="email" class="form-control"
                            placeholder="<?php echo e(__('register.email')); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control"
                            placeholder=<?php echo e(__('register.password')); ?>>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="input-group mb-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" placeholder=<?php echo e(__('register.password')); ?>>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo app('translator')->get('register.enter'); ?></button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a href="<?php echo e(route('login')); ?>" class="text-center">I already have a membership</a>
            </div>
            <!-- /.register-card-body -->
        </div>
    </div>
    <!-- /.register-box -->
    <!-- jQuery -->
    <script src="<?php echo e(asset('assets/admin/plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo e(asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
</body>

</html>
<?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/auth/register.blade.php ENDPATH**/ ?>
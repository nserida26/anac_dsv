<?php if(Session::has('errors')): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo e(Session::get('errors')); ?>

    </div>
<?php endif; ?>
<?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/admin/includes/alerts/error.blade.php ENDPATH**/ ?>
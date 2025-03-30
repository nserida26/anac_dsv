<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            <?php echo e(Form::label('np')); ?>

            <?php echo e(Form::text('np', $evaluateur->np, ['class' => 'form-control' . ($errors->has('np') ? ' is-invalid' : ''), 'placeholder' => 'Np'])); ?>

            <?php echo $errors->first('np', '<div class="invalid-feedback">:message</div>'); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('user_id', 'User')); ?>

            <?php echo e(Form::select('user_id', $users, $evaluateur->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'Select User'])); ?>

            <?php echo $errors->first('user_id', '<div class="invalid-feedback">:message</div>'); ?>

        </div>


    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
    </div>
</div>
<?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/admin/evaluateurs/form.blade.php ENDPATH**/ ?>
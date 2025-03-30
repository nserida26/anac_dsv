<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            <?php echo e(Form::label('libelle')); ?>

            <?php echo e(Form::text('libelle', $centreFormation->libelle, ['class' => 'form-control' . ($errors->has('libelle') ? ' is-invalid' : ''), 'placeholder' => 'Libelle'])); ?>

            <?php echo $errors->first('libelle', '<div class="invalid-feedback">:message</div>'); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('user_id', 'User')); ?>

            <?php echo e(Form::select('user_id', $users, $centreFormation->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'Select User'])); ?>

            <?php echo $errors->first('user_id', '<div class="invalid-feedback">:message</div>'); ?>

        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
    </div>
</div>
<?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/admin/centre-formations/form.blade.php ENDPATH**/ ?>
<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            <?php echo e(Form::label('key')); ?>

            <?php echo e(Form::text('key', $setting->key, ['class' => 'form-control' . ($errors->has('key') ? ' is-invalid' : ''), 'placeholder' => 'Key'])); ?>

            <?php echo $errors->first('key', '<div class="invalid-feedback">:message</div>'); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('value')); ?>

            <?php echo e(Form::text('value', $setting->value, ['class' => 'form-control' . ($errors->has('value') ? ' is-invalid' : ''), 'placeholder' => 'Value'])); ?>

            <?php echo $errors->first('value', '<div class="invalid-feedback">:message</div>'); ?>

        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
    </div>
</div><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/admin/settings/form.blade.php ENDPATH**/ ?>
<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            <?php echo e(Form::label('libelle')); ?>

            <?php echo e(Form::text('libelle', $autorite->libelle, ['class' => 'form-control' . ($errors->has('libelle') ? ' is-invalid' : ''), 'placeholder' => 'Libelle'])); ?>

            <?php echo $errors->first('libelle', '<div class="invalid-feedback">:message</div>'); ?>

        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
    </div>
</div><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/admin/autorites/form.blade.php ENDPATH**/ ?>
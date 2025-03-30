<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            <?php echo e(Form::label('nom_entreprise')); ?>

            <?php echo e(Form::text('nom_entreprise', $compagny->nom_entreprise, ['class' => 'form-control' . ($errors->has('nom_entreprise') ? ' is-invalid' : ''), 'placeholder' => 'Nom Entreprise'])); ?>

            <?php echo $errors->first('nom_entreprise', '<div class="invalid-feedback">:message</div>'); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('adresse')); ?>

            <?php echo e(Form::text('adresse', $compagny->adresse, ['class' => 'form-control' . ($errors->has('adresse') ? ' is-invalid' : ''), 'placeholder' => 'Adresse'])); ?>

            <?php echo $errors->first('adresse', '<div class="invalid-feedback">:message</div>'); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('panier')); ?>

            <?php echo e(Form::text('panier', $compagny->panier, ['class' => 'form-control' . ($errors->has('panier') ? ' is-invalid' : ''), 'placeholder' => 'Panier'])); ?>

            <?php echo $errors->first('panier', '<div class="invalid-feedback">:message</div>'); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('user_id', 'User')); ?>

            <?php echo e(Form::select('user_id', $users, $compagny->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'Select User'])); ?>

            <?php echo $errors->first('user_id', '<div class="invalid-feedback">:message</div>'); ?>

        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
    </div>
</div>
<?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/admin/compagnies/form.blade.php ENDPATH**/ ?>
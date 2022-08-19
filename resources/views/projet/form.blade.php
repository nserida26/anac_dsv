<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('designation') }}
            {{ Form::text('designation', $projet->designation, ['class' => 'form-control' . ($errors->has('designation') ? ' is-invalid' : ''), 'placeholder' => 'Designation']) }}
            {!! $errors->first('designation', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('code') }}
            {{ Form::text('code', $projet->code, ['class' => 'form-control' . ($errors->has('code') ? ' is-invalid' : ''), 'placeholder' => 'Code']) }}
            {!! $errors->first('code', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('date_debut') }}
            {{ Form::text('date_debut', $projet->date_debut, ['class' => 'form-control' . ($errors->has('date_debut') ? ' is-invalid' : ''), 'placeholder' => 'Date Debut']) }}
            {!! $errors->first('date_debut', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('date_fin') }}
            {{ Form::text('date_fin', $projet->date_fin, ['class' => 'form-control' . ($errors->has('date_fin') ? ' is-invalid' : ''), 'placeholder' => 'Date Fin']) }}
            {!! $errors->first('date_fin', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('bayeur_id') }}
            {{ Form::text('bayeur_id', $projet->bayeur_id, ['class' => 'form-control' . ($errors->has('bayeur_id') ? ' is-invalid' : ''), 'placeholder' => 'Bayeur Id']) }}
            {!! $errors->first('bayeur_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
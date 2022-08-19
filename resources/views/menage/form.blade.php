<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('designation') }}
            {{ Form::text('designation', $menage->designation, ['class' => 'form-control' . ($errors->has('designation') ? ' is-invalid' : ''), 'placeholder' => 'Designation']) }}
            {!! $errors->first('designation', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nbr') }}
            {{ Form::text('nbr', $menage->nbr, ['class' => 'form-control' . ($errors->has('nbr') ? ' is-invalid' : ''), 'placeholder' => 'Nbr']) }}
            {!! $errors->first('nbr', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('projet_id') }}
            {{ Form::text('projet_id', $menage->projet_id, ['class' => 'form-control' . ($errors->has('projet_id') ? ' is-invalid' : ''), 'placeholder' => 'Projet Id']) }}
            {!! $errors->first('projet_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
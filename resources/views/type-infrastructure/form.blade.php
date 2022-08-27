<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group mb-1">
            {{ Form::label('type') }}
            {{ Form::text('type', $typeInfrastructure->type, ['class' => 'form-control' . ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => 'Type']) }}
            {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
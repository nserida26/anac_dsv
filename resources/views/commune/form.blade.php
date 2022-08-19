<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('libele') }}
            {{ Form::text('libele', $commune->libele, ['class' => 'form-control' . ($errors->has('libele') ? ' is-invalid' : ''), 'placeholder' => 'Libele']) }}
            {!! $errors->first('libele', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('population') }}
            {{ Form::text('population', $commune->population, ['class' => 'form-control' . ($errors->has('population') ? ' is-invalid' : ''), 'placeholder' => 'Population']) }}
            {!! $errors->first('population', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('altitude') }}
            {{ Form::text('altitude', $commune->altitude, ['class' => 'form-control' . ($errors->has('altitude') ? ' is-invalid' : ''), 'placeholder' => 'Altitude']) }}
            {!! $errors->first('altitude', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('longitude') }}
            {{ Form::text('longitude', $commune->longitude, ['class' => 'form-control' . ($errors->has('longitude') ? ' is-invalid' : ''), 'placeholder' => 'Longitude']) }}
            {!! $errors->first('longitude', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group mb-1">
            {{ Form::label('libele') }}
            {{ Form::text('libele', $localite->libele, ['class' => 'form-control' . ($errors->has('libele') ? ' is-invalid' : ''), 'placeholder' => 'Libele']) }}
            {!! $errors->first('libele', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mb-1">
            {{ Form::label('population') }}
            {{ Form::text('population', $localite->population, ['class' => 'form-control' . ($errors->has('population') ? ' is-invalid' : ''), 'placeholder' => 'Population']) }}
            {!! $errors->first('population', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mb-1">
            {{ Form::label('altitude') }}
            {{ Form::text('altitude', $localite->altitude, ['class' => 'form-control' . ($errors->has('altitude') ? ' is-invalid' : ''), 'placeholder' => 'Altitude']) }}
            {!! $errors->first('altitude', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mb-1">
            {{ Form::label('longitude') }}
            {{ Form::text('longitude', $localite->longitude, ['class' => 'form-control' . ($errors->has('longitude') ? ' is-invalid' : ''), 'placeholder' => 'Longitude']) }}
            {!! $errors->first('longitude', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mb-1">
            
            <select class="form-control {{$errors->has('commune_id') ? ' is-invalid' : ''}}" id="commune_id" name="commune_id">
                {{ Form::label('commune_id') }}
                @foreach ($communes as $commune)
                    <option value="{{$commune->id}}">{{$commune->libele}}</option>
                @endforeach
                
            </select>
            {!! $errors->first('commune_id', '<div class="invalid-feedback">:message</div>') !!}            
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
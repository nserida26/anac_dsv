<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group mb-1">
            {{ Form::label('designation') }}
            {{ Form::text('designation', $menage->designation, ['class' => 'form-control' . ($errors->has('designation') ? ' is-invalid' : ''), 'placeholder' => 'Designation']) }}
            {!! $errors->first('designation', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mb-1">
            {{ Form::label('nbr') }}
            {{ Form::text('nbr', $menage->nbr, ['class' => 'form-control' . ($errors->has('nbr') ? ' is-invalid' : ''), 'placeholder' => 'Nbr']) }}
            {!! $errors->first('nbr', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group mb-1">
            
            <select class="form-control {{$errors->has('localite_id') ? ' is-invalid' : ''}}" id="localite_id" name="localite_id">
                {{ Form::label('localite_id') }}
                @foreach ($localites as $localite)
                    <option value="{{$localite->id}}">{{$localite->libele}}</option>
                @endforeach
                
            </select>
            {!! $errors->first('localite_id', '<div class="invalid-feedback">:message</div>') !!}            
        </div>
        <div class="form-group mb-1">
            
            <select class="form-control {{$errors->has('projet_id') ? ' is-invalid' : ''}}" id="projet_id" name="projet_id">
                {{ Form::label('projet_id') }}
                @foreach ($projets as $projet)
                    <option value="{{$projet->id}}">{{$projet->designation}}</option>
                @endforeach
                
            </select>
            {!! $errors->first('projet_id', '<div class="invalid-feedback">:message</div>') !!}            
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    <label for="code" class="control-label">{{ 'Code' }}</label>
    <input class="form-control" name="code" type="text" id="code" value="{{ isset($partenaire->code) ? $partenaire->code : ''}}" >
    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('intitule') ? 'has-error' : ''}}">
    <label for="intitule" class="control-label">{{ 'Intitule' }}</label>
    <input class="form-control" name="intitule" type="text" id="intitule" value="{{ isset($partenaire->intitule) ? $partenaire->intitule : ''}}" >
    {!! $errors->first('intitule', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('intitule_fr') ? 'has-error' : ''}}">
    <label for="intitule_fr" class="control-label">{{ 'Intitule Fr' }}</label>
    <input class="form-control" name="intitule_fr" type="text" id="intitule_fr" value="{{ isset($partenaire->intitule_fr) ? $partenaire->intitule_fr : ''}}" >
    {!! $errors->first('intitule_fr', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

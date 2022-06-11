<form autocomplete="off">
<div class="row">
  <div class="form-group form-focus col-3">
      {!! Form::number('search.id', null, ['wire:model.debounce.500ms' => 'search.id', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
      {!! Form::label('search.id', 'ID', ['class' => 'focus-label']) !!}
  </div>
  <div class="form-group form-focus col-3">
      {!! Form::text('search.title', null, ['wire:model.defer' => 'search.title', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
      {!! Form::label('search.title', 'Campus', ['class' => 'focus-label']) !!}
  </div>
  <div class="form-group form-focus col-3">
      {!! Form::text('search.short_name', null, ['wire:model.defer' => 'search.short_name', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
      {!! Form::label('search.short_name', 'Short Name', ['class' => 'focus-label']) !!}
  </div>
  <div class="form-group form-focus col-3">
      {!! Form::select('search.active', config('settings.active_field'), 'S', ['wire:model.defer' => 'search.active', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
      {!! Form::label('search.active', 'Active', ['class' => 'focus-label']) !!}
  </div>
  <div class="form-group col-3">
    <button type="button" wire:click.prevent="search()" class="btn btn-primary">Search</button>
    <button type="button" wire:click.prevent="resetSearch()" class="btn btn-warning">Reset</button>
  </div>
</div>
</form>
<form autocomplete="off">
<div class="row">
  <div class="form-group form-focus col-3">
      {!! Form::number('search.id', null, ['wire:model.debounce.500ms' => 'search.id', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
      {!! Form::label('search.id', 'ID', ['class' => 'focus-label']) !!}
  </div>
  <div class="form-group form-focus col-3">
      {!! Form::text('search.title', null, ['wire:model.defer' => 'search.title', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
      {!! Form::label('search.title', 'Master Option', ['class' => 'focus-label']) !!}
  </div>
  <div class="form-group form-focus col-3">
    {!! Form::text('search.code', null, ['wire:model.defer' => 'search.code', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
    {!! Form::label('search.code', 'Code', ['class' => 'focus-label']) !!}
</div>
  <div class="form-group form-focus col-3">
    {!! Form::select('search.master_category_id', $this->masterCategoryList, 'S', ['wire:model.defer' => 'search.master_category_id', 'class' => 'form-control input-rounded search-input floating select2', 'placeholder' => '']) !!}
    {!! Form::label('search.master_category_id', 'Master Category', ['class' => 'focus-label']) !!}
  </div>

  <div class="form-group form-focus col-3">
      {!! Form::select('search.active', config('settings.active_field'), 'S', ['wire:model.defer' => 'search.active', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
      {!! Form::label('search.active', 'Active', ['class' => 'focus-label']) !!}
  </div>
  <div class="form-group col-3">
    <button type="button" wire:click.prevent="search()" class="btn btn-success">Search</button>
    <button type="button" wire:click.prevent="resetSearch()" class="btn btn-warning">Reset</button>
    <button type="button" wire:click.prevent="export()" class="btn btn-primary">Export</button>
  </div>
</div>
</form>
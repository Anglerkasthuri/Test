<form autocomplete="off">
<div class="row">


  <div class="form-group form-focus col-3">
    {!! Form::text('search.log_from', null, ['wire:model.defer' => 'search.log_from', 'class' => 'form-control input-rounded search-input floating date-picker', 'placeholder' => '', 'data-toggle' => 'datetimepicker','onchange' => 'this.dispatchEvent(new InputEvent(\'input\'))'
    ]) !!}
    {!! Form::label('search.log_from', 'Log From', ['class' => 'focus-label']) !!}
  </div>

  <div class="form-group form-focus col-3">
    {!! Form::text('search.log_to', null, ['wire:model.defer' => 'search.log_to', 'class' => 'form-control input-rounded search-input floating  date-picker', 'data-toggle' => 'datetimepicker','placeholder' => '','onchange' => 'this.dispatchEvent(new InputEvent(\'input\'))']) !!}
    {!! Form::label('search.log_to', 'Log From', ['class' => 'focus-label']) !!}
  </div>

  <div class="form-group form-focus col-3">
    {!! Form::select('search.causer_id', $this->userList, 'S', ['wire:model.defer' => 'search.causer_id', 'class' => 'form-control input-rounded select2 search-input floating', 'placeholder' => '' ]) !!}
    {!! Form::label('search.causer_id', 'User', ['class' => 'focus-label']) !!}
  </div>

  <div class="form-group form-focus col-3">
      {!! Form::select('search.event', ['created' => 'Created', 'updated' => 'Updated'], 'S', ['wire:model.defer' => 'search.event', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
      {!! Form::label('search.event', 'Event', ['class' => 'focus-label']) !!}
  </div>

  <div class="form-group form-focus col-3">
    {!! Form::number('search.subject_id', null, ['wire:model.defer' => 'search.subject_id', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
    {!! Form::label('search.subject_id', 'Record ID', ['class' => 'focus-label']) !!}
  </div>
   
  <div class="form-group form-focus col-3">
    {!! Form::select('search.log_name', $this->modelList, 'S', ['wire:model.defer' => 'search.log_name', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
    {!! Form::label('search.log_name', 'Model', ['class' => 'focus-label']) !!}
  </div>

  <div class="form-group form-focus datetime-picker col-3">
      {!! Form::number('search.id', null, ['wire:model.defer' => 'search.id', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
      {!! Form::label('search.id', 'Log ID', ['class' => 'focus-label']) !!}
  </div>

  <div class="form-group col-3">
    <button type="button" wire:click.prevent="search()" class="btn btn-primary">Search</button>
    <button type="button" wire:click.prevent="resetSearch()" class="btn btn-warning">Reset</button>
    <button type="button" wire:click.prevent="export()" class="btn btn-success">Export</button>
  </div>
</div>
</form>
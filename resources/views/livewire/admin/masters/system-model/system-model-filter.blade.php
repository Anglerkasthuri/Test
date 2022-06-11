<form autocomplete="off">
    <div class="row">

        <div class="form-group form-focus col-3">
            {!! Form::number('search.id', null, ['wire:model.debounce.500ms' => 'search.id', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.id', 'ID', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::text('search.title', null, ['wire:model.defer' => 'search.title', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.title', 'System Model Title', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::text('search.model_name', null, ['wire:model.defer' => 'search.model_name', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.model_name', 'Model Name', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::text('search.field_name', null, ['wire:model.defer' => 'search.field_name', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.field_name', 'Field Name', ['class' => 'focus-label']) !!}
        </div>       

        <div class="form-group form-focus col-3">
            {!! Form::select('search.show_in_form', $this->searchShowInFormList, 'S', ['wire:model.defer' => 'search.show_in_form', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.show_in_form', 'Show in Form', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::select('search.active', config('settings.active_field'), 'S', ['wire:model.defer' => 'search.active', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.active', 'Active', ['class' => 'focus-label']) !!}
        </div>
        
        <div class="form-group form-focus col-3">
            <button type="button" wire:click.prevent="search()"
            class="btn btn-primary">Search</button>
            <button type="button" wire:click.prevent="resetSearch()"
            class="btn btn-warning">Reset</button>     
        </div>

    </div>
</form>
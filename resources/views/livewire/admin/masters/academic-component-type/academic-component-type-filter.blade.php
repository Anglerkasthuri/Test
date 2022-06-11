<form autocomplete="off">
    <div class="row">
        <div class="form-group form-focus col-3">
            {!! Form::number('search.id', null, ['wire:model.debounce.500ms' => 'search.id', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.id', 'ID', ['class' => 'focus-label']) !!}
        </div>
        
        <div class="form-group form-focus col-3">
            {!! Form::text('search.title', null, ['wire:model.defer' => 'search.title', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.title', 'Academic Component Type', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::select('search.campus_id', $this->SearchCampusList, 'S', ['wire:model.defer' => 'search.campus_id', 'class' => 'form-control input-rounded search-input select2 floating', 'placeholder' => '']) !!}
            {!! Form::label('search.campus_id', 'Campus', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::select('search.academic_component_group_id', $this->SearchAcademicComponentGroupList, 'S', ['wire:model.defer' => 'search.academic_component_group_id', 'class' => 'form-control input-rounded search-input select2 floating', 'placeholder' => '']) !!}
            {!! Form::label('search.academic_component_group_id', 'Component Group', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::select('search.academic_component_category_id', $this->SearchAcademicComponentCategoryList, 'S', ['wire:model.defer' => 'search.academic_component_category_id', 'class' => 'form-control input-rounded search-input select2 floating', 'placeholder' => '']) !!}
            {!! Form::label('search.academic_component_category_id', 'Component Category', ['class' => 'focus-label']) !!}
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
            <button type="button" wire:click.prevent="export()" 
            class="btn btn-success">Export</button> 
        </div>
        
    </div>
</form>

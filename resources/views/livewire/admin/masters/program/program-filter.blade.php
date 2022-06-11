<form autocomplete="off">
    <div class="row">

        <div class="form-group form-focus col-3">
            {!! Form::number('search.id', null, ['wire:model.debounce.500ms' => 'search.id', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.id', 'ID', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::text('search.title', null, ['wire:model.defer' => 'search.title', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.title', 'Program', ['class' => 'focus-label']) !!}
        </div>
        
        <div class="form-group form-focus col-3">
            {!! Form::select('search.program_sub_category_id', $this->SearchProgramSubCategoryList, 'S', ['wire:model.defer' => 'search.program_sub_category_id', 'class' => 'form-control input-rounded search-input select-picker-select2 floating', 'placeholder' => '']) !!}
            {!! Form::label('search.program_sub_category_id', 'Program Sub Category', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::select('search.program_level_id', $this->SearchProgramLevelList, 'S', ['wire:model.defer' => 'search.program_level_id', 'class' => 'form-control input-rounded search-input select-picker-select2 floating', 'placeholder' => '']) !!}
            {!! Form::label('search.program_level_id', 'Program Level', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::select('search.program_type_id', $this->SearchProgramTypeList, 'S', ['wire:model.defer' => 'search.program_type_id', 'class' => 'form-control input-rounded search-input select-picker-select2 floating', 'placeholder' => '']) !!}
            {!! Form::label('search.program_type_id', 'Program Type', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::select('search.program_duration_id', $this->SearchProgramDurationList, 'S', ['wire:model.defer' => 'search.program_duration_id', 'class' => 'form-control input-rounded search-input select-picker-select2 floating', 'placeholder' => '']) !!}
            {!! Form::label('search.program_duration_id', 'Program Duration', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::select('search.academic_pattern_id', $this->SearchAcademicPatternList, 'S', ['wire:model.defer' => 'search.academic_pattern_id', 'class' => 'form-control input-rounded search-input select-picker-select2 floating', 'placeholder' => '']) !!}
            {!! Form::label('search.academic_pattern_id', 'Academic Pattern', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::number('search.number_of_pattern', null, ['wire:model.defer' => 'search.number_of_pattern', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.number_of_pattern', 'Number of Pattern', ['class' => 'focus-label']) !!}
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
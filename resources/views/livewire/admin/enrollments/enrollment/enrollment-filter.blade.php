<form autocomplete="off">
    <div class="row">

        <div class="form-group form-focus col-3">
            {!! Form::number('search.id', null, ['wire:model.debounce.500ms' => 'search.id', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.id', 'ID', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::text('search.title', null, ['wire:model.defer' => 'search.title', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.title', 'Enrollment', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::select('search.campus_id', $this->SearchCampusList, 'S', ['wire:model.defer' => 'search.campus_id', 'class' => 'form-control input-rounded search-input select2 floating', 'placeholder' => '']) !!}
            {!! Form::label('search.campus_id', 'Campus', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::select('search.program_id', $this->SearchProgramList, 'S', ['wire:model.defer' => 'search.program_id', 'class' => 'form-control input-rounded search-input select2 floating', 'placeholder' => '']) !!}
            {!! Form::label('search.program_id', 'Program', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::select('search.academic_year_id', $this->SearchAcademicYearList, 'S', ['wire:model.defer' => 'search.academic_year_id', 'class' => 'form-control input-rounded search-input select2 floating', 'placeholder' => '']) !!}
            {!! Form::label('search.academic_year_id', 'Academic Year', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::text('search.academic_pattern_number', null, ['wire:model.defer' => 'search.academic_pattern_number', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.academic_pattern_number', 'Academic Pattern Number', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::select('search.academic_pattern_id', $this->SearchAcademicPatternList, 'S', ['wire:model.defer' => 'search.academic_pattern_id', 'class' => 'form-control input-rounded search-input select2 floating', 'placeholder' => '']) !!}
            {!! Form::label('search.academic_pattern_id', 'Academic Pattern', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3">
            {!! Form::select('search.batch_id', $this->SearchBatchList, 'S', ['wire:model.defer' => 'search.batch_id', 'class' => 'form-control input-rounded search-input select2 floating', 'placeholder' => '']) !!}
            {!! Form::label('search.batch_id', 'Batch', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3 focused">
            {!! Form::date('search.duration_start_from', null, ['wire:model.defer' => 'search.duration_start_from', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.duration_start_from', 'Duration Start From', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3 focused">
            {!! Form::date('search.duration_end_from', null, ['wire:model.defer' => 'search.duration_end_from', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.duration_end_from', 'Duration End From', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3 focused">
            {!! Form::date('search.duration_start_to', null, ['wire:model.defer' => 'search.duration_start_to', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.duration_start_to', 'Duration Start To', ['class' => 'focus-label']) !!}
        </div>

        <div class="form-group form-focus col-3 focused">
            {!! Form::date('search.duration_end_to', null, ['wire:model.defer' => 'search.duration_end_to', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.duration_end_to', 'Duration End To', ['class' => 'focus-label']) !!}
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
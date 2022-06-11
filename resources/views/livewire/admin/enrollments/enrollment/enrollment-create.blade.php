<div>
    <form autocomplete="off">

        <div class="row p-3">
            <div class="form-group col-lg-4">
                {!! Form::label('fdata.title', 'Enrollment Name', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.title', old('fdata.title'), ['wire:model.defer' => 'fdata.title', 'class' => 'form-control ' . ($errors->has('fdata.title') ? ' is-invalid' : ''), 'placeholder' => 'Enter Enrollment']) !!}
                @error('fdata.title')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.campus_id', 'Campus', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.campus_id', $this->campusList, 'S', ['wire:model' => 'fdata.campus_id', 'id' => 'fdata.campus_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.campus_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Campus']) !!}
                @error('fdata.campus_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4"></div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.program_id', 'Program', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.program_id', $this->programList, 'S', ['wire:model.defer' => 'fdata.program_id', 'id' => 'fdata.program_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.program_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Program']) !!}
                @error('fdata.program_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.enrollment_type_id', 'Enrollment Type', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.enrollment_type_id', $this->enrollmentTypeList, 'S', ['wire:model.defer' => 'fdata.enrollment_type_id', 'id' => 'fdata.enrollment_type_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.enrollment_type_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Enrollment Type']) !!}
                @error('fdata.enrollment_type_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.medium_of_instruction_id', 'Medium of Instruction', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.medium_of_instruction_id', $this->mediumOfInstructionList, 'S', ['wire:model.defer' => 'fdata.medium_of_instruction_id', 'id' => 'fdata.medium_of_instruction_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.medium_of_instruction_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Medium of Instruction']) !!}
                @error('fdata.medium_of_instruction_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.batch_id', 'Batch', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.batch_id', $this->batchList, 'S', ['wire:model.defer' => 'fdata.batch_id', 'id' => 'fdata.batch_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.batch_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Batch']) !!}
                @error('fdata.batch_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.academic_pattern_id', 'Academic Pattern', ['class' => 'control-label required']) !!}
                <div class="row">

                    <div class="col-lg-6">
                        {!! Form::select('fdata.academic_pattern_id', $this->academicPatternList, 'S', ['wire:model.defer' => 'fdata.academic_pattern_id', 'id' => 'fdata.academic_pattern_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.academic_pattern_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Academic Pattern']) !!}
                        @error('fdata.academic_pattern_id')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        {!! Form::selectRange('fdata.academic_pattern_number', 1, 7, 'S', ['wire:model.defer' => 'fdata.academic_pattern_number', 'id' => 'fdata.academic_pattern_number', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.academic_pattern_number') ? ' is-invalid' : ''), 'placeholder' => 'Select Academic Pattern Number']) !!}
                        @error('fdata.academic_pattern_number')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.academic_year_id', 'Academic year', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.academic_year_id', $this->academicYearList, 'S', ['wire:model.defer' => 'fdata.academic_year_id', 'id' => 'fdata.academic_year_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.academic_year_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Academic year']) !!}
                @error('fdata.academic_year_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-8">
                {{-- {!! Form::label('fdata.duration_from', 'Duration', ['class' => 'control-label required']) !!} --}}
                <div class="row">
                    {{-- Bootrap DateRange Picker Method --}}
                    {{-- <div class="col-lg-12">
                        {!! Form::text('fdata.duration_from', '', ['wire:model' => 'fdata.duration', 'id' => 'fdata.duration_from', 'class' => 'form-control  date-range-picker ' .($errors->has('fdata.duration_to') ? ' is-invalid' : ''). ($errors->has('fdata.duration_from') ? ' is-invalid' : ''), 'placeholder' => 'Duration From']) !!}
                        @error('fdata.duration_from')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                        @error('fdata.duration_to')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                        {{ ($this->fdata['duration']?? '') }}<br>
                        {{ ($this->fdata['duration_from'] ?? '').' - '.($this->fdata['duration_to'] ?? '') }}
                    </div> --}}

                    {{-- Normal Method --}}
                    <div class="col-lg-6">
                        {!! Form::label('fdata.duration_from', 'Duration From', ['class' => 'control-label required']) !!}
                        {!! Form::date('fdata.duration_from', '', ['wire:model.defer' => 'fdata.duration_from', 'id' => 'fdata.duration_from', 'class' => 'form-control ' . ($errors->has('fdata.duration_from') ? ' is-invalid' : ''), 'placeholder' => 'Duration To']) !!}
                        @error('fdata.duration_from')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        {!! Form::label('fdata.duration_to', 'Duration To', ['class' => 'control-label required']) !!}
                        {!! Form::date('fdata.duration_to', '', ['wire:model.defer' => 'fdata.duration_to', 'id' => 'fdata.duration_to', 'class' => 'form-control ' . ($errors->has('fdata.duration_to') ? ' is-invalid' : ''), 'placeholder' => 'Duration To']) !!}
                        @error('fdata.duration_to')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.grade_category_id', 'Grade Category', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.grade_category_id', $this->gradeCategoryList, 'S', ['wire:model.defer' => 'fdata.grade_category_id', 'id' => 'fdata.grade_category_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.grade_category_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Grade Category']) !!}
                @error('fdata.grade_category_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-8">
                {!! Form::label('fdata.remarks', 'Remarks', ['class' => 'control-label']) !!}
                {!! Form::textarea('fdata.remarks', old('fdata.remarks'), ['wire:model.defer' => 'fdata.remarks', 'class' => 'form-control ' . ($errors->has('fdata.remarks') ? ' is-invalid' : ''), 'placeholder' => 'Enter Remarks', 'rows' => 4]) !!}
                @error('fdata.remarks')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-check col-lg-4">
                {!! Form::label('active', 'Active', ['class' => 'control-label']) !!}
                <div>
                    {!! Form::checkbox('fdata.active', 1, data_get($this->fdata, 'active'), ['wire:model.defer' => 'fdata.active', 'id' => 'fdata.active', 'class' => ' ' . ($errors->has('fdata.active') ? ' is-invalid' : '')]) !!}
                    @error('fdata.active')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
        </div>

        <div class="card-footer col-lg-12 ">
            <button type="button" wire:click="store()" class="btn btn-primary float-right mx-1">Submit</button>
        </div>
        
    </form>

</div>

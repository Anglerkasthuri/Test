<div>
    <form autocomplete="off">

        <div class="row p-3">

            <div class="form-group col-lg-6">
                {!! Form::label('fdata.title', 'Program', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.title', old('fdata.title'), ['wire:model.defer' => 'fdata.title', 'class' => 'form-control ' . ($errors->has('fdata.title') ? ' is-invalid' : ''), 'placeholder' => 'Enter Program']) !!}
                @error('fdata.title')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-6">
                {!! Form::label('fdata.degree_name', 'Degree Name', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.degree_name', old('fdata.degree_name'), ['wire:model.defer' => 'fdata.degree_name', 'class' => 'form-control ' . ($errors->has('fdata.degree_name') ? ' is-invalid' : ''), 'placeholder' => 'Enter Degree Name']) !!}
                @error('fdata.degree_name')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-3">
                {!! Form::label('fdata.code', 'Code', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.code', old('fdata.code'), ['wire:model.defer' => 'fdata.code', 'class' => 'form-control ' . ($errors->has('fdata.code') ? ' is-invalid' : ''), 'placeholder' => 'Enter Code']) !!}
                @error('fdata.code')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-3">
                {!! Form::label('fdata.short_name', 'Short Name', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.short_name', old('fdata.short_name'), ['wire:model.defer' => 'fdata.short_name', 'class' => 'form-control ' . ($errors->has('fdata.short_name') ? ' is-invalid' : ''), 'placeholder' => 'Enter Short Name']) !!}
                @error('fdata.short_name')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-3">
                {!! Form::label('fdata.academic_pattern_id', 'Academic Pattern', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.academic_pattern_id', $this->academicPatternList, 'S', ['wire:model.defer' => 'fdata.academic_pattern_id', 'id' => 'fdata.academic_pattern_id', 'class' => 'form-control selectpicker ' . ($errors->has('fdata.academic_pattern_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Academic Pattern']) !!}
                @error('fdata.academic_pattern_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-3">
                {!! Form::label('fdata.number_of_pattern', 'Number of Pattern', ['class' => 'control-label required']) !!}
                {!! Form::number('fdata.number_of_pattern', old('fdata.number_of_pattern'), ['wire:model.defer' => 'fdata.number_of_pattern', 'class' => 'form-control selectpicker ' . ($errors->has('fdata.number_of_pattern') ? ' is-invalid' : ''), 'placeholder' => 'Enter Number of Pattern']) !!}
                @error('fdata.number_of_pattern')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group col-lg-3">
                {!! Form::label('fdata.degree_awarding_body_id', 'Degree Awarding Body', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.degree_awarding_body_id', $this->degreeAwardingBodyList, 'S', ['wire:model.defer' => 'fdata.degree_awarding_body_id', 'id' => 'fdata.degree_awarding_body_id', 'class' => 'form-control selectpicker ' . ($errors->has('fdata.degree_awarding_body_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Degree Awarding Body']) !!}
                @error('fdata.degree_awarding_body_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-3">
                {!! Form::label('fdata.campus_id', 'Campus', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.campus_id', $this->campusList, 'S', ['wire:model.defer' => 'fdata.campus_id', 'id' => 'fdata.campus_id', 'class' => 'form-control selectpicker ' . ($errors->has('fdata.campus_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Campus']) !!}
                @error('fdata.campus_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-3">
                {!! Form::label('fdata.program_category_id', 'Program Category', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.program_category_id', $this->programCategoryList, 'S', ['wire:model.defer' => 'fdata.program_category_id', 'id' => 'fdata.program_category_id', 'class' => 'form-control selectpicker ' . ($errors->has('fdata.program_category_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Program Category']) !!}
                @error('fdata.program_category_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group col-lg-3">
                {!! Form::label('fdata.program_sub_category_id', 'Program Subcategory', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.program_sub_category_id', $this->programSubCategoryList, 'S', ['wire:model.defer' => 'fdata.program_sub_category_id', 'id' => 'fdata.program_sub_category_id', 'class' => 'form-control selectpicker ' . ($errors->has('fdata.program_sub_category_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Program Sub Category']) !!}
                @error('fdata.program_sub_category_id')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group col-lg-3">
                {!! Form::label('fdata.program_level_id', 'Program Level', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.program_level_id', $this->programLevelList, 'S', ['wire:model.defer' => 'fdata.program_level_id', 'id' => 'fdata.program_level_id', 'class' => 'form-control selectpicker ' . ($errors->has('fdata.program_level_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Program Level']) !!}
                @error('fdata.program_level_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-3">
                {!! Form::label('fdata.program_group_id', 'Program Group', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.program_group_id', $this->programGroupList, 'S', ['wire:model.defer' => 'fdata.program_group_id', 'id' => 'fdata.program_group_id', 'class' => 'form-control selectpicker ' . ($errors->has('fdata.program_group_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Program Group']) !!}
                @error('fdata.program_group_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-3">
                {!! Form::label('fdata.program_type_id', 'Program Type', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.program_type_id', $this->programTypeList, 'S', ['wire:model.defer' => 'fdata.program_type_id', 'id' => 'fdata.program_type_id', 'class' => 'form-control selectpicker ' . ($errors->has('fdata.program_type_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Program Type']) !!}
                @error('fdata.program_type_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-3">
                {!! Form::label('fdata.study_mode_id', 'Study Mode', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.study_mode_id', $this->studyModeList, 'S', ['wire:model.defer' => 'fdata.study_mode_id', 'id' => 'fdata.study_mode_id', 'class' => 'form-control selectpicker ' . ($errors->has('fdata.study_mode_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Study Mode']) !!}
                @error('fdata.study_mode_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-lg-3">
                <div class="form-group col-lg-12">
                    {!! Form::label('fdata.program_duration_id', 'Program Duration', ['class' => 'control-label required']) !!}
                    {!! Form::select('fdata.program_duration_id', $this->programDurationList, 'S', ['wire:model.defer' => 'fdata.program_duration_id', 'id' => 'fdata.program_duration_id', 'class' => 'form-control selectpicker ' . ($errors->has('fdata.program_duration_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Program Duration']) !!}
                    @error('fdata.program_duration_id')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-12">
                    {!! Form::label('fdata.accreditation_id', 'Program Accredited by', ['class' => 'control-label required']) !!}
                    {!! Form::select('fdata.accreditation_id', $this->accreditationList, 'S', ['wire:model.defer' => 'fdata.accreditation_id', 'id' => 'fdata.accreditation_id', 'class' => 'form-control  selectpicker ' . ($errors->has('fdata.accreditation_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Program Accredited by']) !!}
                    @error('fdata.accreditation_id')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>        
           
            <div class="form-group col-lg-6">
                {!! Form::label('fdata.description', 'Description', ['class' => 'control-label ']) !!}
                {!! Form::textarea('fdata.description', old('fdata.description'), ['wire:model.defer' => 'fdata.description', 'class' => 'form-control ' . ($errors->has('fdata.description') ? ' is-invalid' : ''), 'placeholder' => 'Enter Description', 'rows'=> 5]) !!}
                @error('fdata.description')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>  

            <div class="form-check col-lg-3">
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

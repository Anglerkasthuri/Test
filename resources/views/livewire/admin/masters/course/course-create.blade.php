<div>
    <form autocomplete="off">

        <div class="row p-3">
            <div class="form-group col-lg-4">
                {!! Form::label('fdata.title', 'Course', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.title', old('fdata.title'), ['wire:model.defer' => 'fdata.title', 'class' => 'form-control ' . ($errors->has('fdata.title') ? ' is-invalid' : ''), 'placeholder' => 'Enter Course']) !!}
                @error('fdata.title')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

			<div class="form-group col-lg-4">
                {!! Form::label('fdata.code', 'Code', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.code', old('fdata.code'), ['wire:model.defer' => 'fdata.code', 'class' => 'form-control ' . ($errors->has('fdata.code') ? ' is-invalid' : ''), 'placeholder' => 'Enter Code']) !!}
                @error('fdata.code')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.short_name', 'Short Name', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.short_name', old('fdata.short_name'), ['wire:model.defer' => 'fdata.short_name', 'class' => 'form-control ' . ($errors->has('fdata.short_name') ? ' is-invalid' : ''), 'placeholder' => 'Enter Short Name']) !!}
                @error('fdata.short_name')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

			<div class="form-group col-lg-4">
                {!! Form::label('fdata.campus_id', 'Campus', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.campus_id', $this->campusList, 'S', ['wire:model.defer' => 'fdata.campus_id', 'id' => 'fdata.campus_id', 'class' => 'form-control  ' . ($errors->has('fdata.campus_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Campus']) !!}
                @error('fdata.campus_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.program_category_id', 'Program Category', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.program_category_id', $this->programCategoryList, 'S', ['wire:model.defer' => 'fdata.program_category_id', 'id' => 'fdata.program_category_id', 'class' => 'form-control  ' . ($errors->has('fdata.program_category_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Program Category']) !!}
                @error('fdata.program_category_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group col-lg-4">
                {!! Form::label('fdata.program_sub_category_id', 'Program Subcategory', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.program_sub_category_id', $this->programSubCategoryList, 'S', ['wire:model.defer' => 'fdata.program_sub_category_id', 'id' => 'fdata.program_sub_category_id', 'class' => 'form-control  ' . ($errors->has('fdata.program_sub_category_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Program Sub Category']) !!}
                @error('fdata.program_sub_category_id')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group col-lg-4">
                {!! Form::label('fdata.program_level_id', 'Program Level', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.program_level_id', $this->programLevelList, 'S', ['wire:model.defer' => 'fdata.program_level_id', 'id' => 'fdata.program_level_id', 'class' => 'form-control  ' . ($errors->has('fdata.program_level_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Program Level']) !!}
                @error('fdata.program_level_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

			<div class="form-group col-lg-4">
                {!! Form::label('fdata.course_type_id', 'Course Type', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.course_type_id', $this->courseTypeList, 'S', ['wire:model.defer' => 'fdata.course_type_id', 'id' => 'fdata.course_type_id', 'class' => 'form-control  ' . ($errors->has('fdata.course_type_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Program Level']) !!}
                @error('fdata.course_type_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

			<div class="form-group col-lg-4">
                {!! Form::label('fdata.course_category_id', 'Course Category', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.course_category_id', $this->courseCategoryList, 'S', ['wire:model.defer' => 'fdata.course_category_id', 'id' => 'fdata.course_category_id', 'class' => 'form-control  ' . ($errors->has('fdata.course_category_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Program Level']) !!}
                @error('fdata.course_category_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

			<div class="col-lg-12"></div>
			<div class="form-group col-lg-4">
                {!! Form::label('fdata.approval_id', 'Approval ID', ['class' => 'control-label']) !!}
                {!! Form::text('fdata.approval_id', old('fdata.approval_id'), ['wire:model.defer' => 'fdata.approval_id', 'class' => 'form-control ' . ($errors->has('fdata.approval_id') ? ' is-invalid' : ''), 'placeholder' => 'Enter Approval ID']) !!}
                @error('fdata.approval_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

			<div class="form-group col-lg-8">
                {!! Form::label('fdata.approval_link', 'Approval Link', ['class' => 'control-label']) !!}
                {!! Form::text('fdata.approval_link', old('fdata.approval_link'), ['wire:model.defer' => 'fdata.approval_link', 'class' => 'form-control ' . ($errors->has('fdata.approval_link') ? ' is-invalid' : ''), 'placeholder' => 'Enter Approval Link']) !!}
                @error('fdata.approval_link')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

			<div class="form-group col-lg-9">
                {!! Form::label('fdata.description', 'Description', ['class' => 'control-label']) !!}
                {!! Form::textarea('fdata.description', old('fdata.description'), ['wire:model.defer' => 'fdata.description', 'class' => 'form-control ' . ($errors->has('fdata.description') ? ' is-invalid' : ''), 'placeholder' => 'Enter Description', 'rows' => 5]) !!}
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

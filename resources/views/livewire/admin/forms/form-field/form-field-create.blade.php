<div>
    <form autocomplete="off">

        <div class="row p-3">

            <div class="form-group col-lg-6">
                {!! Form::label('fdata.title', 'Field Title', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.title', old('fdata.title'), ['wire:model.defer' => 'fdata.title', 'class' => 'form-control ' . ($errors->has('fdata.title') ? ' is-invalid' : ''), 'placeholder' => 'Enter Field Label']) !!}
                @error('fdata.title')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
			
            <div class="form-group col-lg-6">
                {!! Form::label('fdata.form_field_type_id', 'Form Field Type', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.form_field_type_id', $this->FormFieldTypeList, null, ['wire:model' => 'fdata.form_field_type_id', 'id' => 'fdata.form_field_type_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.form_field_type_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Form Field Type']) !!}
                @error('fdata.form_field_type_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>       
            
            @if(!empty($this->field_show['fdata.form_dropdown_type_id']))
            <div class="form-group col-lg-6">
                {!! Form::label('fdata.form_dropdown_type_id', 'Dropdown Type', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.form_dropdown_type_id', $this->dropDownTypeList, null, ['wire:model' => 'fdata.form_dropdown_type_id', 'id' => 'fdata.form_dropdown_type_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.form_dropdown_type_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Dropdown Type']) !!}
                @error('fdata.form_dropdown_type_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>       
            @endif

            @if(!empty($this->field_show['fdata.master_category_id']))
            <div class="form-group col-lg-6">
                {!! Form::label('fdata.master_category_id', 'Custom Master Category', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.master_category_id', $this->masterCategoryList, null, ['wire:model' => 'fdata.master_category_id', 'id' => 'fdata.master_category_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.master_category_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Master Category']) !!}
                @error('fdata.master_category_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            @endif
            
            @if(!empty($this->field_show['fdata.system_model_id']))
            <div class="form-group col-lg-6">
                {!! Form::label('fdata.system_model_id', 'System Model', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.system_model_id', $this->systemModelList, null, ['wire:model' => 'fdata.system_model_id', 'id' => 'fdata.system_model_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.system_model_id') ? ' is-invalid' : ''), 'placeholder' => 'Select System Model']) !!}
                @error('fdata.system_model_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            @endif
            
            <div class="form-group col-lg-6">
                {!! Form::label('fdata.sequence_number', 'Sequence', ['class' => 'control-label required']) !!}
                {!! Form::selectRange('fdata.sequence_number', 1, $max_sequence_number, '', ['wire:model.defer' => 'fdata.sequence_number', 'class' => 'form-control ' . ($errors->has('fdata.sequence_number') ? ' is-invalid' : ''), 'placeholder' => 'Select Sequence']) !!}

                @error('fdata.sequence_number')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>     
            
            @if(!empty($this->field_show['fdata.is_required']))
            <div class="form-check col-lg-6">
                {!! Form::label('fdata.is_required', 'Is Required', ['class' => 'control-label']) !!}
                <div>
                    {!! Form::checkbox('fdata.is_required', 1, data_get($this->fdata, 'is_required'), ['wire:model.defer' => 'fdata.is_required', 'id' => 'fdata.is_required', 'class' => ' ' . ($errors->has('fdata.is_required') ? ' is-invalid' : '')]) !!}
                    @error('fdata.is_required')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-check col-lg-6">
                {!! Form::label('fdata.show_in_filter', 'Show In Filter', ['class' => 'control-label']) !!}
                <div>
                    {!! Form::checkbox('fdata.show_in_filter', 1, data_get($this->fdata, 'show_in_filter'), ['wire:model.defer' => 'fdata.show_in_filter', 'id' => 'fdata.show_in_filter', 'class' => ' ' . ($errors->has('fdata.show_in_filter') ? ' is-invalid' : '')]) !!}
                    @error('fdata.show_in_filter')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            @endif

            

            <div class="form-check col-lg-6">
                {!! Form::label('fdata.active', 'Active', ['class' => 'control-label']) !!}
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

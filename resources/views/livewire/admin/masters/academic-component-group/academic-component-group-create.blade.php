<div>
    <form autocomplete="off">

        <div class="row p-3">
            <div class="form-group col-lg-6">
                {!! Form::label('fdata.title', 'Academic Component Group', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.title', old('fdata.title'), ['wire:model.defer' => 'fdata.title', 'class' => 'form-control ' . ($errors->has('fdata.title') ? ' is-invalid' : ''), 'placeholder' => 'Enter Academic Component Category']) !!}
                @error('fdata.title')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-6">
                {!! Form::label('fdata.academic_component_category_id', 'Academic Component Category', ['class' => 'control-label required']) !!}
              
				{!! Form::select('fdata.academic_component_category_id', $this->academicComponentCategoryList, 'S', ['wire:model.defer' => 'fdata.academic_component_category_id', 'id' => 'fdata.academic_component_category_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.academic_component_category_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Category']) !!}
				@error('fdata.academic_component_category_id')
					<span class="error invalid-feedback">{{ $message }}</span>
				@enderror
            </div>

            <div class="form-group col-lg-6">
                {!! Form::label('fdata.sequence_number', 'Sequence', ['class' => 'control-label required']) !!}
                {!! Form::selectRange('fdata.sequence_number', 1, $max_sequence_number, '', ['wire:model.defer' => 'fdata.sequence_number', 'class' => 'form-control ' . ($errors->has('fdata.sequence_number') ? ' is-invalid' : ''), 'placeholder' => 'Select Sequence']) !!}

                @error('fdata.sequence_number')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-check col-lg-6">
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

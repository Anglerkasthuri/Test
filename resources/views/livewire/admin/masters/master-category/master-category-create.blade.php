<div>
    <form autocomplete="off">
        <div class="row p-3">

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.master_group_id', 'Master Group', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.master_group_id', $this->masterGroupList, 'S', ['wire:model' => 'fdata.master_group_id', 'id' => 'fdata.master_group_id', 'class' => 'form-control  ' . ($errors->has('fdata.master_group_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Master Group']) !!}
                @error('fdata.master_group_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.title', 'Master Category', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.title', '', ['wire:model.debounce.1000ms' => 'fdata.title', 'class' => 'form-control ' . ($errors->has('fdata.title') ? ' is-invalid' : ''), 'placeholder' => 'Enter Master Category']) !!}
                @error('fdata.title')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.code', 'Code', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.code', '', ['wire:model.defer' => 'fdata.code', 'class' => 'form-control ' . ($errors->has('fdata.code') ? ' is-invalid' : ''), 'placeholder' => 'Enter Code']) !!}
                @error('fdata.code')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-check col-lg-4">
                {!! Form::label('fdata.is_dependent', 'Is Dependent', ['class' => 'control-label']) !!}
                <div>
                    {!! Form::checkbox('fdata.is_dependent', 1, data_get($this->fdata, 'is_dependent'), ['wire:model' => 'fdata.is_dependent', 'id' => 'fdata.is_dependent', 'class' => ' ' . ($errors->has('fdata.is_dependent') ? ' is-invalid' : '')]) !!}
                    @error('fdata.is_dependent')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            @if( $this->field_show['fdata.parent_category_id'] ?? false)
            <div class="form-group col-lg-4">
                {!! Form::label('fdata.parent_category_id', 'Dependent Category', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.parent_category_id', $this->parentCategoryList, 'S', ['wire:model' => 'fdata.parent_category_id', 'id' => 'fdata.parent_category_id', 'class' => 'form-control  ' . ($errors->has('fdata.parent_category_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Parent Master Category']) !!}
                @error('fdata.parent_category_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            @endif
            <div class="form-group col-lg-4">
                {!! Form::label('fdata.sequence_number', 'Sequence', ['class' => 'control-label required']) !!}
                {!! Form::selectRange('fdata.sequence_number', 1, $max_sequence_number, '', ['wire:model.defer' => 'fdata.sequence_number', 'class' => 'form-control ' . ($errors->has('fdata.sequence_number') ? ' is-invalid' : ''), 'placeholder' => 'Select Sequence']) !!}

                @error('fdata.sequence_number')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-check col-lg-4">
                {!! Form::label('fdata.show_in_form', 'Show in Form', ['class' => 'control-label']) !!}
                <div>
                    {!! Form::checkbox('fdata.show_in_form', 1, data_get($this->fdata, 'show_in_form'), ['wire:model.defer' => 'fdata.show_in_form', 'id' => 'fdata.show_in_form', 'class' => ' ' . ($errors->has('fdata.show_in_form') ? ' is-invalid' : '')]) !!}
                    @error('fdata.show_in_form')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-check col-lg-4">
                {!! Form::label('fdata.active', 'Active', ['class' => 'control-label']) !!}
                <div>
                    {!! Form::checkbox('fdata.active', 1, data_get($this->fdata, 'active'), ['wire:model.defer' => 'fdata.active', 'id' => 'fdata.active', 'class' => ' ' . ($errors->has('fdata.active') ? ' is-invalid' : '')]) !!}
                    @error('fdata.active')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group col-lg-12">
                {!! Form::label('fdata.description', 'Description', ['class' => 'control-label']) !!}
                {!! Form::textarea('fdata.description', old('fdata.description'), ['wire:model.defer' => 'fdata.description', 'class' => 'form-control ' . ($errors->has('fdata.description') ? ' is-invalid' : ''), 'rows' => 5, 'placeholder' => 'Enter Description']) !!}
                @error('fdata.description')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <div class="card-footer col-lg-12 ">
            <button type="button" wire:click="store()" class="btn btn-primary float-right mx-1">Submit</button>
        </div>


    </form>
</div>

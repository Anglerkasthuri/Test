<div>
    <form autocomplete="off">
        <div class="row p-3">

            @if (!$this->master_category_id)
            <div class="form-group col-lg-4">
                {!! Form::label('fdata.master_category_id', 'Master Category', ['class' => 'control-label required']) !!}
               
                    {!! Form::select('fdata.master_category_id', $this->masterCategoryList, 'S', ['wire:model' => 'fdata.master_category_id', 'id' => 'fdata.master_category_id', 'class' => 'form-control  ' . ($errors->has('fdata.master_category_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Master Category']) !!}
                    @error('fdata.continent_id')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                
                    {{-- <div>
                        <span class="">{{ $this->master_category_details->title }}</span>
                    </div> --}}
                
            </div>
            @endif
            @if ($this->field_show['fdata.parent_option_id'] ?? false)
                <div class="form-group col-lg-4">
                    {!! Form::label('fdata.parent_option_id', $this->master_category_details->parent_category->title ?? null, ['class' => 'control-label required']) !!}
                    {!! Form::select('fdata.parent_option_id', $this->parentOptionList, 'S', ['wire:model' => 'fdata.parent_option_id', 'id' => 'fdata.master_category_id', 'class' => 'form-control  ' . ($errors->has('fdata.parent_option_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Parent Option']) !!}
                    @error('fdata.parent_option_id')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            @endif
            <div class="form-group col-lg-4">
                {!! Form::label('fdata.title',  $this->master_category_details->title ?? "Master Option", ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.title', '', ['wire:model.debounce.1000ms' => 'fdata.title', 'class' => 'form-control ' . ($errors->has('fdata.title') ? ' is-invalid' : ''), 'placeholder' => 'Enter Master Option']) !!}
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

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.sequence_number', 'Sequence', ['class' => 'control-label required']) !!}
                {!! Form::selectRange('fdata.sequence_number', 1, $max_sequence_number, '', ['wire:model.defer' => 'fdata.sequence_number', 'class' => 'form-control ' . ($errors->has('fdata.sequence_number') ? ' is-invalid' : ''), 'placeholder' => 'Select Sequence']) !!}

                @error('fdata.sequence_number')
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

            <div class="form-group col-lg-12">
                {!! Form::label('fdata.description', 'Description', ['class' => 'control-label']) !!}
                {!! Form::textarea('fdata.description', old('fdata.description'), ['wire:model.defer' => 'fdata.description', 'class' => 'form-control ' . ($errors->has('fdata.description') ? ' is-invalid' : ''), 'rows' => 5, 'placeholder' => 'Enter Description']) !!}
                @error('fdata.description')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <div class="card-footer col-lg-12 ">
            <button type="button" wire:click="store('close')" class="btn btn-primary float-right mx-1">Save &
                Close</button>
            @if (!$this->record_id)
                <button type="button" wire:click="store('add')" class="btn btn-primary float-right mx-1">Save &
                    Add</button>
            @endif
        </div>


    </form>
</div>

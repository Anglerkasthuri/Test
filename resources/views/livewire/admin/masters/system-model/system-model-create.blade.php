<div>
    <form autocomplete="off">

        <div class="row p-3">
            <div class="form-group col-lg-6">
                {!! Form::label('fdata.title', 'System Model Title', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.title', old('fdata.title'), ['wire:model.defer' => 'fdata.title', 'class' => 'form-control ' . ($errors->has('fdata.title') ? ' is-invalid' : ''), 'placeholder' => 'Enter System Model']) !!}
                @error('fdata.title')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

			<div class="form-group col-lg-6">
                {!! Form::label('fdata.model_name', 'Model Name', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.model_name', old('fdata.model_name'), ['wire:model.defer' => 'fdata.model_name', 'class' => 'form-control ' . ($errors->has('fdata.model_name') ? ' is-invalid' : ''), 'placeholder' => 'Enter Model Name']) !!}
                @error('fdata.model_name')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

			<div class="form-group col-lg-6">
                {!! Form::label('fdata.field_name', 'Field Name', ['class' => 'control-label']) !!}
                {!! Form::text('fdata.field_name', old('fdata.field_name'), ['wire:model.defer' => 'fdata.field_name', 'class' => 'form-control ' . ($errors->has('fdata.field_name') ? ' is-invalid' : ''), 'placeholder' => 'Enter Field Name']) !!}
                @error('fdata.field_name')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
			
			<div class="form-check col-lg-6">
                {!! Form::label('show_in_form', 'Show in Form', ['class' => 'control-label']) !!}
                <div>
                    {!! Form::checkbox('fdata.show_in_form', 1, data_get($this->fdata, 'show_in_form'), ['wire:model.defer' => 'fdata.show_in_form', 'id' => 'fdata.show_in_form', 'class' => ' ' . ($errors->has('fdata.show_in_form') ? ' is-invalid' : '')]) !!}
                    @error('fdata.show_in_form')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
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

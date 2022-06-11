<div>
    <form autocomplete="off">

        <div class="row p-3">

            <div class="form-group col-lg-6">
                {!! Form::label('fdata.title', 'Form Title', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.title', old('fdata.title'), ['wire:model.defer' => 'fdata.title', 'class' => 'form-control ' . ($errors->has('fdata.title') ? ' is-invalid' : ''), 'placeholder' => 'Enter Form']) !!}
                @error('fdata.title')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
			
			<div class="form-group col-lg-6">
                {!! Form::label('fdata.sub_title', 'Sub Title', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.sub_title', old('fdata.sub_title'), ['wire:model.defer' => 'fdata.sub_title', 'class' => 'form-control ' . ($errors->has('fdata.sub_title') ? ' is-invalid' : ''), 'placeholder' => 'Enter Sub Title']) !!}
                @error('fdata.sub_title')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

			<div class="form-group col-lg-6">
                {!! Form::label('fdata.form_instruction', 'Instruction', ['class' => 'control-label required']) !!}
                {!! Form::textarea('fdata.form_instruction', old('fdata.form_instruction'), ['wire:model.defer' => 'fdata.form_instruction', 'class' => 'form-control ' . ($errors->has('fdata.form_instruction') ? ' is-invalid' : ''), 'placeholder' => 'Enter Instruction', "rows" => 4]) !!}
                @error('fdata.form_instruction')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

			<div class="form-group col-lg-6">
                {!! Form::label('fdata.description', 'Description', ['class' => 'control-label required']) !!}
                {!! Form::textarea('fdata.description', old('fdata.description'), ['wire:model.defer' => 'fdata.description', 'class' => 'form-control ' . ($errors->has('fdata.description') ? ' is-invalid' : ''), 'placeholder' => 'Enter Description' , "rows" => 4]) !!}
                @error('fdata.description')
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

<div>
    <form autocomplete="off">

        <div class="row p-3">
            <div class="form-group col-lg-6">
                {!! Form::label('fdata.title', 'Combined Intake', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.title', old('fdata.title'), ['wire:model.defer' => 'fdata.title', 'class' => 'form-control ' . ($errors->has('fdata.title') ? ' is-invalid' : ''), 'placeholder' => 'Enter Combined Intake']) !!}
                @error('fdata.title')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-6">
                {!! Form::label('fdata.month_id', 'Month', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.month_id', $this->monthList, 'S', ['wire:model' => 'fdata.month_id', 'id' => 'fdata.month_id', 'class' => 'form-control  ' . ($errors->has('fdata.month_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Month']) !!}
                @error('fdata.month_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

			<div class="form-group col-lg-6">
                {!! Form::label('fdata.year', 'Year', ['class' => 'control-label required']) !!}
                {!! Form::number('fdata.year', old('fdata.year'), ['wire:model.defer' => 'fdata.year', 'class' => 'form-control ' . ($errors->has('fdata.year') ? ' is-invalid' : ''), 'placeholder' => 'Enter Year']) !!}
                @error('fdata.year')
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
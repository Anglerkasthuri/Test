<div>
    <form autocomplete="off">

        <div class="row p-3">
            <div class="form-group col-lg-4">
                {!! Form::label('fdata.title', 'Exam Pattern', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.title', old('fdata.title'), ['wire:model.defer' => 'fdata.title', 'class' => 'form-control ' . ($errors->has('fdata.title') ? ' is-invalid' : ''), 'placeholder' => 'Enter Exam Pattern']) !!}
                @error('fdata.title')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-lg-4">
                {!! Form::label('fdata.campus_id', 'Campus', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.campus_id', $this->campusList, 'S', ['wire:model.defer' => 'fdata.campus_id', 'id' => 'fdata.campus_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.campus_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Campus']) !!}
                @error('fdata.campus_id')
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

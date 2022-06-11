<div>
    <form autocomplete="off">

        <div class="row p-3">
            <div class="form-group col-lg-6">
                {!! Form::label('fdata.title', 'Template Name', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.title', old('fdata.title'), ['wire:model.defer' => 'fdata.title', 'class' => 'form-control ' . ($errors->has('fdata.title') ? ' is-invalid' : ''), 'placeholder' => 'Enter Template Name']) !!}
                @error('fdata.title')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

			<div class="form-group col-lg-6">
                {!! Form::label('fdata.code', 'Code', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.code', old('fdata.code'), ['wire:model.defer' => 'fdata.code', 'class' => 'form-control ' . ($errors->has('fdata.code') ? ' is-invalid' : ''), 'placeholder' => 'Enter Template Name']) !!}
                @error('fdata.code')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-12">
                {!! Form::label('fdata.subject', 'Subject', ['class' => 'control-label required']) !!}
                {!! Form::textarea('fdata.subject', old('fdata.subject'), ['wire:model.defer' => 'fdata.subject', 'class' => 'ckeditor form-control ' . ($errors->has('fdata.subject') ? ' is-invalid' : ''), 'placeholder' => 'Enter Subject', "rows" => 3]) !!}
                @error('fdata.subject')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

			<div class="form-group col-lg-12">
                {!! Form::label('fdata.content', 'Content', ['class' => 'control-label required']) !!}
                {!! Form::textarea('fdata.content', old('fdata.content'), ['wire:model.defer' => 'fdata.content', 'class' => 'ckeditor form-control ' . ($errors->has('fdata.content') ? ' is-invalid' : ''), 'placeholder' => 'Enter Content' , "rows" => 4]) !!}
                @error('fdata.content')
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

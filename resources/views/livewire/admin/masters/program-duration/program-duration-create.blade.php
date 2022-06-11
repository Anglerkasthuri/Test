<div>
  <form autocomplete="off">

    <div class="row p-3">

      <div class="form-group col-lg-6">
        {!! Form::label('fdata.title', 'Program Duration', ['class' => 'control-label required']) !!}
        {!! Form::text('fdata.title', old('fdata.title'), ['wire:model.defer' => 'fdata.title', 'class' => 'form-control ' . ($errors->has('fdata.title') ? ' is-invalid' : ''),  'placeholder' => 'Enter Program Duration']) !!}
        @error('fdata.title')
          <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
      
    <div class="form-group col-lg-6">
      {!! Form::label('fdata.years', 'Year(s)', ['class' => 'control-label required']) !!}
      {!! Form::number('fdata.years', old('fdata.years'), ['wire:model.defer' => 'fdata.years', 'class' => 'form-control ' . ($errors->has('fdata.years') ? ' is-invalid' : ''),  'placeholder' => 'Enter Year(s)']) !!}
      @error('fdata.years')
        <span class="error invalid-feedback">{{ $message }}</span>
      @enderror
  </div>

  <div class="form-group col-lg-6">
    {!! Form::label('fdata.months', 'Month(s)', ['class' => 'control-label required']) !!}
    {!! Form::number('fdata.months', old('fdata.months'), ['wire:model.defer' => 'fdata.months', 'class' => 'form-control ' . ($errors->has('fdata.months') ? ' is-invalid' : ''),  'placeholder' => 'Enter Month(s)']) !!}
    @error('fdata.months')
      <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
  </div>

  <div class="form-group col-lg-6">
    {!! Form::label('fdata.weeks', 'Week(s)', ['class' => 'control-label required']) !!}
    {!! Form::number('fdata.weeks', old('fdata.weeks'), ['wire:model.defer' => 'fdata.weeks', 'class' => 'form-control ' . ($errors->has('fdata.weeks') ? ' is-invalid' : ''),  'placeholder' => 'Enter Week(s)']) !!}
    @error('fdata.weeks')
      <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
  </div>
    <div class="form-check col-lg-6">
      {!! Form::label('active', 'Active', ['class' => 'control-label']) !!}
      <div>
        {!! Form::checkbox('fdata.active', 1, data_get($this->fdata, 'active'),['wire:model.defer' => 'fdata.active', 'id' => 'fdata.active', 'class' => ' ' . ($errors->has('fdata.active') ? ' is-invalid' : '')]) !!}
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
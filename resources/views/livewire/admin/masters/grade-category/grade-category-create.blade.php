<div>
  <form autocomplete="off">

    <div class="row p-3">
      <div class="form-group col-lg-6">
        {!! Form::label('fdata.title', 'Grade Category', ['class' => 'control-label required']) !!}
        {!! Form::text('fdata.title', old('fdata.title'), ['wire:model.defer' => 'fdata.title', 'class' => 'form-control ' . ($errors->has('fdata.title') ? ' is-invalid' : ''),  'placeholder' => 'Enter Grade Category']) !!}
        @error('fdata.title')
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
          
    <div class="form-check col-lg-6">
      {!! Form::label('internal_calculation_available', 'Internal Calculation Available', ['class' => 'control-label']) !!}
      <div>
        {!! Form::checkbox('fdata.internal_calculation_available', 1, data_get($this->fdata, 'internal_calculation_available'),['wire:model.defer' => 'fdata.internal_calculation_available', 'id' => 'fdata.internal_calculation_available', 'class' => ' ' . ($errors->has('fdata.internal_calculation_available') ? ' is-invalid' : '')]) !!}
        @error('fdata.internal_calculation_available')
          <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
      </div>
    </div>
      
    <div class="form-check col-lg-6">
      {!! Form::label('external_calculation_available', 'External Calculation Available', ['class' => 'control-label']) !!}
      <div>
        {!! Form::checkbox('fdata.external_calculation_available', 1, data_get($this->fdata, 'external_calculation_available'),['wire:model.defer' => 'fdata.external_calculation_available', 'id' => 'fdata.external_calculation_available', 'class' => ' ' . ($errors->has('fdata.external_calculation_available') ? ' is-invalid' : '')]) !!}
        @error('fdata.external_calculation_available')
          <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
      </div>
    </div>
      
    {{-- <div class="form-check col-lg-6">
      {!! Form::label('final_calculation_available', 'Final Calculation Available', ['class' => 'control-label']) !!}
      <div>
        {!! Form::checkbox('fdata.final_calculation_available', 1, data_get($this->fdata, 'final_calculation_available'),['wire:model.defer' => 'fdata.final_calculation_available', 'id' => 'fdata.final_calculation_available', 'class' => ' ' . ($errors->has('fdata.final_calculation_available') ? ' is-invalid' : '')]) !!}
        @error('fdata.final_calculation_available')
          <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
      </div>
    </div> --}}

  </div>
  <div class="card-footer col-lg-12 ">
    <button type="button" wire:click="store()" class="btn btn-primary float-right mx-1">Submit</button>
  </div>
  </form>
</div>
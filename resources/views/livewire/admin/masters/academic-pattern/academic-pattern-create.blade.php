<div>
  <form autocomplete="off">

    <div class="row p-3">
      <div class="form-group col-lg-6">
        {!! Form::label('fdata.title', 'Academic Pattern', ['class' => 'control-label required']) !!}
        {!! Form::text('fdata.title', old('fdata.title'), ['wire:model.defer' => 'fdata.title', 'class' => 'form-control ' . ($errors->has('fdata.title') ? ' is-invalid' : ''),  'placeholder' => 'Enter Academic Pattern']) !!}
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

  </div>
  <div class="card-footer col-lg-12 ">
    <button type="button" wire:click="store()" class="btn btn-primary float-right mx-1">Submit</button>
  </div>
  </form>
</div>
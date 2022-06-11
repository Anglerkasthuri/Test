<div>
  <form autocomplete="off">
    <div class="row p-3">
      <div class="form-group col-lg-4">
        {!! Form::label('fdata.name', 'Role', ['class' => 'control-label required']) !!}
        {!! Form::text('fdata.name', "", ['wire:model.defer' => 'fdata.name', 'class' => 'form-control ' . ($errors->has('fdata.name') ? ' is-invalid' : ''), 'placeholder' => 'Enter Role']) !!}
        @error('fdata.name')
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
      <button type="button" wire:click="store()" class="btn btn-primary float-right mx-1">Submit</button>
    </div>
    

  </form>
</div>
<div>
  <form>
    <div class="row p-3">
      <div class="form-group col-lg-3">
        {!! Form::label('fdata.title', 'Country Name', ['class' => 'control-label required']) !!}
        {{-- <input type="text" class="form-control @error('fdata.title') is-invalid @enderror" wire:model="fdata.title" id="fdata.title" placeholder="Enter Country Name"> --}}
        {!! Form::text('fdata.title', old('fdata.title'), ['wire:model.defer' => 'fdata.title', 'class' => 'form-control ' . ($errors->has('fdata.title') ? ' is-invalid' : ''),  'placeholder' => 'Enter Country Name']) !!}
        @error('fdata.title')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
      </div>
      <div class="form-group col-lg-3">
        {!! Form::label('fdata.nationality', 'Nationality', ['class' => 'control-label required']) !!}
        {!! Form::text('fdata.nationality', old('fdata.nationality'), ['wire:model.defer' => 'fdata.nationality', 'class' => 'form-control ' . ($errors->has('fdata.nationality') ? ' is-invalid' : ''),  'placeholder' => 'Enter Nationality']) !!}
        @error('fdata.nationality')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
      </div>
      <div class="form-group col-lg-3">
        {!! Form::label('fdata.dial_code', 'Dial Code', ['class' => 'control-label required']) !!}
        {!! Form::text('fdata.dial_code', old('fdata.dial_code'), ['wire:model.defer' => 'fdata.dial_code', 'class' => 'form-control ' . ($errors->has('fdata.dial_code') ? ' is-invalid' : ''),  'placeholder' => 'Enter Dial Code']) !!}
        @error('fdata.dial_code')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group col-lg-3">
        {!! Form::label('fdata.iso2_code', 'ISO2 Code', ['class' => 'control-label required']) !!}
        {!! Form::text('fdata.iso2_code', old('fdata.iso2_code'), ['wire:model.defer' => 'fdata.iso2_code', 'class' => 'form-control ' . ($errors->has('fdata.iso2_code') ? ' is-invalid' : ''),  'placeholder' => 'Enter ISO2 Code']) !!}
        @error('fdata.iso2_code')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group col-lg-3">
        {!! Form::label('fdata.iso3_code', 'ISO3 Code', ['class' => 'control-label required']) !!}
        {!! Form::text('fdata.iso3_code', old('fdata.iso3_code'), ['wire:model.defer' => 'fdata.iso3_code', 'class' => 'form-control ' . ($errors->has('fdata.iso3_code') ? ' is-invalid' : ''),  'placeholder' => 'Enter ISO3 Code']) !!}
        @error('fdata.iso3_code')
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
      </div>

        <div class="form-group col-lg-3" >
            {!! Form::label('fdata.continent_id', 'Continent', ['class' => 'control-label required']) !!}
            {!! Form::select('fdata.continent_id', $this->continentList, 'S', ['wire:model' => 'fdata.continent_id', 'id' => 'fdata.continent_id', 'class' => 'form-control selectpicker ' . ($errors->has('fdata.continent_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Continent', 'data-liveSearch' => true, 'data-style' => "dropdown-toggle form-control custom-select-picker bs-placeholder"]) !!} 
            @error('fdata.continent_id')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group col-lg-3" >
            {!! Form::label('sub_continent_id', 'Sub Continent', ['class' => 'control-label required']) !!}
            
           <div>
            {!! Form::select('fdata.sub_continent_id', $this->subContinentList, 'S', ['wire:model' => 'fdata.sub_continent_id', 'id' => 'fdata.sub_continent_id', 'class' => 'form-control  selectpicker ' . ($errors->has('fdata.sub_continent_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Sub Continent', 'data-liveSearch' => true, 'data-style' => "dropdown-toggle form-control custom-select-picker bs-placeholder"]) !!} 
           </div>
            
            
            @error('fdata.sub_continent_id')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group col-lg-3" >
            {!! Form::label('timezone_id', 'Timezone', ['class' => 'control-label required']) !!}
            
            <div>
              {!! Form::select('fdata.timezone_id', $this->timezoneList, 'S', ['wire:model.defer' => 'fdata.timezone_id', 'id' => 'fdata.timezone_id', 'class' => 'form-control selectpicker  ' . ($errors->has('fdata.timezone_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Timezone','data-liveSearch' => true, 'data-style' => "dropdown-toggle form-control custom-select-picker bs-placeholder"]) !!} 
             </div>
              
            
            @error('fdata.timezone_id')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-check col-lg-3">
          {!! Form::label('active',
          'Active', ['class' => 'control-label']) !!}
          <div>
            {!! Form::checkbox('fdata.active', 1, data_get($this->fdata, 'active'), ['wire:model.defer' => 'fdata.active', 'id' => 'fdata.active', 'class' => '  ' . ($errors->has('fdata.active') ? ' is-invalid' : '')]) !!}
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
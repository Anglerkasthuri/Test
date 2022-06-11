<div>
    <form autocomplete="off" enctype="multipart/form-data">
        <div class="row p-3">

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.first_name', 'First Name', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.first_name', '', ['wire:model.defer' => 'fdata.first_name', 'class' => 'form-control ' . ($errors->has('fdata.first_name') ? ' is-invalid' : ''), 'placeholder' => 'Enter Name']) !!}
                @error('fdata.first_name')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.last_name', 'Last Name', ['class' => 'control-label']) !!}
                {!! Form::text('fdata.last_name', '', ['wire:model.defer' => 'fdata.last_name', 'class' => 'form-control ' . ($errors->has('fdata.last_name') ? ' is-invalid' : ''), 'placeholder' => 'Enter Name']) !!}
                @error('fdata.last_name')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.date_of_birth', 'DOB', ['class' => 'control-label required']) !!}
                {!! Form::date('fdata.date_of_birth', '', ['wire:model.defer' => 'fdata.date_of_birth', 'class' => 'form-control ' . ($errors->has('fdata.date_of_birth') ? ' is-invalid' : ''), 'placeholder' => 'Enter Name']) !!}
                @error('fdata.date_of_birth')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.gender_id', 'Gender', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.gender_id', $this->genderList, null, ['wire:model' => 'fdata.gender_id', 'id' => 'fdata.gender_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.gender_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Gender']) !!}
                @error('fdata.gender_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.country_id', 'Country', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.country_id', $this->countryList, null, ['wire:model' => 'fdata.country_id', 'id' => 'fdata.country_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.country_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Country']) !!}
                @error('fdata.country_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.natinality_id', 'Natinality', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.natinality_id', $this->nationalityList, null, ['wire:model' => 'fdata.natinality_id', 'id' => 'fdata.natinality_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.natinality_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Nationality']) !!}
                @error('fdata.natinality_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.email', 'Email', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.email', '', ['wire:model.defer' => 'fdata.email', 'class' => 'form-control ' . ($errors->has('fdata.email') ? ' is-invalid' : ''), 'placeholder' => 'Enter Email']) !!}
                @error('fdata.email')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.password', 'Password', ['class' => 'control-label required']) !!}
                {!! Form::input('password', 'fdata.password', '', ['wire:model.defer' => 'fdata.password', 'class' => 'form-control ' . ($errors->has('fdata.password') ? ' is-invalid' : ''), 'placeholder' => 'Enter Strong Password']) !!}
                @error('fdata.password')
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

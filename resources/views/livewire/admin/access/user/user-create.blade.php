<div>
    <form autocomplete="off" enctype="multipart/form-data">
        <div class="row p-3">

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.name', 'Name', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.name', '', ['wire:model.defer' => 'fdata.name', 'class' => 'form-control ' . ($errors->has('fdata.name') ? ' is-invalid' : ''), 'placeholder' => 'Enter Name', 'readonly' => 'readonly']) !!}
                @error('fdata.name')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.email', 'Email', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.email', '', ['wire:model.defer' => 'fdata.email', 'class' => 'form-control ' . ($errors->has('fdata.email') ? ' is-invalid' : ''), 'placeholder' => 'Enter Email', 'readonly' => 'readonly']) !!}
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
            <div class="form-group col-lg-4"  >
                {!! Form::label('fdata.roles', 'Roles', ['class' => 'control-label']) !!}
                <div>
                    {!! Form::select('fdata.roles', $this->roleList, '', ['wire:model.defer' => 'fdata.roles', 'id' => 'fdata.roles', 'class' => 'form-control  m-select-1' . ($errors->has('fdata.roles') ? ' is-invalid' : ''), 'multiple' => 'multiple']) !!}
                    @error('fdata.roles')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group col-lg-4">
				{!! Form::label('fdata.profile_photo_path', 'Profile', ['class' => 'control-label']) !!}
				{!! Form::file('fdata.profile_photo_path', ['wire:model' => 'fdata.profile_photo_path', 'class' => 'form-control '.($errors->has('fdata.profile_photo_path') ? ' is-invalid' : ''), 'placeholder' => '']) !!}
						
				@error('fdata.profile_photo_path')
					<span class="error invalid-feedback">{{ $message }}</span>
				@enderror
                </div>
            </div>
            {{-- <div class="form-check col-lg-4">
				{!! Form::label('active', 'Active', ['class' => 'control-label']) !!}
				<div>
					{!! Form::checkbox('fdata.active', 1, data_get($this->fdata, 'active'), ['wire:model.defer' => 'fdata.active', 'id' => 'fdata.active', 'class' => ' ' . ($errors->has('fdata.active') ? ' is-invalid' : '')]) !!}
					@error('fdata.active')
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

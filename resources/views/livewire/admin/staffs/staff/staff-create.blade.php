<div>
    <form autocomplete="off" enctype="multipart/form-data">
        <div class="row p-3">

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.title', 'Name', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.title', '', ['wire:model.defer' => 'fdata.title', 'class' => 'form-control ' . ($errors->has('fdata.title') ? ' is-invalid' : ''), 'placeholder' => 'Enter Name']) !!}
                @error('fdata.title')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.date_of_joined', 'Date Of Join', ['class' => 'control-label required']) !!}
                {!! Form::date('fdata.date_of_joined', '', ['wire:model.defer' => 'fdata.date_of_joined', 'class' => 'form-control ' . ($errors->has('fdata.date_of_joined') ? ' is-invalid' : ''), 'placeholder' => 'Enter Date Of Join']) !!}
                @error('fdata.date_of_joined')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.employee_code', 'Employee Code', ['class' => 'control-label required']) !!}
                {!! Form::text('fdata.employee_code', '', ['wire:model.defer' => 'fdata.employee_code', 'class' => 'form-control ' . ($errors->has('fdata.employee_code') ? ' is-invalid' : ''), 'placeholder' => 'Enter Employee Code']) !!}
                @error('fdata.employee_code')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.date_of_birth', 'Date Of Birth', ['class' => 'control-label required']) !!}
                {!! Form::date('fdata.date_of_birth', '', ['wire:model.defer' => 'fdata.date_of_birth', 'class' => 'form-control ' . ($errors->has('fdata.date_of_birth') ? ' is-invalid' : ''), 'placeholder' => 'Enter Date Of Birth']) !!}
                @error('fdata.date_of_birth')
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
                {!! Form::label('fdata.gender_id', 'Gender', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.gender_id', $this->genderList, null, ['wire:model' => 'fdata.gender_id', 'id' => 'fdata.gender_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.gender_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Gender']) !!}
                @error('fdata.gender_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.staff_type_id', 'Staff Type', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.staff_type_id', $this->staffTypeList, null, ['wire:model' => 'fdata.staff_type_id', 'id' => 'fdata.staff_type_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.staff_type_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Staff Type']) !!}
                @error('fdata.staff_type_id')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-4">
                {!! Form::label('fdata.work_type_id', 'Work Type', ['class' => 'control-label required']) !!}
                {!! Form::select('fdata.work_type_id', $this->workTypeList, null, ['wire:model' => 'fdata.work_type_id', 'id' => 'fdata.work_type_id', 'class' => 'form-control  m-select-1 ' . ($errors->has('fdata.work_type_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Work Type']) !!}
                @error('fdata.work_type_id')
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

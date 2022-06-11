<div>
    <form autocomplete="off">

        <div class="row p-3">
            <div class="col-lg-6">
                <div class="row">

                    <div class="form-group col-lg-6">
                        {!! Form::label('fdata.title', 'Accreditation', ['class' => 'control-label required']) !!}
                        {!! Form::text('fdata.title', old('fdata.title'), ['wire:model.defer' => 'fdata.title', 'class' => 'form-control ' . ($errors->has('fdata.title') ? ' is-invalid' : ''), 'placeholder' => 'Enter Accreditation']) !!}
                        @error('fdata.title')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6">
                        {!! Form::label('fdata.country_id', 'Country', ['class' => 'control-label required']) !!}
                        {!! Form::select('fdata.country_id', $this->countryList, 'S', ['wire:model.defer' => 'fdata.country_id', 'id' => 'fdata.country_id', 'class' => 'form-control  ' . ($errors->has('fdata.country_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Country']) !!}
                        @error('fdata.country_id')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-12">
                        {!! Form::label('fdata.address', 'Address', ['class' => 'control-label ']) !!}
                        {!! Form::textarea('fdata.address', old('fdata.address'), ['wire:model.defer' => 'fdata.address', 'class' => 'form-control ' . ($errors->has('fdata.address') ? ' is-invalid' : ''), 'placeholder' => 'Enter Address', 'rows' => 5]) !!}
                        @error('fdata.address')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">

                    <div class="form-group col-lg-6">
                        {!! Form::label('fdata.contact_number1', 'Contact #1', ['class' => 'control-label ']) !!}
                        {!! Form::text('fdata.contact_number1', old('fdata.contact_number1'), ['wire:model.defer' => 'fdata.contact_number1', 'class' => 'form-control ' . ($errors->has('fdata.contact_number1') ? ' is-invalid' : ''), 'placeholder' => 'Enter Contact 1']) !!}
                        @error('fdata.contact_number1')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6">
                        {!! Form::label('fdata.contact_number2', 'Contact #2', ['class' => 'control-label ']) !!}
                        {!! Form::text('fdata.contact_number2', old('fdata.contact_number2'), ['wire:model.defer' => 'fdata.contact_number2', 'class' => 'form-control ' . ($errors->has('fdata.contact_number2') ? ' is-invalid' : ''), 'placeholder' => 'Enter Contact 2']) !!}
                        @error('fdata.contact_number2')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6">
                        {!! Form::label('fdata.whatsapp_number', 'Whatsapp #', ['class' => 'control-label ']) !!}
                        {!! Form::text('fdata.whatsapp_number', old('fdata.whatsapp_number'), ['wire:model.defer' => 'fdata.whatsapp_number', 'class' => 'form-control ' . ($errors->has('fdata.whatsapp_number') ? ' is-invalid' : ''), 'placeholder' => 'Enter Whatsapp']) !!}
                        @error('fdata.whatsapp_number')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6">
                        {!! Form::label('fdata.fax_number', 'Fax #', ['class' => 'control-label ']) !!}
                        {!! Form::text('fdata.fax_number', old('fdata.fax_number'), ['wire:model.defer' => 'fdata.fax_number', 'class' => 'form-control ' . ($errors->has('fdata.fax_number') ? ' is-invalid' : ''), 'placeholder' => 'Enter Fax Number']) !!}
                        @error('fdata.fax_number')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6">
                        {!! Form::label('fdata.email_address', 'Email', ['class' => 'control-label ']) !!}
                        {!! Form::text('fdata.email_address', old('fdata.email_address'), ['wire:model.defer' => 'fdata.email_address', 'class' => 'form-control ' . ($errors->has('fdata.email_address') ? ' is-invalid' : ''), 'placeholder' => 'Enter Email']) !!}
                        @error('fdata.email_address')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6">
                        {!! Form::label('fdata.skype', 'Skype', ['class' => 'control-label ']) !!}
                        {!! Form::text('fdata.skype', old('fdata.skype'), ['wire:model.defer' => 'fdata.skype', 'class' => 'form-control ' . ($errors->has('fdata.skype') ? ' is-invalid' : ''), 'placeholder' => 'Enter Skype']) !!}
                        @error('fdata.skype')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">

                    <div class="form-group col-lg-6">
                        {!! Form::label('fdata.expiry_date', 'Expiry Date', ['class' => 'control-label ']) !!}
                        {!! Form::date('fdata.expiry_date', old('fdata.expiry_date'), ['wire:model.defer' => 'fdata.expiry_date', 'class' => 'form-control ' . ($errors->has('fdata.expiry_date') ? ' is-invalid' : ''), 'placeholder' => 'Enter Expiry Date']) !!}
                        @error('fdata.expiry_date')
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
            </div>
        </div>
        <div class="card-footer col-lg-12 ">
            <button type="button" wire:click="store()" class="btn btn-primary float-right mx-1">Submit</button>
        </div>
    </form>
</div>

@include('livewire.common.push_items')

<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <h1>Form</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Form</li>
                    </ol>
                </div>
                <div class="col-sm-4 action-tools">
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $this->form->title ?? __("msg.na")}}</h5>
                        </div>
                        <div class="card-body">
                            {{-- @dump($errors->all())  --}}
                            @foreach ($this->formFields as  $form_field)

                                @switch($form_field["type"] ?? null)

                                    //Master Option Select
                                    @case("master-option-select")
                                        <div class="form-group {{ ($errors->has($form_field["id"]) ? ' form-error' : '')}}">
                                            {!! Form::label($form_field["id"], $form_field['label']['value'],$form_field['label']['attributes']) !!}
                                            
                                            <x-forms.master-option-select wire:key="{{ now() }}"
                                                :formFieldId="$form_field['form_field_id']"
                                                :fieldAttributes="$form_field['field']">
                                            </x-forms.master-option-select>

                                            @error($form_field["id"])
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @break

                                    //system-model-select
                                    @case("system-model-select")
                                        <div class="form-group {{ ($errors->has($form_field["id"]) ? ' form-error' : '')}}">
                                            {!! Form::label($form_field["id"], $form_field['label']['value'],$form_field['label']['attributes']) !!}
                                            
                                            <x-forms.system-model-select wire:key="{{ now() }}"
                                                :formFieldId="$form_field['form_field_id']"
                                                :fieldAttributes="$form_field['field']">
                                            </x-forms.system-model-select>

                                            @error($form_field["id"])
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @break
                                    
                                    // Input
                                    @case("input")
                                    <div class="form-group {{ ($errors->has($form_field["id"]) ? ' form-error' : '')}}">
                                        {!! Form::label($form_field["id"], $form_field['label']['value'],$form_field['label']['attributes']) !!}
                                        <x-forms.input wire:key="{{ now() }}"
                                            :fieldAttributes="$form_field['field']">
                                        </x-forms.text>
                                        @error($form_field["id"])
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @break

                                    // TextArea
                                    @case("textarea")
                                    <div class="form-group {{ ($errors->has($form_field["id"]) ? ' form-error' : '')}}">
                                        {!! Form::label($form_field["id"], $form_field['label']['value'],$form_field['label']['attributes']) !!}
                                        
                                        <x-forms.text-area wire:key="{{ now() }}"
                                            :fieldAttributes="$form_field['field']">
                                        </x-forms.text-area>
                                        @error($form_field["id"])
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @break

                                    // Label / Heading / Paragraph
                                    @case("text")
                                    <div class="form-group {{ ($errors->has($form_field["id"]) ? ' form-error' : '')}}">
                                        <x-forms.text wire:key="{{ now() }}"
                                            :fieldAttributes="$form_field['label']">
                                        </x-forms.text-area>
                                        @error($form_field["id"])
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @break
                                @endswitch
                                
                            @endforeach
                        </div>
                       <div class="card-footer">
                        <button type="button" class="btn btn-success" wire:click="store()">
                            Store
                        </button>
                       </div>
                    </div>
                     <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

    <x-common.modal wire:key="{{ now() }}"
        :modal_section_id="'modalCreate'">
        <x-slot name="modal_title">
            Form
        </x-slot>
        <x-slot name="modal_size">
            modal-lg
        </x-slot>
        <x-slot name="modal_body">
        </x-slot>
    </x-common.modal>

</div>

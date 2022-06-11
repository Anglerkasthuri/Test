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
                            <h5>{{ $this->form->title ?? __('msg.na') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($this->table_headers as $table_header)
                                    @switch ($table_header->form_field_type->code)
                                        @case('heading')
                                            <div class="col-lg-12">
                                                <h6>{{ $table_header->title }}</h6>
                                            </div>
                                        @break

                                        @case('label')
                                            {{-- <p>{{ $table_header->title }}</p> --}}
                                        @break

                                        @default
                                            <div class="col-lg-6">
                                                <label class="col-lg-12 view-label">{{ $table_header->title }}</label>
                                                <p class="col-lg-12 view-record">
                                                    {!! __showValue($this->getFormDataValue($table_header->id, collect($record->data)[$table_header->id] ?? null)) !!}
                                                </p>
                                                <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>
                                            </div>
                                    @endswitch
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">

                                <div class="col-lg-3">
                                    <label class="col-lg-12 view-label">Form Filled By</label>
                                    <p class="col-lg-12 view-record">
                                        {{ $record->created_by->name }}
                                    </p>
                                </div>

                                <div class="col-lg-3">
                                    <label class="col-lg-12 view-label">Form Filled At</label>
                                    <p class="col-lg-12 view-record">
                                        {{ $record->created_at_display }}
                                    </p>
                                </div>

                                <div class="col-lg-3">
                                    <label class="col-lg-12 view-label">Form Updated By</label>
                                    <p class="col-lg-12 view-record">
                                        {{ $record->updated_by->name }}
                                    </p>
                                </div>

                                <div class="col-lg-3">
                                    <label class="col-lg-12 view-label">Form Updated At</label>
                                    <p class="col-lg-12 view-record">
                                        {{ $record->updated_at_display }}
                                    </p>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
    </section>

    <x-common.modal wire:key="{{ now() }}" :modal_section_id="'modalCreate'">
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

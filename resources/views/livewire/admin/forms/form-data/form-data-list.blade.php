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

                    <a target="_blank" class="btn btn-icon text-info btn-sm" href="{{ route('form-preview',$this->form_id) }}">
                        <i class="fa fa-add"> </i>
                    </a>

                    <a class="btn btn-icon text-warning btn-sm" data-toggle="collapse" data-target="#filter_collapse"
                        aria-expanded="false" aria-controls="collapseExample">
                        <i title="Filter" class="fa fa-filter"> </i>
                    </a>
                    
                    <a target="_blank" class="btn btn-icon text-info btn-sm" href="{{ route('model-log',class_basename($this->model)) }}">
                        <i class="fa fa-history"> </i>
                    </a>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card card-outline card-info">
                        <div class="card-body">
                            @include('livewire.admin.forms.form-details')
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body p-0">
                            <div wire:ignore class="filter-section collapse" id="filter_collapse">
                                @include('livewire.admin.forms.form-data.form-data-filter')
                            </div>
                            @include('livewire.common.facet')
                            <div class=" table-responsive p-0">
                                <table class="table  text-nowrap" >
                                    <thead>
                                        <tr>
                                            <th class="action">Action</th>
                                            <th>#</th>
                                            @foreach ($this->table_headers as $table_header)
                                               <th>{{ $table_header->title }}</th> 
                                            @endforeach
                                            <th wire:click="sortBy('id')"
                                                class="{{ $this->sortFieldData['id']['css_class'] ?? 'sortby' }}">ID
                                            </th>
                                            <th wire:click="sortBy('active')"
                                                class="{{ $this->sortFieldData['active']['css_class'] ?? 'sortby' }}">
                                                Active</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($records  as $index => $record)
                                            <tr class="{{ empty($record->active) ? ' table-disable ' : '' }}">
                                                <td>
                                                    <a target="_blank" class="btn btn-icon text-info btn-sm" href="{{ route('form-data-edit',$record->id) }}">
                                                        <i class="fa fa-pencil"> </i>
                                                    </a>      
                                                                                        
                                                    <a target="_blank" class="btn btn-icon text-info btn-sm" href="{{ route('form-data-view',$record->id) }}">
                                                        <i class="fa fa-eye"> </i>
                                                    </a>      
                                                </td>
                                                <td>
                                                    <a href="{{ route( 'record-log', [ class_basename($this->model), $record->id] ) }}" target="_blank" class="btn btn-icon btn-sm" data-toggle="popover_" data-trigger="hover" data-content="Log" data-placement="top">
                                                        {{ $index + $records->firstItem() }}
                                                    </a>
                                                </td>
                                                @foreach ($this->table_headers as $table_header)
                                                    <td>{!! nl2br(__showValue($this->getFormDataValue($table_header->id,collect($record->data)[$table_header->id] ?? null))) !!}</td> 
                                                @endforeach
                                                <td>{{ $record->id }}</td>
                                                <td><span class="{{ config('settings.active_field_options')[$record->active]['class'] }}"> {{ config('settings.active_field_options')[$record->active]['display'] }} </span>
                                            </tr>
                                        @empty
                                            <tr class="odd">
                                                <td valign="top" colspan="12" class="dataTables_empty"><span>{{ __('msg.no_records') }}</span></td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>

                            @include('livewire.common.pagination')
                            <!-- /. p-0 -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-common.modal wire:key="{{ now() }}"
        :modal_section_id="'modalCreate'">
        <x-slot name="modal_title">
            Form Field
        </x-slot>
        <x-slot name="modal_size">
            modal-lg
        </x-slot>
        <x-slot name="modal_body">
        </x-slot>
    </x-common.modal>

</div>

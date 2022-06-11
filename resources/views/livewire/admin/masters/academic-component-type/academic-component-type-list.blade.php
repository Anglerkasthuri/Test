@include('livewire.common.push_items')
<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Academic Component Type</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Academic Component Type</li>
                    </ol>
                </div>
                <div class="col-sm-6 action-tools">

                    <button wire:click="create()" class="btn btn-sm btn-icon text-primary" data-toggle="modal"
                        data-target="#modalCreate">
                        <i class="fa fa-add"></i>
                    </button>

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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div wire:ignore class="filter-section collapse" id="filter_collapse">
                                @include('livewire.admin.masters.academic-component-type.academic-component-type-filter')
                            </div>
                            @include('livewire.common.facet')
                            <div class=" table-responsive p-0">
                                <table class="table table-head-fixed text-nowrap" wire:loading.class="loading">
                                    <thead>
                                        <tr>
                                            <th class="action">Action</th>
                                            <th>#</th>                                            
                                            <th wire:click="sortBy('title')"
                                                class="{{ $this->sortFieldData['title']['css_class'] ?? 'sortby' }}">
                                                Academic Component Type</th>      
                                            <th>Campus</th>
                                            <th>Academic Component Group</th>
                                            <th>Academic Component Category</th>
                                            <th wire:click="sortBy('sequence_number')" class="{{ $this->sortFieldData['sequence_number']['css_class'] ?? 'sortby' }}">Sequence</th>
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
                                                    <button data-toggle="modal" data-target="#modalCreate"
                                                        wire:click="edit({{ $record->id }})"
                                                        class="btn btn-icon text-primary btn-xs"><i
                                                            class="fa fa-edit"></i></button>
           
                                                </td>
                                                <td>
                                                    <a href="{{ route( 'record-log', [ class_basename($this->model), $record->id] ) }}" target="_blank" class="btn btn-icon btn-sm" data-toggle="popover_" data-trigger="hover" data-content="Log" data-placement="top">
                                                        {{ $index + $records->firstItem() }}
                                                    </a>
                                                </td>
                                                <td class="title">{{ $record->title }}</td>
                                                <td>{{ $record->campus->title ?? __('msg.na') }}</td>
                                                <td>{{ $record->academic_component_group->title ?? __('msg.na') }}</td>
                                                <td>{{ $record->academic_component_category->title ?? __('msg.na') }}</td>
                                                <td>{{ $record->sequence_number }}</td>
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
            Academic Component Type
        </x-slot>
        <x-slot name="modal_size">
            modal-lg
        </x-slot>
        <x-slot name="modal_body">
            @include('livewire.admin.masters.academic-component-type.academic-component-type-create')
        </x-slot>
    </x-common.modal>
</div>

@include('livewire.common.push_items')
<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Program</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Program</li>
                    </ol>
                </div>
                <div class="col-sm-6 action-tools">
                    
                    @if(__can('program-add'))
                        <button wire:click="create()" class="btn btn-sm btn-icon text-primary" data-toggle="modal"
                            data-target="#modalCreate" >
                            <span data-toggle="popover_" data-trigger="hover" data-content="Add" data-placement="top"><i class="fa fa-add"></i></span>
                        </button>
                    @endif
                    
                    <a class="btn btn-icon text-warning btn-sm" data-toggle="collapse" data-target="#filter_collapse"
                        aria-expanded="false" aria-controls="collapseExample">
                        <span data-toggle="popover_" data-trigger="hover" data-content="Filter" data-placement="top"><i class="fa fa-filter"></i></span>
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
                                @include('livewire.admin.masters.program.program-filter')
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
                                                Program</th>
                                            <th wire:click="sortBy('program_sub_category_id')"
                                                class="{{ $this->sortFieldData['program_sub_category_id']['css_class'] ?? 'sortby' }}">
                                                Program Sub Category</th>    
                                            <th wire:click="sortBy('program_level_id')"
                                                class="{{ $this->sortFieldData['program_level_id']['css_class'] ?? 'sortby' }}">
                                                Program Level</th>
                                            <th wire:click="sortBy('program_type_id')"
                                                class="{{ $this->sortFieldData['program_type_id']['css_class'] ?? 'sortby' }}">
                                                Program Type</th>                  
                                            <th wire:click="sortBy('program_duration_id')"
                                                class="{{ $this->sortFieldData['program_duration_id']['css_class'] ?? 'sortby' }}">
                                                Program Duration</th>
                                            <th wire:click="sortBy('academic_pattern_id')"
                                                class="{{ $this->sortFieldData['academic_pattern_id']['css_class'] ?? 'sortby' }}">
                                                Academic Pattern</th>
                                            <th wire:click="sortBy('number_of_pattern')"
                                                class="{{ $this->sortFieldData['number_of_pattern']['css_class'] ?? 'sortby' }}">
                                                Number of Pattern</th>
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
                                                    @if(__can('program-edit'))
                                                        <button data-toggle="modal" data-target="#modalCreate"
                                                            wire:click="edit({{ $record->id }})"
                                                            class="btn btn-icon text-primary btn-xs"><i
                                                                class="fa fa-edit"></i></button>
                                                    @endif
                                                    <a href="{{ route('program.view',$record->id) }}"><i
                                                    class="fa fa-eye"></i></a>
                                                </td>
                                                <td>
                                                    <a href="{{ route( 'record-log', [ class_basename($this->model), $record->id] ) }}" target="_blank" class="btn btn-icon btn-sm" data-toggle="popover_" data-trigger="hover" data-content="Log" data-placement="top">
                                                        {{ $index + $records->firstItem() }}
                                                    </a>
                                                </td>
                                                <td class="title">{{ $record->title }}</td>
                                                
                                                <td>{{ $record->program_sub_category->title ?? null }}</td>
                                                <td>{{ $record->program_level->title ?? null }}</td>
                                                <td>{{ $record->program_type->title ?? null }}</td>
                                                <td>{{ $record->program_duration->title ?? null }}</td>
                                                <td>{{ $record->academic_pattern->title ?? null }}</td>
                                                <td>{{ $record->number_of_pattern ?? null }}</td>
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
            Program
        </x-slot>
        <x-slot name="modal_size">
            modal-xl
        </x-slot>
        <x-slot name="modal_body">
            @include('livewire.admin.masters.program.program-create')
        </x-slot>
    </x-common.modal>

</div>
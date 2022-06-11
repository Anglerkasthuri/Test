@include('livewire.common.push_items')
<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>
                        Master Option 
                        @if($this->master_category_id)
                        of 
                        {{ $this->master_category_details->title }}
                        @endif
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Master Option</li>
                    </ol>
                </div>
                <div class="col-sm-6 action-tools">
                    @if($this->master_category_id)
                        <button wire:click="create()" class="btn btn-sm btn-icon text-primary" data-toggle="modal"
                            data-target="#modalCreate">
                            <i class="fa fa-add"></i>
                        </button>
                    @endif

                    <a class="btn btn-icon text-secondary btn-sm" data-toggle="collapse" data-target="#filter_collapse"
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
                                @include('livewire.admin.masters.master-option.master-option-filter')
                            </div>
                            @include('livewire.common.facet')

                            <!-- /.card-header -->
                            <div class=" table-responsive p-0">
                                <table class="table table-head-fixed text-nowrap" wire:loading.class="loading">
                                    <thead>
                                        <tr>
                                            <th class="action">Action</th>
                                            <th>#</th>

                                            @if(!empty($this->master_category_details))
                                                @if(!empty($this->master_category_details->is_dependent))
                                                    <th>{{  $this->master_category_details->parent_category->title ?? 'Dependent'}}</th>
                                                @endif
                                                <th wire:click="sortBy('title')" class="{{ $this->sortFieldData['title']['css_class'] ?? 'sortby' }}">{{  $this->master_category_details->title }}</th>
                                                <th wire:click="sortBy('code')" class="{{ $this->sortFieldData['code']['css_class'] ?? 'sortby' }}">Code</th>
                                            @else
                                                <th wire:click="sortBy('master_category_id')" class="{{ $this->sortFieldData['master_category_id']['css_class'] ?? 'sortby' }}">Master Category</th>
                                                <th wire:click="sortBy('title')" class="{{ $this->sortFieldData['title']['css_class'] ?? 'sortby' }}">Master Option</th>
                                                <th wire:click="sortBy('code')" class="{{ $this->sortFieldData['code']['css_class'] ?? 'sortby' }}">Code</th>
                                                <th>Parent Category</th>    
                                                <th>Parent Option</th>
                                            @endif
                                            
                                            
                                            <th wire:click="sortBy('sequence_number')" class="{{ $this->sortFieldData['sequence_number']['css_class'] ?? 'sortby' }}">Sequence</th>
                                            <th wire:click="sortBy('id')" class="{{ $this->sortFieldData['id']['css_class'] ?? 'sortby' }}">ID</th>
                                            <th wire:click="sortBy('active')" class="{{ $this->sortFieldData['active']['css_class'] ?? 'sortby' }}">Active</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($records  as $index => $record)
                                            <tr class="{{ empty($record->active) ? ' table-disable ' : '' }}">
                                                <td>
                                                    @if($this->master_category_id)
                                                    <button data-toggle="modal" data-target="#modalCreate" wire:click="edit({{ $record->id }})" class="btn btn-icon text-primary btn-xs"><i class="fa fa-edit"></i></button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route( 'record-log', [class_basename($this->model), $record->id] ) }}" target="_blank" class="btn btn-icon btn-sm" data-toggle="popover_" data-trigger="hover" data-content="Log" data-placement="top">
                                                        {{ $index + $records->firstItem() }}
                                                    </a>
                                                </td>
                                                @if(!empty($this->master_category_details))
                                                    @if(!empty($this->master_category_details->is_dependent))
                                                        <td>{{  $record->parent_option->title ?? __("msg.na") }}</td>
                                                    @endif
                                                    <td>{{  $record->title ?? __("msg.na") }}</td>
                                                    <td>{{ $record->code }}</td>
                                                @else
                                                    
                                                    <td>{{  $record->master_category->title ?? __("msg.na") }}</td>
                                                    <td>{{  $record->title ?? __("msg.na") }}</td>
                                                    <td>{{ $record->code }}</td>
                                                    @if(!empty($record->master_category->is_dependent))  
                                                        <td>{{  $record->master_category->parent_category->title ?? __("msg.na") }}</td>
                                                        <td>{{  $record->parent_option->title ?? __("msg.na") }}</td>
                                                    @else
                                                        <td>{{__("msg.na")}}</td>
                                                        <td>{{__("msg.na")}}</td>
                                                    @endif
                                                    
                                                @endif
                                               
                                                <td>{{ $record->sequence_number }}</td>
                                                <td>{{ $record->id }}</td>
                                                <td><span class="{{ config('settings.active_field_options')[$record->active]['class'] }}"> {{ config('settings.active_field_options')[$record->active]['display'] }} </span>
                                                </td>
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

    <div class="modal_section" >
        <x-common.modal wire:key="{{ now() }}" 
        :modal_section_id="'modalCreate'" >
            <x-slot name="modal_title">Master Option</x-slot>
            <x-slot name="modal_size">modal-lg</x-slot>
            <x-slot name="modal_header_action"></x-slot>
            <x-slot name="modal_body">
                @include('livewire.admin.masters.master-option.master-option-create')
            </x-slot>
        </x-common.modal>
    </div>

</div>

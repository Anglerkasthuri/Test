@include('livewire.common.push_items')
<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Enrollment</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Enrollment</li>
                    </ol>
                </div>
                <div class="col-sm-6 action-tools">

                    {{-- <button wire:click="create()" class="btn btn-sm btn-icon text-primary" data-toggle="modal"
                        data-target="#modalCreate">
                        <i class="fa fa-add"></i>
                    </button>

                    <a class="btn btn-icon text-warning btn-sm" data-toggle="collapse" data-target="#filter_collapse"
                        aria-expanded="false" aria-controls="collapseExample">
                        <i title="Filter" class="fa fa-filter"> </i>
                    </a>

                    <a target="_blank" class="btn btn-icon text-info btn-sm"
                        href="{{ route('model-log', class_basename($this->model)) }}">
                        <i class="fa fa-history"> </i>
                    </a> --}}

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
                            {{-- <div wire:ignore class="filter-section collapse" id="filter_collapse">
                                @include(
                                    'livewire.admin.reports.student-mark.student-mark-filter'
                                )
                            </div> --}}
                            @include('livewire.common.facet')
                           
                            <div class=" table-responsive p-0">
                                <table class="table first-child-fixed text-nowrap  nowrap report student-mark" wire:loading.class="loading">
                                    <thead>

                                       <tr>
                                           @foreach ($this->header["heading_enrollment"] as $item)
                                               <td class="font-weight-bold {{ $item['style_class'] ?? null}}" colspan="{{ $item['colspan'] }}">
                                                {!! $item['display'] !!}
                                               </td>
                                           @endforeach
                                       </tr>

                                       <tr>
                                            @foreach ($this->header["heading_course"] as $item)
                                                <td class="font-weight-bold {{ $item['style_class'] ?? null}}" colspan="{{ $item['colspan'] }}" style="width : {{ $item['width'] ?? null}}">
                                                   {!! $item['display'] !!}
                                                </td>
                                            @endforeach
                                        </tr>
                                        
                                        <tr>
                                            @foreach ($this->header["heading_group"] as $item)
                                                <td class="font-weight-bold {{ $item['style_class'] ?? null}}" colspan="{{ $item['colspan'] }}">
                                                   {!! $item['display'] !!}
                                                </td>
                                            @endforeach
                                        </tr>

                                        <tr>
                                            @foreach ($this->header["heading_type"] as $item)
                                                <td class="font-weight-bold {{ $item['style_class'] ?? null}}" colspan="{{ $item['colspan'] }}">
                                                   {!! $item['display'] !!}
                                                </td>
                                            @endforeach
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @forelse($this->students  as $student)
                                            <tr>
                                                @forelse($student as $detail)
                                                    <td class="{{ $detail['style_class'] ?? null}}">{{ $detail['display'] ?? null }}</td>
                                                @empty
                                                    <td>
                                                        <span>{{ __('msg.no_records') }}</span>
                                                    </td>
                                                @endforelse
                                            </tr>
                                        @empty
                                            <tr class="odd">
                                                <td valign="top" colspan="12" class="dataTables_empty">
                                                    <span>{{ __('msg.no_records') }}</span>
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>

                            {{-- @include('livewire.common.pagination') --}}
                            <!-- /. p-0 -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-common.modal wire:key="{{ now() }}" :modal_section_id="'modalCreate'">
        <x-slot name="modal_title">
            Enrollment
        </x-slot>
        <x-slot name="modal_size">
            modal-lg
        </x-slot>
        <x-slot name="modal_body">

        </x-slot>
    </x-common.modal>

</div>

@push('scripts')
    <script>
        // for Sidebar auto resize
        $('body').addClass('sidebar-collapse');
        $(window).trigger('resize');
    </script>
@endpush

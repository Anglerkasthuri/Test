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

                    <button wire:click="create()" class="btn btn-sm btn-icon text-primary" data-toggle="modal"
                        data-target="#modalCreate">
                        <i class="fa fa-add"></i>
                    </button>

                    {{-- <a target="_blank" class="btn btn-icon text-info btn-sm"
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

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card card-outline card-info">
                                <div class="card-body">
                                    @include(
                                        'livewire.admin.enrollments.enrollment-details'
                                    )
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <h6>Enrolled Courses</h6>
                                    {{-- <div class="col-lg-12 dropdown-divider mt-0"></div> --}}
                                    <div class="table-responsive">
                                        <table class="table table-head-fixed text-nowrap"
                                            wire:loading.class="loading">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>#</th>
                                                    <th>Code</th>
                                                    <th>Course Name</th>
                                                    <th>Campus</th>
                                                    <th>Program Category</th>
                                                    <th>Type</th>
                                                    <th>Credited Hours | Points</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($records  as $index => $record)
                                                    <tr class="{{ empty($record->active) ? ' table-disable ' : '' }}">
                                                        <td class="action">
                                                            <button type="button"
                                                                class="btn btn-sm btn-icon text-danger"
                                                                wire:click="$emit('triggerDelete', {{ $record->id }})">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                            
                                                            @if(__can("enrollment-exam-pattern-list"))
                                                            <a href="{{ route('enrollment.course.exam-pattern', [$record->id]) }}"
                                                                class="btn btn-sm btn-icon text-info" data-toggle="popover__" 
                                                                data-trigger="hover" data-content="Set Exam Pattern" data-placement="top">
                                                                <i class="fa fa-map-signs"></i> 
                                                            </a>
                                                            @endif
                                                            
                                                            @if(__can("enrollment-mark-list"))
                                                            @if( $record->enrollment_component_groups->count() > 0 )
                                                                <a href="{{ route('enrollment.course.mark', [$record->id]) }}"
                                                                    class="btn btn-sm btn-icon text-info" data-toggle="popover__" 
                                                                    data-trigger="hover" data-content="Set Student Mark" data-placement="top">
                                                                    <i class="fa fa-file-text"></i> 
                                                                </a>
                                                            @endif
                                                            @endif
                                                        </td>
                                                        <td>{{ $index + $records->firstItem() }}</td>
                                                        <td>{{ $record->course->code ?? __('msg.na') }}</td>
                                                        <td class="title">
                                                            {{ $record->course->title ?? __('msg.na') }}
                                                        </td>
                                                        <td>
                                                            {{ $record->course->campus->title ?? __('msg.na') }}
                                                        </td>
                                                        <td>
                                                            {{ $record->course->program_category->title ?? __('msg.na') }}
                                                        </td>
                                                        <td>{{ $record->course->course_type->title ?? __('msg.na') }}
                                                        </td>
                                                        <td>{{ $record->credited_hours ?? __('msg.na') }}</td>
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
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-common.modal wire:key="{{ now() }}" :modal_section_id="'modalCreate'">
        <x-slot name="modal_title">
            Enrollment Courses
        </x-slot>
        <x-slot name="modal_size">
            modal-xl
        </x-slot>
        <x-slot name="modal_body">
            @include(
                'livewire.admin.enrollments.enrollment-course.enrollment-course-create'
            )
        </x-slot>
    </x-common.modal>

    @push('scripts')
        <script type="text/javascript">
            // // for Sidebar auto resize
            // $('body').addClass('sidebar-collapse');
            // $(window).trigger('resize');

            //Delete Popup
            document.addEventListener('DOMContentLoaded', function() {
                @this.on('triggerDelete', id => {
                    Swal.fire({
                        title: 'Are You Sure?',
                        text: 'Record will be deleted!',
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: 'var(--success)',
                        cancelButtonColor: 'var(--primary)',
                        confirmButtonText: 'Delete!'
                    }).then((result) => {
                        //if user clicks on delete
                        if (result.value) {
                            // calling destroy method to delete
                            @this.call('delete', id)
                            // success respons
                        } else {}
                    });
                });
            })
        </script>
    @endpush
</div>
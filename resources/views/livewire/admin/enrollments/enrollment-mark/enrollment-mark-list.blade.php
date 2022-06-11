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
                            <div class="card card-outline card-info sticky-top">
                                <div class="card-body ">

                                    <h6 class="pt-3 text-primary">Couse Details</h6>
                                    <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>
                                    <div class="row">
                                        <label class="col-lg-12 view-label">Code | Course Name</label>
                                        <p class="col-lg-12 view-record">
                                            {{ $this->enrollment_course_details->course->code ?? __('msg.na') }}
                                            |
                                            {{ $this->enrollment_course_details->course->title ?? __('msg.na') }}
                                        </p>
                                    </div>

                                    <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>
                                    <div class="row">
                                        <label class="col-lg-12 view-label">Campus / Program Category</label>
                                        <p class="col-lg-12 view-record">
                                            {{ $this->enrollment_course_details->course->code ?? __('msg.na') }}
                                        </p>
                                    </div>

                                    <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>

                                    <div class="row">
                                        <label class="col-lg-12 view-label">Type</label>
                                        <p class="col-lg-12 view-record">
                                            {{ $this->enrollment_course_details->course->code ?? __('msg.na') }}
                                        </p>
                                    </div>

                                    <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>

                                    <div class="row">
                                        <label class="col-lg-12 view-label">Credited Hours | Points
                                        </label>
                                        <p class="col-lg-12 view-record">
                                            {{ $this->enrollment_course_details->course->code ?? __('msg.na') }}
                                        </p>
                                    </div>
                                    <h6 class="pt-3 text-primary"> Basic Details</h6>
                                    <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>
                                    @include(
                                        'livewire.admin.enrollments.enrollment-details'
                                    )
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="col-lg-12 card p-4 bg-info">
                                <div class="form-group mb-0 row">
                                    <div class="col-lg-4">
                                        {!! Form::label('fdata.component_type_id', 'Component Type', ['class' => 'control-label required']) !!}
                                        {!! Form::select('fdata.component_type_id', $this->enrollmentComponentTypeList, 'S', ['wire:model' => 'fdata.component_type_id', 'id' => 'fdata.component_type_id', 'class' => 'form-control ' . ($errors->has('fdata.component_type_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Component Type']) !!}
                                        @error('fdata.component_type_id')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4">
                                        {!! Form::label('fdata.exam_date', 'Exam Date', ['class' => 'control-label required']) !!}
                                        {!! Form::date('fdata.exam_date', '', ['wire:model.defer' => 'fdata.exam_date', 'class' => 'form-control ' . ($errors->has('fdata.exam_date') ? ' is-invalid' : ''), 'placeholder' => 'Select Exam Date']) !!}
                                        @error('fdata.exam_date')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <button wire:click="getStudents()" class="btn btn-icon text-white">
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            @if (!empty($this->fdata['student']) && !empty($this->fdata['component_type_id']))
                                <div class="student-area">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Students</h5>
                                        </div>
                                        <div class="card-body">
                                           @include(
                                                'livewire.admin.enrollments.enrollment-mark.enrollment-mark-create'
                                            )
                                        </div>
                                    </div>
                                </div>
                            @else
                            <p>please select <b> Component Type </b> </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-common.modal wire:key="{{ now() }}" :modal_section_id="'modalCreate'">
        <x-slot name="modal_title">
            Set Enrollment Students
        </x-slot>
        <x-slot name="modal_size">
            modal-xl
        </x-slot>
        <x-slot name="modal_body">

        </x-slot>
    </x-common.modal>

    @push('scripts')
        <script type="text/javascript">
            // for Sidebar auto resize
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
                            @this.call('deleteMark', id)
                            // success respons
                        } else {

                        }
                    });
                });
            });
        </script>
    @endpush

</div>

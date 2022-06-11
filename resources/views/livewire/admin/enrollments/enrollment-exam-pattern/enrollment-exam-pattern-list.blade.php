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
                            <div class="card card-outline card-info sticky-top sticky-top vh-100 overflow-auto">
                                <div class="card-body ">

                                    <h6 class="pt-3 text-primary">Couse Details</h6>
                                    <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>   
                                        <div class="row">
                                            <label class="col-lg-12 view-label">Code | Course Name</label>
                                            <p class="col-lg-12 view-record">
                                                {{ $this->enrollment_course_details->course->code }}
                                                |
                                                {{ $this->enrollment_course_details->course->title }}
                                            </p>
                                        </div>

                                        <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>   
                                                                             <div class="row">
                                            <label class="col-lg-12 view-label">Campus / Program Category</label>
                                            <p class="col-lg-12 view-record">
                                                {{ $this->enrollment_course_details->course->code }}
                                            </p>
                                        </div>

                                        <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>

                                        <div class="row">
                                            <label class="col-lg-12 view-label">Type</label>
                                            <p class="col-lg-12 view-record">
                                                {{ $this->enrollment_course_details->course->code }}
                                            </p>
                                        </div>

                                        <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>

                                        <div class="row">
                                            <label class="col-lg-12 view-label">Credited Hours | Points
                                            </label>
                                            <p class="col-lg-12 view-record">
                                                {{ $this->enrollment_course_details->course->code }}
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

                                    {!! Form::label('fdata.exam_pattern_id', 'Exam Pattern', ['class' => 'control-label col-lg-3 pt-2 required']) !!}

                                    <div class="col-lg-5">
                                        {!! Form::select('fdata.exam_pattern_id', $this->examPatternList, 'S', ['wire:model.defer' => 'fdata.exam_pattern_id', 'id' => 'fdata.exam_pattern_id', 'class' => 'form-control ' . ($errors->has('fdata.exam_pattern_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Exam Pattern']) !!}
                                        @error('fdata.exam_pattern_id')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-3">
                                        <button class="btn btn-warning btn-lg" wire:click="getExamPattern()">
                                            Get Exam Pattern
                                        </button>
                                        <a  href="#" class="text-white ml-2" data-toggle="popover"
                                            data-trigger="hover" data-content="That Exam Pattern is already in use, and if you changed, the associated data may be lost" data-placement="top" data-original-title="Warning" title="">
                                            <i class="fa fa-info-circle"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="exam-pattern-area">
                                @if ( !empty($this->fdata['group']) )
                                    @include('livewire.admin.enrollments.enrollment-exam-pattern.enrollment-exam-pattern-create')    
                                @else
                                   
                                @endif
                                
                            </div>

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
            $('body').addClass('sidebar-collapse');
            $(window).trigger('resize');
            
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
                            @this.set('fdata.group.' + id + '.key', '')
                            @this.call('setExamPatternGroup', id)
                            // success respons
                        } else {

                        }
                    });
                });
            });
            
         
        </script>
    @endpush

</div>

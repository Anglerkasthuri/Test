@include('livewire.common.push_items')
<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>View Program</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Program</li>
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
                    <div class="card p-3">
                        <div class="card-body p-0">
                            <div class="row">
                                
                                <h6 class="col-lg-12 m-0">Basic Details</h6>
                                <div class="col-lg-12 dropdown-divider"></div>
                                <div class="col-lg-6 ">
                                    <label class="col-lg-12 view-label">Program Name</label>
                                    <p class="col-lg-12 view-record">{{ $record->title ?? __('msg.na') }}</p>
                                </div>

                                <div class="col-lg-6">
                                    <label class="col-lg-12 view-label">Degree Name</label>
                                    <p class="col-lg-12 view-record">{{ $record->degree_name ?? __('msg.na') }}</p>
                                </div>
                                
                                <div class="col-lg-6">
                                    <label class="col-lg-12 view-label">Code</label>
                                    <p class="col-lg-12 view-record">{{ $record->code ?? __('msg.na') }}</p>
                                </div>
                                
                                <div class="col-lg-6">
                                    <label class="col-lg-12 view-label">Short Name</label>
                                    <p class="col-lg-12 view-record">{{ $record->short_name ?? __('msg.na') }}</p>
                                </div>
                                
                                <div class="col-lg-6">
                                    <label class="col-lg-12 view-label">Academic Pattern</label>
                                    <p class="col-lg-12 view-record">{{ $record->academic_pattern->title ?? __('msg.na')  }}</p>
                                </div>
                                
                                <div class="col-lg-6">
                                    <label class="col-lg-12 view-label">Number of Pattern</label>
                                    <p class="col-lg-12 view-record">{{ $record->number_of_pattern ?? __('msg.na') }}</p>
                                </div>

                                <h6 class="col-lg-12 mt-2 m-0">Other Details</h6>
                                <div class="col-lg-12 dropdown-divider"></div>
                                
                                <div class="col-lg-4">
                                    <label class="col-lg-12 view-label">Degree Awarding Body</label>
                                    <p class="col-lg-12 view-record">{{ $record->degree_awarding_body->title ?? __('msg.na') }}</p>
                                </div>
                                
                                <div class="col-lg-4">
                                    <label class="col-lg-12 view-label">Campus</label>
                                    <p class="col-lg-12 view-record">{{ $record->campus->title ?? __('msg.na') }}</p>
                                </div>
                                
                                <div class="col-lg-4">
                                    <label class="col-lg-12 view-label">Program Category</label>
                                    <p class="col-lg-12 view-record">{{ $record->program_category->title ?? __('msg.na') }}</p>
                                </div>
                                
                                <div class="col-lg-4">
                                    <label class="col-lg-12 view-label">Program Sub Category</label>
                                    <p class="col-lg-12 view-record">{{ $record->program_sub_category->title ?? __('msg.na') }}</p>
                                </div>

                                <div class="col-lg-4">
                                    <label class="col-lg-12 view-label">Program Level</label>
                                    <p class="col-lg-12 view-record">{{ $record->program_level->title ?? __('msg.na') }}</p>
                                </div>
                                
                                <div class="col-lg-4">
                                    <label class="col-lg-12 view-label">Program Group</label>
                                    <p class="col-lg-12 view-record">{{ $record->program_group->title ?? __('msg.na') }}</p>
                                </div>
                                
                                <div class="col-lg-4">
                                    <label class="col-lg-12 view-label">Program Type</label>
                                    <p class="col-lg-12 view-record">{{ $record->program_type->title ?? __('msg.na') }}</p>
                                </div>
                                
                                <div class="col-lg-4">
                                    <label class="col-lg-12 view-label">Study Mode</label>
                                    <p class="col-lg-12 view-record">{{ $record->study_mode->title ?? __('msg.na') }}</p>
                                </div>
                                
                                <div class="col-lg-4">
                                    <label class="col-lg-12 view-label">Program Duration</label>
                                    <p class="col-lg-12 view-record">{{ $record->program_duration->title ?? __('msg.na') }}</p>
                                </div>
                            
                                <div class="col-lg-4">
                                    <label class="col-lg-12 view-label">Program Accredited by</label>
                                    <p class="col-lg-12 view-record">{{ $record->accreditation->title ?? __('msg.na') }}</p>
                                </div>
                                
                                <div class="col-lg-4">
                                    <label class="col-lg-12 view-label">Active</label>
                                    <p class="col-lg-12 view-record"> {{ config('settings.active_field')[$record->active] }}</p>
                                </div>

                                <div class="col-lg-12 view-record">
                                    <label class="col-lg-12 view-label">Description</label>
                                    <p class="col-lg-12 view-record">{{ $record->description }}</p>
                                </div>
                                <h6 class="col-lg-12 mt-2 m-0">Creation Details</h6>
                                <div class="col-lg-12 dropdown-divider"></div>
                                <div class="col-lg-3">
                                    <label class="col-lg-12 view-label">Created on</label>
                                    <p class="col-lg-12 view-record">{{ __dpDatetimeConvertOrgTZ($record->created_at) ?? __('msg.na') }}</p>
                                </div>
                                <div class="col-lg-3">
                                    <label class="col-lg-12 view-label">Created by</label>
                                    <p class="col-lg-12 view-record">{{ $record->created_by->name ?? __('msg.na') }}</p>
                                </div>
                                <div class="col-lg-3">
                                    <label class="col-lg-12 view-label">Updated on</label>
                                    <p class="col-lg-12 view-record">{{  __dpDatetimeConvertOrgTZ($record->updated_at) ?? __('msg.na') }}</p>
                                </div>
                                <div class="col-lg-3">
                                    <label class="col-lg-12 view-label">Updated by</label>
                                    <p class="col-lg-12 view-record">{{ $record->updated_by->name ?? __('msg.na') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

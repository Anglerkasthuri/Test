<div>

    <div class="row">
        <label class="col-lg-12 view-label">Batch</label>
        <p class="col-lg-12 view-record">
            {{ $this->enrollment_details->batch->title ?? __('msg.na') }}</p>
    </div>

    <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>
    
    <div class="row">
        <label class="col-lg-12 view-label">Enrollment</label>
        <p class="col-lg-12 view-record">
            {{ $this->enrollment_details->title ?? __('msg.na') }}</p>
    </div>
    
    <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>
    
    <div class="row">
        <label class="col-lg-12 view-label">Campus</label>
        <p class="col-lg-12 view-record">
            {{ $this->enrollment_details->campus->title ?? __('msg.na') }}</p>
    </div>
    
    <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>
    
    <div class="row">
        <label class="col-lg-12 view-label">Program Category</label>
        <p class="col-lg-12 view-record">
            {{ $this->enrollment_details->program->program_category->title ?? __('msg.na') }}
        </p>
    </div>
    
    <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>
    
    <div class="row">
        <label class="col-lg-12 view-label">Level</label>
        <p class="col-lg-12 view-record">
            {{ $this->enrollment_details->program->program_level->title ?? __('msg.na') }}
        </p>
    </div>
    
    <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>
    
    <div class="row">
        <label class="col-lg-12 view-label">Program</label>
        <p class="col-lg-12 view-record">
            {{ $this->enrollment_details->program->title ?? __('msg.na') }}</p>
    </div>
    
    <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>
    
    <div class="row">
        <label class="col-lg-12 view-label">Academic Year</label>
        <p class="col-lg-12 view-record">
            {{ $this->enrollment_details->academic_year->title ?? __('msg.na') }}</p>
    </div>
    
    <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>
    
    <div class="row">
        <label class="col-lg-12 view-label">Academic Pattern & Number</label>
        <p class="col-lg-12 view-record">
            {{ $this->enrollment_details->academic_pattern->title ?? __('msg.na') }} /
            {{ $this->enrollment_details->academic_pattern_number ?? __('msg.na') }}
        </p>
    </div>
    
    <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>
    
    <div class="row">
        <label class="col-lg-12 view-label">Duration </label>
        <p class="col-lg-12 view-record">
            {{ ($this->enrollment_details->duration_from_display ?? __('msg.na')) .' to ' .($this->enrollment_details->duration_to_display ?? __('msg.na')) }}
        </p>
    </div>

</div>
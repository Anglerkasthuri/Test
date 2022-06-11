<div>

    <div class="row">
        <label class="col-lg-12 view-label">Form Title</label>
        <p class="col-lg-12 view-record">
            {{ $this->form->title ?? __('msg.na') }}</p>
    </div>

    <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>
    
    <div class="row">
        <label class="col-lg-12 view-label">Form Subtitle</label>
        <p class="col-lg-12 view-record">
            {{ $this->form->sub_title ?? __('msg.na') }}</p>
    </div>
    
    <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>
    
    <div class="row">
        <label class="col-lg-12 view-label">Instruction</label>
        <p class="col-lg-12 view-record">
            {!! nl2br($this->form->form_instruction) ?? __('msg.na') !!}
        </p>
    </div>
    
    <div class="col-lg-12 col-lg-12 dropdown-divider mt-0"></div>
    
    <div class="row">
        <label class="col-lg-12 view-label">Description</label>
        <p class="col-lg-12 view-record">
            {!! nl2br($this->form->description) ?? __('msg.na') !!}
        </p>
    </div>
    
</div>
@include('livewire.common.push_items')
<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>{{ $this->grade_category_details->title }}</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('grade-category') }}">Grade Category</a></li>
                        <li class="breadcrumb-item active">Set Grade Pattern</li>
                        
                    </ol>
                </div>
                <div class="col-sm-6 action-tools">

                    <a target="_blank" class="btn btn-icon text-info btn-sm"
                        href="{{ route('model-log', class_basename($this->model)) }}">
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
                    <div class="card ">

                    @if($this->grade_category_details->internal_calculation_available)
                        <div class="card-body p-3">
                            <h6 class="col-lg-12 m-0">Internal Calculation</h6>
                            <div class="col-lg-12 dropdown-divider"></div>
                            <form autocomplete="off">

                                <div class="row p-1">
                                    <div class="col-lg-1">
                                        <label>#</label>
                                    </div>
                                    <div class="col-lg-2">
                                        <label> Mark From ( >= ) </label>
                                    </div>
                                    <div class="col-lg-2">
                                        <label> Mark To ( <= ) </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label> Grade </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label> Grade Points </label>
                                    </div>
                                    <div class="col-lg-1">
                                        <label> Action </label>
                                    </div>
                                </div>
                                <div class="row p-1">
                                    @forelse ($internal_inputs as $key => $value)
                                        {{-- {{ $key }} - {{ $value }} --}}
                                        <div class="form-group col-lg-1">
                                            {{ $key + 1 }} 
                                        </div>

                                        <div class="form-group col-lg-2">
                                            {!! Form::number("fdata.internal.$value.mark_from", '', ['wire:model.defer' => "fdata.internal.$value.mark_from", 'class' => 'form-control ' . ($errors->has("fdata.internal.$value.mark_from") ? ' is-invalid' : ''), 'placeholder' => 'Mark From', 'min' => 0, 'max' => 100]) !!}
                                            @error("fdata.internal.$value.mark_from")
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-2">
                                            {!! Form::number("fdata.internal.$value.mark_to", '', ['wire:model.defer' => "fdata.internal.$value.mark_to", 'class' => 'form-control ' . ($errors->has("fdata.internal.$value.mark_to") ? ' is-invalid' : ''), 'placeholder' => 'Mark To', 'min' => 0, 'max' => 100]) !!}
                                            @error("fdata.internal.$value.mark_to")
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
 
                                        <div class="form-group col-lg-3">
                                            {!! Form::select("fdata.internal.$value.grade_type_id", $this->gradeTypeList, 'S', ['wire:model' => "fdata.internal.$value.grade_type_id", 'id' => "fdata.internal.$value.grade_type_id", 'class' => 'form-control  ' . ($errors->has("fdata.internal.$value.grade_type_id") ? ' is-invalid' : ''), 'placeholder' => 'Select Grade Type']) !!}
                                            @error("fdata.internal.$value.grade_type_id")
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
 
                                        <div class="form-group col-lg-3">
                                            {!! Form::number("fdata.internal.$value.grade_points", '', ['wire:model.defer' => "fdata.internal.$value.grade_points", 'class' => 'form-control ' . ($errors->has("fdata.internal.$value.grade_points") ? ' is-invalid' : ''), 'placeholder' => 'Grade Points', 'min' => 0, 'max' => 100]) !!}
                                            @error("fdata.internal.$value.grade_points")
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-1">
                                            @if(count($this->internal_inputs) > 1)
                                            <button type="button" class="btn btn-icon text-danger btn-sm"
                                                wire:click.prevent="removeInternal({{ $key }})" onclick="confirm('Are you Sure') || event.stopImmediatePropagation()" data-toggle="popover_" data-trigger="hover" data-content="Delete" data-placement="top"><i class="fa fa-trash"></i></button>
                                            @endif

                                            @if($key == count($this->internal_inputs)-1 )
                                                <button type="button" class="btn text-success btn-icon btn-sm"
                                                wire:click.prevent="addInternal({{ $internal_i }})" data-toggle="popover_" data-trigger="hover" data-content="Add More" data-placement="top"><i class="fa fa-plus-circle fa-xl"></i></button>
                                            @endif
                                        </div>
                                    @empty
                                    <div class="row p-1">
                                        <div class="col-lg-12">
                                            <label class="dataTables_empty"><span>{{ __('msg.no_records') }}</span></label>
                                        </div>
                                    </div>
                                    @endforelse
                                </div>

                            </form>
                        </div>
                    @endif

                    @if($this->grade_category_details->external_calculation_available)
                        <div class="card-body p-3">
                            <h6 class="col-lg-12 m-0">External Calculation</h6>
                            <div class="col-lg-12 dropdown-divider"></div>
                            <form autocomplete="off">
                    
                                <div class="row p-1">
                                    <div class="col-lg-1">
                                        <label>#</label>
                                    </div>
                                    <div class="col-lg-2">
                                        <label> Mark From ( >= ) </label>
                                    </div>
                                    <div class="col-lg-2">
                                        <label> Mark To ( <= ) </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label> Grade </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label> Grade Points </label>
                                    </div>
                                    <div class="col-lg-1">
                                        <label> Action </label>
                                    </div>
                                </div>
                                <div class="row p-1">
                                    @forelse ($external_inputs as $key => $value)
                                        {{-- {{ $key }} - {{ $value }} --}}
                                        <div class="form-group col-lg-1">
                                            {{ $key + 1 }} 
                                        </div>
                    
                                        <div class="form-group col-lg-2">
                                            {!! Form::number("fdata.external.$value.mark_from", '', ['wire:model.defer' => "fdata.external.$value.mark_from", 'class' => 'form-control ' . ($errors->has("fdata.external.$value.mark_from") ? ' is-invalid' : ''), 'placeholder' => 'Mark From', 'min' => 0, 'max' => 100]) !!}
                                            @error("fdata.external.$value.mark_from")
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                    
                                        <div class="form-group col-lg-2">
                                            {!! Form::number("fdata.external.$value.mark_to", '', ['wire:model.defer' => "fdata.external.$value.mark_to", 'class' => 'form-control ' . ($errors->has("fdata.external.$value.mark_to") ? ' is-invalid' : ''), 'placeholder' => 'Mark To', 'min' => 0, 'max' => 100]) !!}
                                            @error("fdata.external.$value.mark_to")
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                    
                                        <div class="form-group col-lg-3">
                                            {!! Form::select("fdata.external.$value.grade_type_id", $this->gradeTypeList, 'S', ['wire:model' => "fdata.external.$value.grade_type_id", 'id' => "fdata.external.$value.grade_type_id", 'class' => 'form-control  ' . ($errors->has("fdata.external.$value.grade_type_id") ? ' is-invalid' : ''), 'placeholder' => 'Select Grade Type']) !!}
                                            @error("fdata.external.$value.grade_type_id")
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                    
                                        <div class="form-group col-lg-3">
                                            {!! Form::number("fdata.external.$value.grade_points", '', ['wire:model.defer' => "fdata.external.$value.grade_points", 'class' => 'form-control ' . ($errors->has("fdata.external.$value.grade_points") ? ' is-invalid' : ''), 'placeholder' => 'Grade Points', 'min' => 0, 'max' => 100]) !!}
                                            @error("fdata.external.$value.grade_points")
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-1">
                                            @if(count($this->external_inputs) > 1)
                                            <button type="button" class="btn btn-icon text-danger btn-sm"
                                                wire:click.prevent="removeExternal({{ $key }})" title='Delete' onclick="confirm('Are you Sure') || event.stopImmediatePropagation()"><i class="fa fa-trash"></i></button>
                                            @endif

                                            @if($key == count($this->external_inputs)-1 )
                                                <button type="button" class="btn text-success btn-icon btn-sm"
                                                wire:click.prevent="addExternal({{ $external_i }})" title='Add More'><i class="fa fa-plus-circle fa-xl"></i> </button>
                                            @endif
                                        </div>
                                    @empty
                                    <div class="row p-1">
                                        <div class="col-lg-12">
                                            <label class="dataTables_empty"><span>{{ __('msg.no_records') }}</span></label>
                                        </div>
                                    </div>
                                    @endforelse
                                </div>
                    
                            </form>
                        </div>
                    @endif
                        
                    @if($this->grade_category_details->final_calculation_available)
                        <div class="card-body p-3">
                            <h6 class="col-lg-12 m-0">Final Calculation</h6>
                            <div class="col-lg-12 dropdown-divider"></div>
                            <form autocomplete="off">
                    
                                <div class="row p-1">
                                    <div class="col-lg-1">
                                        <label>#</label>
                                    </div>
                                    <div class="col-lg-2">
                                        <label> Mark From ( >= ) </label>
                                    </div>
                                    <div class="col-lg-2">
                                        <label> Mark To ( <= ) </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label> Grade </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label> Grade Points </label>
                                    </div>
                                    <div class="col-lg-1">
                                        <label> Action </label>
                                    </div>
                                </div>
                                <div class="row p-1">
                                    @forelse ($final_inputs as $key => $value)
                                        {{-- {{ $key }} - {{ $value }} --}}
                                        <div class="form-group col-lg-1">
                                            {{ $key + 1 }} 
                                        </div>
                    
                                        <div class="form-group col-lg-2">
                                            {!! Form::number("fdata.final.$value.mark_from", '', ['wire:model.defer' => "fdata.final.$value.mark_from", 'class' => 'form-control ' . ($errors->has("fdata.final.$value.mark_from") ? ' is-invalid' : ''), 'placeholder' => 'Mark From', 'min' => 0, 'max' => 100]) !!}
                                            @error("fdata.final.$value.mark_from")
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                    
                                        <div class="form-group col-lg-2">
                                            {!! Form::number("fdata.final.$value.mark_to", '', ['wire:model.defer' => "fdata.final.$value.mark_to", 'class' => 'form-control ' . ($errors->has("fdata.final.$value.mark_to") ? ' is-invalid' : ''), 'placeholder' => 'Mark To', 'min' => 0, 'max' => 100]) !!}
                                            @error("fdata.final.$value.mark_to")
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                    
                                        <div class="form-group col-lg-3">
                                            {!! Form::select("fdata.final.$value.grade_type_id", $this->gradeTypeList, 'S', ['wire:model' => "fdata.final.$value.grade_type_id", 'id' => "fdata.final.$value.grade_type_id", 'class' => 'form-control  ' . ($errors->has("fdata.final.$value.grade_type_id") ? ' is-invalid' : ''), 'placeholder' => 'Select Grade Type']) !!}
                                            @error("fdata.final.$value.grade_type_id")
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                    
                                        <div class="form-group col-lg-3">
                                            {!! Form::number("fdata.final.$value.grade_points", '', ['wire:model.defer' => "fdata.final.$value.grade_points", 'class' => 'form-control ' . ($errors->has("fdata.final.$value.grade_points") ? ' is-invalid' : ''), 'placeholder' => 'Grade Points', 'min' => 0, 'max' => 100]) !!}
                                            @error("fdata.final.$value.grade_points")
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-1">
                                            @if(count($this->final_inputs) > 1)
                                            <button type="button" class="btn btn-icon text-danger btn-sm"
                                                wire:click.prevent="removeFinal({{ $key }})" title='Delete' onclick="confirm('Are you Sure') || event.stopImmediatePropagation()"><i class="fa fa-trash"></i></button>
                                            @endif

                                            @if($key == count($this->final_inputs)-1 )
                                                <button type="button" class="btn text-success btn-icon btn-sm"
                                                wire:click.prevent="addFinal({{ $final_i }})" title='Add More'><i class="fa fa-plus-circle fa-xl"></i></button>
                                            @endif
                                        </div>
                                    @empty
                                    <div class="row p-1">
                                        <div class="col-lg-12">
                                            <label class="dataTables_empty"><span>{{ __('msg.no_records') }}</span></label>
                                        </div>
                                    </div>
                                    @endforelse
                                </div>
                    
                            </form>
                        </div>
                    @endif

                        
                        <div class="card-footer col-lg-12 ">
                            <button type="button" wire:loading.attr="disabled"  wire:click="store()"
                                class="btn btn-primary float-right mx-1">Submit</button>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </section>
</div>
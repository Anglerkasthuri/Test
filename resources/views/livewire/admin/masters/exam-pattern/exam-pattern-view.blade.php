@include('livewire.common.push_items')

<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <h1>{{ $record->title . ' - ' ?? null }}Exam Pattern</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Exam Pattern</li>
                    </ol>
                </div>
                <div class="col-sm-4 action-tools">


                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form autocomplete="off">
                <div class="row">

                    <div class="col-8">
                        {{-- @dump($this->fdata) --}}
                        @forelse (collect($this->fdata['group'])->sortByDesc('sequence'); as $group)
                        <div class="card card-primary-outline" id="exam-pattern-acg-{{$group['key']}}">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h6 class="pt-1">
                                                {{ $this->academicComponentGroupModal[$group['key']] }}</h6>
                                            @error("fdata.group.{$group['key']}.type")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group m-0">
                                                <div
                                                    class="input-group {{ $errors->has("fdata.group.{$group['key']}.contribution") ? ' is-invalid' : '' }}">
                                                    {!! Form::number("fdata.group.{$group['key']}.contribution", '', [
                                                        'wire:model.defer' => "fdata.group.{$group['key']}.contribution",
                                                        'class' => ' form-control ' . ($errors->has("fdata.group.{$group['key']}.contribution") ? ' is-invalid' : ''),
                                                        'placeholder' => 'Contribution',
                                                        'max' => 100,
                                                        'min' => 0,
                                                    ]) !!}

                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-percent"></i>
                                                        </div>
                                                    </div>

                                                </div>
                                                @error("fdata.group.{$group['key']}.contribution")
                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{-- @dump($this->fdata) --}}
                                    <div class="row">
                                        @if (!empty($group['key']))
                                            <div class="col-lg-12">

                                                @if (isset($this->academic_component_type[$group['key']]))
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4">
                                                            <label class="m-0 text-muted"> Component Type</label>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label class="m-0 text-muted"> Component Category</label>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label class="m-0 text-muted"> Max Mark</label>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-lg-12 dropdown-divider"></div> --}}
                                                    @foreach ($this->academic_component_type[$group['key']] as $type)
                                                        <div class="row">
                                                            <div class="col-lg-4 mb-3">
                                                                <label class="col-lg-12 view-record pl-0">
                                                                    {!! Form::checkbox("fdata.group.{$group['key']}.type.{$type['id']}.key", $type['id'], '', [
                                                                        'wire:model.defer' => "fdata.group.{$group['key']}.type.{$type['id']}.key",
                                                                        'wire:click' => "setGroupType({$type['id']},{$group['key']})",
                                                                        'class' => '' . ($errors->has("fdata.group.{$group['key']}.type.{$type['id']}.key") ? ' is-invalid' : ''),
                                                                    ]) !!}
                                                                    {{ $type['title'] ?? '' }}
                                                                </label>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <p class="col-lg-12">
                                                                    {{ $type['academic_component_category']['title'] ?? '' }}
                                                                </p>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                @if (!empty($this->fdata['group'][$group['key']]['type'][$type['id']]['key']))
                                                                    <div
                                                                        class="input-group ml-2 {{ $errors->has("fdata.group.{$group['key']}.type.{$type['id']}.mark") ? ' is-invalid' : '' }}">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <i class="far fa-star"></i>
                                                                            </div>
                                                                        </div>
                                                                        {!! Form::number("fdata.group.{$group['key']}.type.{$type['id']}.mark", '', [
                                                                            'wire:model.defer' => "fdata.group.{$group['key']}.type.{$type['id']}.mark",
                                                                            'class' => 'form-control' . ($errors->has("fdata.group.{$group['key']}.type.{$type['id']}.mark") ? ' is-invalid' : ''),
                                                                            'placeholder' => '',
                                                                            'max' => 100,
                                                                            'min' => 0,
                                                                        ]) !!}
                                                                    </div>
                                                                    @error("fdata.group.{$group['key']}.type.{$type['id']}.mark")
                                                                        <span
                                                                            class="error invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                @else
                                                                    <p class="col-lg-12">{{ __('msg.na') }}</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <p class="p-3">No records found, <b>please select component group</b></p>
                        @endforelse
                        @if (!empty($this->fdata['group']))
                            <div class="col-lg-12 pb-4">
                                @error('fdata.overall_contribution')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="col-lg-12">
                                    <button type="button" wire:loading.attr="disabled" class="btn btn-success"
                                        wire:click.prevent="setting_store()">
                                        Submit</button>

                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-4">
                        <div class="col-lg-12 bg-primary bg-gradient
                    ">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="col-lg-12 view-label text-light">Exam Pattern</label>
                                    <p class="col-lg-12 view-record text-white"> {{ $record->title }} </p>
                                </div>
                                <div class="col-lg-6">
                                    <label class="col-lg-12 view-label text-white">Campus</label>
                                    <p class="col-lg-12 view-record text-white"> {{ $record->campus->title }} </p>
                                </div>
                            </div>
                        </div>
                        <div class="card sticky-top vh-100 overflow-auto">
                            <div class="card-body">
                                <div class="pb-4">

                                    <div class="sticky-top bg-white-transparent">
                                        <h5 class="pt-1">Component Group</h5>
                                        <div class="col-lg-12 dropdown-divider"></div>
                                    </div>
                                    
                                    @forelse ($this->academicComponentGroupModal as $key => $academic_component_group)
                                        <div class="form-group row mb-1">
                                            <div class="col-lg-11">
                                                <label class= "w-100 {{ !empty($this->fdata['group'][$key]['key']) ? 'text-success' :' ' }}">
                                                    @if (empty($this->fdata['group'][$key]['id']))
                                                        {!! Form::checkbox("fdata.group.{$key}.key", $key, '', [
                                                            'wire:model.defer' => "fdata.group.{$key}.key",
                                                            'wire:click' => "setGroup({$key})",
                                                            'class' => "{($errors->has('fdata.group.{$key}.key') ? ' is-invalid' : '')}",
                                                        ]) !!}
                                                    @else
                                                        {!! Form::checkbox("fdata.group.{$key}.key", $key, '', [
                                                            'wire:model.defer' => "fdata.group.{$key}.key",
                                                            'wire:click' => "setGroup({$key})",
                                                            'class' => "{($errors->has('fdata.group.{$key}.key') ? ' is-invalid' : '')}",
                                                            'disabled' => 'disabled',
                                                        ]) !!}
                                                    @endif
                                                    {{ $academic_component_group }}
                                                    @if (!empty($this->fdata['group'][$key]['id']))
                                                        <a href="#" class="text-info ml-2" data-toggle="popover"
                                                            data-trigger="hover"
                                                            data-content="That group is already in use, and if you uncheck, the associated data may be lost"
                                                            data-placement="top" data-original-title="Warning" title="">
                                                            <i class="fa fa-info-circle"></i>
                                                        </a>
                                                        <a href="#" wire:click="$emit('triggerDelete',{{ $key }})"
                                                            class="ml-3 text-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="col-lg-1 p-0">
                                                @if(!empty($this->fdata["group"][$key]["key"]))
                                                    <a class="float-right text-success" href="#exam-pattern-acg-{{$key}}">
                                                        <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-center">No records found</p>
                                    @endforelse
                                    <!-- /. p-0 -->
                                    <div class="col-lg-12 dropdown-divider"></div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </section>
    @push('scripts')
        <script type="text/javascript">
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
                            @this.call('setGroup', id)

                            // success respons
                        } else {}
                    });
                });
            })
        </script>
    @endpush
</div>

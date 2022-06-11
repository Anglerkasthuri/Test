<div>
    <div class=" table-responsive p-2">
        <table class="table table-bordered thead-dark table-striped" wire:loading.class="loading">
            <thead class="table-warning">
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Absent</th>
                    <th style="width:20%">
                        Mark <small class="text-danger text-bold float-right">(max : {{ $this->component_type_details->maximum_mark ?? null }}) </small>
                    </th>
                    <th style="width:20%">Exam Date(Stud Wise)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sno = 1;
                @endphp
                @forelse($this->enrollment_students  as  $student)
                    @php
                        $key = $student['student_id'];
                    @endphp
                    <tr>
                        <td>
                            {{ $sno++ }}
                        </td>
                        <td class="title">
                            {{ $student['student']['title'] ?? __('msg.na') }}
                        </td>
                        <td>
                            <div class="form-group mb-0">

                                @if (!empty($this->fdata['student'][$key]['show']))
                                    {!! Form::checkbox("fdata.student.{$key}.key", $key, '', [
                                        'wire:model.defer' => "fdata.student.{$key}.key",
                                        'wire:click' => "setStudentMarkHide({$key})",
                                        'class' => "{($errors->has('fdata.student.{$key}.key') ? ' is-invalid' : '')}",
                                    ]) !!}
                                @else
                                {!! Form::checkbox("fdata.student.{$key}.key", $key, '', [
                                    'wire:model.defer' => "fdata.student.{$key}.key",
                                    'wire:click' => "setStudentMarkShow({$key})",
                                    'class' => "{($errors->has('fdata.student.{$key}.key') ? ' is-invalid' : '')}",
                                    'checked' => 'checked',
                                ]) !!}
                                @endif

                                @error("fdata.student.{$key}.key")
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                        <td>
                            @if (!empty($this->fdata['student'][$key]['show']))
                                <div class="form-group mb-0">
                                    {!! Form::number("fdata.student.{$key}.mark", ' ', ['wire:model.defer' => "fdata.student.{$key}.mark", 'class' => 'form-control ' . ($errors->has("fdata.student.{$key}.mark") ? ' is-invalid' : ''), 'placeholder' => 'Enter Mark']) !!}
                                    @error("fdata.student.{$key}.mark")
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            @else
                                ---
                            @endif
                        </td>
                        <td>
                            @if (!empty($this->fdata['student'][$key]['show']))
                                <div class="form-group mb-0 ">
                                    {!! Form::date("fdata.student.{$key}.individual_exam_date", ' ', ['wire:model.defer' => "fdata.student.{$key}.individual_exam_date", 'class' => 'form-control ' . ($errors->has("fdata.student.{$key}.individual_exam_date") ? ' is-invalid' : ''), 'placeholder' => 'Select Date']) !!}
                                    @error("fdata.student.{$key}.individual_exam_date")
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            @else
                                ---
                            @endif
                        </td>
                        <td>
                            @if (!empty($this->fdata['student'][$key]['student_mark_detail_id']))
                                <button type="button"
                                    wire:click="$emit('triggerDelete', {{ $this->fdata['student'][$key]['student_mark_detail_id'] }})"
                                    class="btn btn-icon text-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <a href="#" class="text-info ml-2" data-toggle="popover" data-trigger="hover"
                                    data-content="->" title="That Mark is already in use, and if you uncheck, the associated data may be lost"
                                    data-placement="top" data-original-title="Warning" title="">
                                    <i class="fa fa-info-circle"></i>
                                </a>
                            @endif
                        </td>
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
    <div class="row">
        <div class="col-lg-12 text-right">
            <button class="btn btn-warning btn-lg" wire:click="storeMark()">
                <i class="fa fa-refresh"></i> Save Mark
            </button>
        </div>

    </div>
  
</div>

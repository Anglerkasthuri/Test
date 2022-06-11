<div>
    <form autocomplete="off">
        <div class="row p-3">

            <div class="col-lg-12">
                <div class="row">
                    <div wire:ignore.self class="form-group form-focus col-lg-3">
                        {!! Form::text('courseSearch.title', null, ['wire:model.defer' => 'courseSearch.title', 'class' => 'form-control input-rounded courseSearch-input floating', 'placeholder' => '']) !!}
                        {!! Form::label('courseSearch.title', 'Course ', ['class' => 'focus-label']) !!}
                    </div>

                    <div wire:ignore.self class="form-group form-focus col-lg-3">
                        {!! Form::text('courseSearch.code', null, ['wire:model.defer' => 'courseSearch.code', 'class' => 'form-control input-rounded courseSearch-input floating', 'placeholder' => '']) !!}
                        {!! Form::label('courseSearch.code', 'Course Code ', ['class' => 'focus-label']) !!}
                    </div>                  

                    <div wire:ignore.self class="form-group form-focus  col-lg-3">
                        {!! Form::select('courseSearch.campus_id', $this->SearchCampusList, 'S', ['wire:model.defer' => 'courseSearch.campus_id', 'class' => 'form-control input-rounded courseSearch-input select2 floating', 'placeholder' => '']) !!}
                        {!! Form::label('courseSearch.campus_id', 'Campus', ['class' => 'focus-label']) !!}
                    </div>

                    <div wire:ignore.self class="form-group form-focus  col-lg-3">
                        {!! Form::select('courseSearch.program_category_id', $this->SearchProgramCategoryList, 'S', ['wire:model.defer' => 'courseSearch.program_category_id', 'class' => 'form-control input-rounded courseSearch-input select2 floating', 'placeholder' => '']) !!}
                        {!! Form::label('courseSearch.program_category_id', 'Program Category', ['class' => 'focus-label']) !!}
                    </div>

                    <div class="col-lg-3">
                        <button type="button" class="btn btn-success" wire:click="courseSearch()">Get Courses</button>
                    </div>

                </div>
            </div>
            
            @if (!empty($this->courses()))
                <div class=" table-responsive p-2">
                    <table class="table table-bordered thead-dark table-striped" wire:loading.class="loading">
                        <thead class="table-warning">
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Course Name</th>
                                <th style="width:30%">Credited Hours/Points</th>
                                <th>Course Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($this->courses()  as $index => $course)
                                <tr class="{{ empty($course->active) ? ' table-disable ' : '' }}">
                                    <td>
                                        {{ $index + $this->courses()->firstItem() }}
                                    </td>
                                    <td>{{ $course->code ?? __('msg.na') }}</td>
                                    <td class="title">{{ $course->title ?? __('msg.na') }}</td>
                                    <td>
                                        <div class="form-group">
                                            <div
                                                class="input-group {{ $errors->has("fdata.course.{$course->id}.credited_hours") ? ' is-invalid' : '' }}">
                                                {!! Form::number("fdata.course.{$course->id}.credited_hours", '', ['wire:model.defer' => "fdata.course.{$course->id}.credited_hours", 'class' => 'form-control ' . ($errors->has("fdata.course.{$course->id}.credited_hours") ? ' is-invalid' : ''), 'placeholder' => 'Enter Credited Hours/Points']) !!}
                                                <span class="input-group-append">
                                                    <button type="button"
                                                        class="btn {{ !empty($this->enrollment_courses[$course->id]) ? 'btn-success' : 'btn-info' }}"
                                                        wire:click="storeCourse({{ $course->id }})">
                                                        Add
                                                        @if (!empty($this->last_update_course_id[ $course->id ] ))
                                                            <i class="fa fa-check"></i>
                                                        @endif
                                                    </button>
                                                </span>

                                            </div>
                                            @error("fdata.course.{$course->id}.credited_hours")
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>{{ $course->course_type->title ?? __('msg.na') }}</td>
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
                @if ($this->courses()->total() > $this->courses()->perPage())
                    <div class="d-flex m-2">
                        <div class="col-md-2">
                            {!! Form::select('search.perPage', config('settings.per_page_options'), config('settings.perPage'), ['wire:model' => 'search.perPage', 'class' => 'form-control input-rounded search-input', 'style' => 'width:auto']) !!}
                        </div>
                        <div class=" col-md-10 d-flex justify-content-end pr-2">
                            <div class="pr-2 pt-2">
                                @lang('Showing :first to :last out of :total results', [
                                'first' => $this->courses()->count() ? $this->courses()->firstItem() : 0,
                                'last' => $this->courses()->count() ? $this->courses()->lastItem() : 0,
                                'total' => $this->courses()->total()
                                ])
                            </div>
                            <div>
                                {{ $this->courses()->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </form>
</div>

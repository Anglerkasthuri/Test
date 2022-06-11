<div>
    <form autocomplete="off">
        <div class="row p-3">

            <div class="col-lg-12">
                <div class="row">
                    <div wire:ignore.self class="form-group form-focus col-lg-3">
                        {!! Form::text('studentSearch.title', null, ['wire:model.defer' => 'studentSearch.title', 'class' => 'form-control input-rounded studentSearch-input floating', 'placeholder' => '']) !!}
                        {!! Form::label('studentSearch.title', 'Student ', ['class' => 'focus-label']) !!}
                    </div>                

                    <div wire:ignore.self class="form-group form-focus  col-lg-3">
                        {!! Form::select('studentSearch.program_id', $this->SearchProgramList, 'S', ['wire:model.defer' => 'studentSearch.program_id', 'class' => 'form-control input-rounded studentSearch-input select2 floating', 'placeholder' => '']) !!}
                        {!! Form::label('studentSearch.program_id', 'Program', ['class' => 'focus-label']) !!}
                    </div>

                    <div wire:ignore.self class="form-group form-focus  col-lg-3">
                        {!! Form::select('studentSearch.combined_intake_id', $this->SearchCombinedIntakeList, 'S', ['wire:model.defer' => 'studentSearch.combined_intake_id', 'class' => 'form-control input-rounded studentSearch-input select2 floating', 'placeholder' => '']) !!}
                        {!! Form::label('studentSearch.combined_intake_id', 'Program Category', ['class' => 'focus-label']) !!}
                    </div>

                    <div class="col-lg-3">
                        <button type="button" class="btn btn-success" wire:click="studentSearch()">Get Students</button>
                    </div>

                </div>
            </div>
            
            @if (!empty($this->students()))
                <div class=" table-responsive p-2">
                    <table class="table table-bordered thead-dark table-striped" wire:loading.class="loading">
                        <thead class="table-warning">
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($this->students()  as $index => $student)
                                <tr>
                                    <td>
                                        {{ $index + $this->students()->firstItem() }}
                                    </td>
                                    <td class="title">
                                        {{ $student->title ?? __('msg.na') }}

                                        @error("fdata.student_id.{$student->id}")
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            @if (empty($this->last_update_student_id[ $student->id ] ))        
                                                <button type="button"
                                                        class="btn btn-info"
                                                        wire:click="storeStudent({{ $student->id }})">
                                                        Add
                                                       
                                                       
                                                    </button>
                                                @else
                                                    <span class="text-success">   Added <i class="fa fa-check"></i></button>
                                                @endif
                                            </div>
                                          
                                        </div>
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
                @if ($this->students()->total() > $this->students()->perPage())
                    <div class="d-flex m-2">
                        <div class="col-md-2">
                            {!! Form::select('search.perPage', config('settings.per_page_options'), config('settings.perPage'), ['wire:model' => 'search.perPage', 'class' => 'form-control input-rounded search-input', 'style' => 'width:auto']) !!}
                        </div>
                        <div class=" col-md-10 d-flex justify-content-end pr-2">
                            <div class="pr-2 pt-2">
                                @lang('Showing :first to :last out of :total results', [
                                'first' => $this->students()->count() ? $this->students()->firstItem() : 0,
                                'last' => $this->students()->count() ? $this->students()->lastItem() : 0,
                                'total' => $this->students()->total()
                                ])
                            </div>
                            <div>
                                {{ $this->students()->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </form>
</div>
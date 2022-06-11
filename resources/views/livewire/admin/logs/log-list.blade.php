@include('livewire.common.push_items')
<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Logs</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Logs</li>
                    </ol>
                </div>
                <div class="col-sm-6 action-tools">
                    <a class="btn btn-icon text-warning btn-sm" data-toggle="collapse" data-target="#filter_collapse"
                        aria-expanded="false" aria-controls="collapseExample">
                        <i title="Filter" class="fa fa-filter"> </i>
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
                    <div class="card">
                        <div class="card-body p-0">
                            <div wire:ignore class="filter-section collapse" id="filter_collapse">
                                @include('livewire.admin.logs.log-filter')
                            </div>
                            @include('livewire.common.facet')
                            
                            <!-- /.card-header -->
                            <div class="  table-responsive p-0">
                                <table class=" table text-nowrap log-table" wire:loading.class="loading">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Modified</th>
                                            <th>On</th>
                                            <th>Field</th>
                                            <th>Old Value</th>
                                            <th>New Value</th>
                                        </tr>
                                    </thead>
                                   
                                    @forelse($records  as $index => $record)
                                      @php
                                        $rowspan = collect($record->properties->attributes)->count() + 1;   
                                      @endphp
                                       <tbody class="record">
                                            <tr>
                                                <td class="align-middle" rowspan="{{ $rowspan }}">
                                                {{ $index + $records->firstItem() }}</td>
                                                <td class="align-middle" rowspan="{{ $rowspan }}">
                                                 
                                                    <span class="text-primary">{{ $record->causerable->name }} </span><br />
                                                    <span class="text-muted">{{ $record->event }}</span>  <br />
                                                     {{ $record->created_at_display }} 
                                                </td>
                                                <td class="align-middle" rowspan="{{ $rowspan }}">
                                                    {{ $record->log_name }} <br />
                                                    Record Id: {{ $record->subject_id }} <br />
                                                    Log Id : {{ $record->id }}
                                                </td>
                                            </tr>   
                                            @foreach($record->properties->attributes as $att_key => $att_value)
                                            <tr class="attributes">
                                                <td class="attributes-title">
                                                    {{  __formatLogTitle($att_key) }}</td>
                                                <td>
                                                    @if(!empty($record->properties->old->$att_key))
                                                        {!! (is_object($record->properties->old->$att_key) or is_array($record->properties->old->$att_key)) ? collect($record->properties->old->$att_key) : $record->properties->old->$att_key!!}
                                                    @else
                                                        {!! __('msg.na') !!}
                                                    @endif
                                                </td>
                                                <td>{!! (is_object($att_value) or is_array($att_value)) ? collect($att_value) : $att_value !!}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        @empty
                                    </tbody>
                                            <tr class="odd">
                                                <td valign="top" colspan="12" class="dataTables_empty"><span>{{ __('msg.no_records') }}</span></td>
                                            </tr>
                                        </tbody>
                                        @endforelse

                                   
                                </table>
                            </div>

                            @include('livewire.common.pagination')
                            <!-- /. p-0 -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
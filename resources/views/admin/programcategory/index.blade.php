@extends('layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Program Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Program Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Program Category</h3>

                            <div class="card-tools">
                                <a href="{{ route('programcategories.create') }}" class="btn btn-sm">
                                    <i class="fas fa-plus"></i> Add
                                </a>
                                <a class="btn btn-sm">
                                    <i data-toggle="collapse" data-target="#filter_collapse" aria-expanded="false"
                                    aria-controls="collapseExample" title="Filter"
                                    class="fa fa-filter"> </i>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="collapse bg-light color-palette " id="filter_collapse">
                                <form>
                                    {{-- {!! Form::model($records, [
                                    'class' => '',
                                    'files' => false,
                                 ]) !!} --}}
                                    <div class="filter-layout">
                                        <div class="row p-4">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    {!! Form::label('title', 'Program Category', ['class' => 'control-label']) !!}
                                                    {!! Form::text('title', request('title'), ['class' => 'form-control', 'maxlength' => '50']) !!}
                                                    {!! $errors->first('title', '<span class="error invalid-feedback">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    {!! Form::label('short_name', 'Short Name', ['class' => 'control-label']) !!}
                                                    {!! Form::text('short_name', request('short_name'), ['class' => 'form-control', 'maxlength' => '50']) !!}
                                                    {!! $errors->first('short_name', '<span class="error invalid-feedback">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    {!! Form::label('active', 'Active', ['class' => 'control-label']) !!}
                                                    {!! Form::select('active', $filter['active'], request('active'), ['class' => 'form-control select2', 'placeholder' => '-- Select --', 'style' => 'width:100%']) !!}
                                                    {!! $errors->first('active', '<span class="error invalid-feedback">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-3 my-auto">
                                                {!! Form::submit('Filter', ['class' => 'btn btn-success']) !!}
                                            </div>
                                        </div>
                                 </form>
                              </div>
                        </div>
                        <div class="table-responsive">

                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Sno</th>
                                        <th>Program Category</th>
                                        <th>Short Name</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $first_item = $records->firstItem();
                                    @endphp
                                    @forelse ($records as $record)
                                        <tr class="{{ empty($record->active) ? ' table-danger ' : '' }}">
                                            <td class="">
                                                <a href="{{ route('programcategories.edit', $record->id) }}"
                                                    class="btn btn-primary btn-xs">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-xs">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                            <td class="">{{ $first_item + $loop->index }}</td>
                                            <td class="">{{ $record->title }}</td>
                                            <td class="">{{ $record->short_name }}</td>
                                            <td class="">
                                                @if (!empty($record->active))
                                                    <span class="badge bg-success"> Active </span>
                                                @else
                                                    <span class="badge bg-danger"> Disable <span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No Data Available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $records->links() }}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    </div>
@endsection

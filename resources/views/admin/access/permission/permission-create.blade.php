@extends('layouts.admin')
@include('livewire.common.push_items')
@push('styles')
    <style>
        table th.action{
            width: 30% !important;
        }
        table th.list, table th.add, table th.edit, table th.export{
            width: 15% !important;
        }
        table th.others{
            width: 10% !important; 
        }
    </style>
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-0">
                <div class="col-sm-9">
                    <h1>{{ $data['page_title'] }}</h1>
                    <ol class="breadcrumb ">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Permissions</li>
                    </ol>
                </div>
                <div class="col-sm-3">
                    <label class="m-0 float-right">
                        <input type="checkbox" class="trig-fn" data-value="select_all">
                        Select All
                    </label>
                </div>
            </div>
        </div>
    </section>
    @php
    $store_url = '';
    if ($data['type'] == 'permission') {
        $store_url = route('permission.store');
    } elseif ($data['type'] == 'role_permission') {
        $store_url = route('role.permissions.store', ['role' => $data['role']['id']]);
    } elseif ($data['type'] == 'user_permission') {
        $store_url = route('user.permissions.store', ['user' => $data['user']['id']]);
    }
    @endphp

    {!! Form::model('', [
    'method' => 'POST',
    'url' => $store_url,
    'class' => 'form-horizontal',
    'files' => false,
]) !!}
    <section class="content permissions-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive p-0">
                                <table class="table text-nowrap mb-0" wire:loading.class="loading">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="action">
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn" data-value="select_table">
                                                    Masters
                                                </label>
                                            </th>
                                            <th class="list">
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn"
                                                        data-value="select_column">
                                                    List
                                                </label>
                                            </th>
                                            <th class="add">Add</th>
                                            <th class="edit">Edit</th>
                                            <th class="export">
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn"
                                                        data-value="select_column">
                                                    Export
                                                </label>
                                            </th>
                                            <th class="others">Others</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr class="">
                                            <td>
                                                <label class="m-0 font-weight-bold">
                                                    <input type="checkbox" class="trig-fn" data-value="select_row">
                                                    Academics Masters
                                                </label>
                                            </td>
                                            <td>@php __getRightsCB('academic-master-list', 'List', $data) @endphp</td>
                                            <td>@php __getRightsCB('academic-master-add', 'Add', $data) @endphp</td>
                                            <td>@php __getRightsCB('academic-master-edit', 'Edit', $data) @endphp</td>
                                            <td>@php __getRightsCB('academic-master-export', 'Export', $data) @endphp</td>
                                            <td></td>
                                        </tr>

                                        <tr class="" id="section-id-2">
                                            <td>
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn"
                                                        data-value="select_section" data-section-id="section-id-2">
                                                    Program
                                                </label>
                                            </td>
                                            <td>@php __getRightsCB('program-list', 'List', $data) @endphp</td>
                                            <td>@php __getRightsCB('program-add', 'Add', $data) @endphp</td>
                                            <td>@php __getRightsCB('program-edit', 'Edit', $data) @endphp</td>
                                            <td>@php __getRightsCB('program-export', 'Export', $data) @endphp</td>
                                            <td></td>
                                        </tr>

                                        <tr class="section-class-2">
                                            <td>
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn"
                                                        data-value="select_section" data-section-class="section-class-2">
                                                    Course
                                                </label>
                                            </td>
                                            <td>@php __getRightsCB('course-list', 'List', $data) @endphp</td>
                                            <td>@php __getRightsCB('course-add', 'Add', $data) @endphp</td>
                                            <td>@php __getRightsCB('course-edit', 'Edit', $data) @endphp</td>
                                            <td>@php __getRightsCB('course-export', 'Export', $data) @endphp</td>
                                            <td></td>
                                        </tr>


                                        <tr class="">
                                            <td>
                                                <label class="m-0 font-weight-bold">
                                                    <input type="checkbox" class="trig-fn" data-value="select_row">
                                                    Enrollment Masters
                                                </label>
                                            </td>
                                            <td>@php __getRightsCB('enrollment-master-list', 'List', $data) @endphp</td>
                                            <td>@php __getRightsCB('enrollment-master-add', 'Add', $data) @endphp</td>
                                            <td>@php __getRightsCB('enrollment-master-edit', 'Edit', $data) @endphp</td>
                                            <td>@php __getRightsCB('enrollment-master-export', 'Export', $data) @endphp</td>
                                            <td></td>
                                        </tr>

                                        <tr class="">
                                            <td>
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn" data-value="select_row">
                                                    Grade Category
                                                </label>
                                            </td>
                                            <td>@php __getRightsCB('grade-category-list', 'List', $data) @endphp</td>
                                            <td>@php __getRightsCB('grade-category-add', 'Add', $data) @endphp</td>
                                            <td>@php __getRightsCB('grade-category-edit', 'Edit', $data) @endphp</td>
                                            <td>@php __getRightsCB('grade-category-export', 'Export', $data) @endphp</td>
                                            <td></td>
                                        </tr>

                                        <tr class="">
                                            <td>
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn" data-value="select_row">
                                                    Exam Pattern
                                                </label>
                                            </td>
                                            <td>@php __getRightsCB('exam-pattern-list', 'List', $data) @endphp</td>
                                            <td>@php __getRightsCB('exam-pattern-add', 'Add', $data) @endphp</td>
                                            <td>@php __getRightsCB('exam-pattern-edit', 'Edit', $data) @endphp</td>
                                            <td>@php __getRightsCB('exam-pattern-export', 'Export', $data) @endphp</td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive p-0">
                                <table class="table text-nowrap mb-0" wire:loading.class="loading">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="action" >
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn" data-value="select_table">
                                                    Other Masters
                                                </label>
                                            </th>
                                            <th class="list">
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn"
                                                        data-value="select_column">
                                                    List
                                                </label>
                                            </th>
                                            <th class="add">Add</th>
                                            <th class="edit">Edit</th>
                                            <th class="export">
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn"
                                                        data-value="select_column">
                                                    Export
                                                </label>
                                            </th>
                                            <th class="others">Others</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="section-class">
                                            <td>
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn" data-value="select_row">
                                                    Common Master
                                                </label>
                                            </td>
                                            <td>@php __getRightsCB('common-master-list', 'List', $data) @endphp</td>
                                            <td>@php __getRightsCB('common-master-add', 'Add', $data) @endphp</td>
                                            <td>@php __getRightsCB('common-master-edit', 'Edit', $data) @endphp</td>
                                            <td>@php __getRightsCB('common-master-export', 'Export', $data) @endphp</td>
                                            <td></td>
                                        </tr>

                                        <tr class="">
                                            <td>
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn" data-value="select_row">
                                                    Location Masters
                                                </label>
                                            </td>
                                            <td>@php __getRightsCB('location-master-list', 'List', $data) @endphp</td>
                                            <td>@php __getRightsCB('location-master-add', 'Add', $data) @endphp</td>
                                            <td>@php __getRightsCB('location-master-edit', 'Edit', $data) @endphp</td>
                                            <td>@php __getRightsCB('location-master-export', 'Export', $data) @endphp</td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                               
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive p-0">
                                <table class="table text-nowrap mb-0" wire:loading.class="loading">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="action" >
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn" data-value="select_table">
                                                    Enrollments
                                                </label>
                                            </th>
                                            <th class="list">
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn"
                                                        data-value="select_column">
                                                    List
                                                </label>
                                            </th>
                                            <th class="add">Add</th>
                                            <th class="edit">Edit</th>
                                            <th class="export">
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn"
                                                        data-value="select_column">
                                                    Export
                                                </label>
                                            </th>
                                            <th class="others">Others</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr class="">
                                            <td>
                                                <label class="m-0 ">
                                                    <input type="checkbox" class="trig-fn" data-value="select_row">
                                                    Enrollment
                                                </label>
                                            </td>
                                            <td>@php __getRightsCB('enrollment-list', 'List', $data) @endphp</td>
                                            <td>@php __getRightsCB('enrollment-add', 'Add', $data) @endphp</td>
                                            <td>@php __getRightsCB('enrollment-edit', 'Edit', $data) @endphp</td>
                                            <td>@php __getRightsCB('enrollment-export', 'Export', $data) @endphp</td>
                                            <td></td>
                                        </tr>

                                        <tr class="">
                                            <td>
                                                <label class="m-0 ">
                                                    <input type="checkbox" class="trig-fn" data-value="select_row">
                                                    Enrollment Student
                                                </label>
                                            </td>
                                            <td>@php __getRightsCB('enrollment-student-list', 'List', $data) @endphp</td>
                                            <td>@php __getRightsCB('enrollment-student-add', 'Add', $data) @endphp</td>
                                            <td>@php __getRightsCB('enrollment-student-edit', 'Edit', $data) @endphp</td>
                                            <td>@php __getRightsCB('enrollment-student-export', 'Export', $data) @endphp</td>
                                            <td></td>
                                        </tr>

                                        <tr class="">
                                            <td>
                                                <label class="m-0 ">
                                                    <input type="checkbox" class="trig-fn" data-value="select_row">
                                                    Enrollment Course
                                                </label>
                                            </td>
                                            <td>@php __getRightsCB('enrollment-course-list', 'List', $data) @endphp</td>
                                            <td>@php __getRightsCB('enrollment-course-add', 'Add', $data) @endphp</td>
                                            <td>@php __getRightsCB('enrollment-course-edit', 'Edit', $data) @endphp</td>
                                            <td>@php __getRightsCB('enrollment-course-export', 'Export', $data) @endphp</td>
                                            <td></td>
                                        </tr>
                                        
                                        <tr class="">
                                            <td>
                                                <label class="m-0 ">
                                                    <input type="checkbox" class="trig-fn" data-value="select_row">
                                                    Enrollment Exam pattern
                                                </label>
                                            </td>
                                            <td>@php __getRightsCB('enrollment-exam-pattern-list', 'List', $data) @endphp</td>
                                            <td>@php __getRightsCB('enrollment-exam-pattern-add', 'Add', $data) @endphp</td>
                                            <td>@php __getRightsCB('enrollment-exam-pattern-edit', 'Edit', $data) @endphp</td>
                                            <td>@php __getRightsCB('enrollment-exam-pattern-export', 'Export', $data) @endphp</td>
                                            <td></td>
                                        </tr>

                                        <tr class="">
                                            <td>
                                                <label class="m-0 ">
                                                    <input type="checkbox" class="trig-fn" data-value="select_row">
                                                    Enrollment Mark
                                                </label>
                                            </td>
                                            <td>@php __getRightsCB('enrollment-mark-list', 'List', $data) @endphp</td>
                                            <td>@php __getRightsCB('enrollment-mark-add', 'Add', $data) @endphp</td>
                                            <td>@php __getRightsCB('enrollment-mark-edit', 'Edit', $data) @endphp</td>
                                            <td>@php __getRightsCB('enrollment-mark-export', 'Export', $data) @endphp</td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive p-0">
                                <table class="table text-nowrap mb-0" wire:loading.class="loading">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="action" >
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn" data-value="select_table">
                                                    Students
                                                </label>
                                            </th>
                                            <th class="list">
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn"
                                                        data-value="select_column">
                                                    List
                                                </label>
                                            </th>
                                            <th class="add">Add</th>
                                            <th class="edit">Edit</th>
                                            <th class="export">
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn"
                                                        data-value="select_column">
                                                    Export
                                                </label>
                                            </th>
                                            <th class="others">Others</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                    
                                        <tr class="">
                                            <td>
                                                <label class="m-0 ">
                                                    <input type="checkbox" class="trig-fn" data-value="select_row">
                                                    Student
                                                </label>
                                            </td>
                                            <td>@php __getRightsCB('student-list', 'List', $data) @endphp</td>
                                            <td>@php __getRightsCB('student-add', 'Add', $data) @endphp</td>
                                            <td>@php __getRightsCB('student-edit', 'Edit', $data) @endphp</td>
                                            <td>@php __getRightsCB('student-export', 'Export', $data) @endphp</td>
                                            <td></td>
                                        </tr>
                    
                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive p-0">
                                <table class="table text-nowrap mb-0" wire:loading.class="loading">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="action" >
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn" data-value="select_table">
                                                    Staffs
                                                </label>
                                            </th>
                                            <th class="list">
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn"
                                                        data-value="select_column">
                                                    List
                                                </label>
                                            </th>
                                            <th class="add">Add</th>
                                            <th class="edit">Edit</th>
                                            <th class="export">
                                                <label class="m-0">
                                                    <input type="checkbox" class="trig-fn"
                                                        data-value="select_column">
                                                    Export
                                                </label>
                                            </th>
                                            <th class="others">Others</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                    
                                        <tr class="">
                                            <td>
                                                <label class="m-0 ">
                                                    <input type="checkbox" class="trig-fn" data-value="select_row">
                                                    Staff
                                                </label>
                                            </td>
                                            <td>@php __getRightsCB('staff-list', 'List', $data) @endphp</td>
                                            <td>@php __getRightsCB('staff-add', 'Add', $data) @endphp</td>
                                            <td>@php __getRightsCB('staff-edit', 'Edit', $data) @endphp</td>
                                            <td>@php __getRightsCB('staff-export', 'Export', $data) @endphp</td>
                                            <td></td>
                                        </tr>
                    
                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>                    

                </div>
            </div>
            <div class="card-footer col-lg-12 ">
                {!! Form::submit('Save', ['class' => 'btn btn-success float-right']) !!}
            </div>

           
        </div>
    </section>
    {!! Form::close() !!}
    @push('scripts')
        <script>
            $(function() {
                $(".trig-fn").click(function() {
                    var cond = $(this).data('value');
                    var checkval = this.checked;
                    switch (cond) {

                        case 'select_all':
                            $('table [type="checkbox"]').prop('checked', checkval);
                            break;

                        case 'select_table':
                            $(this).closest('table').find('input:checkbox').prop('checked', checkval);
                            break;

                        case 'select_row':
                            $(this).closest('tr').find('td input:checkbox').prop('checked', checkval);
                            break;

                        case 'select_column':
                            var col = $(this).closest('th').parent().children("th").index($(this).closest(
                            'th'));
                            col++;
                            $(this).closest('table').find('tbody td:nth-child(' + col + ') input:checkbox')
                                .prop('checked', checkval);
                            break;

                        case 'select_section':
                            if ($(this).data('section-id')) {
                                var sectionid = $(this).data('section-id');
                                $('#' + sectionid + ' input:checkbox').prop('checked', checkval);
                            }
                            if ($(this).data('section-class')) {
                                var sectionclass = $(this).data('section-class');
                                $('.' + sectionclass + ' input:checkbox').prop('checked', checkval);
                            }
                            break;
                    }
                });
            });
        </script>
    @endpush
@endsection
@extends('layouts.admin')
@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">{{ !empty($record->id) ? 'Edit' : 'Add' }} Program Category</h1>
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
               </div>
               <!-- /.card-header -->
               <div class="card-body">
			   		{!! Form::model($record, [
							'method' => ($record->id) ? 'PUT' : 'POST',
							'url' => ($record->id)
									? route('programcategories.update', $record->id)
									: route('programcategories.store', []),
							'class' => 'form-horizontal',
							'files' => false
						]) !!}
			   		<div class="form-group row">
						{!! Form::label('title', "Program Category", ['class' => 'required col-sm-2 control-label']) !!}
						<div class="col-sm-10">
							{!! 
								Form::text('title', old('title'), ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'maxlength' => '50']) 
								!!}
							{!! $errors->first('title', '<span class="error invalid-feedback">:message</span>') !!}
						</div>
					</div>
					<div class="form-group row">
						{!! Form::label('short_name', "Short Name", ['class' => 'required col-sm-2 control-label']) !!}
						<div class="col-sm-10">
							{!! Form::text('short_name', old('short_name'), ['class' => 'form-control' . ($errors->has('short_name') ? ' is-invalid' : ''), 'maxlength' => '50']) !!}
							{!! $errors->first('short_name', '<span class="error invalid-feedback">:message</span>') !!}
						</div>
					</div>
					<div class="form-group row">
						{!! Form::label('active', "Active", ['class' => 'col-sm-2 control-label']) !!}
						<div class="col-sm-10">
							{!! Form::checkbox('active',1, old('active'), ['class' => ' ' . ($errors->has('active') ? ' is-invalid' : '' )]) !!} 
							{!! $errors->first('active', '<span class="error invalid-feedback">:message</span>') !!}
						</div>
					</div>
               	</div>
               	<div class="card-footer clearfix">
				   	{!! Form::submit('Save', ['class' => 'btn btn-success float-right']) !!}							

					{!! Form::close() !!}
               </div>
               <!-- /.card-body -->
            </div>
         <!-- /.card -->
         </div>
      </div>
	</div>
</div>  

@endsection
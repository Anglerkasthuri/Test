@extends('layouts.admin')

@section('content')
    <div class="content cus-card-ctrl">
        <div class="row">
            @include('admin.elements.sidebar')

            <div class="col-xl-12">
                <div class="card">
                  

                    <div class="card-header header-elements-inline">
								<h6 class="card-title">View Admin Users</h6>

								<div class="header-elements">
									
			                	</div>
                            </div>
                            

                    <div class="card-body">
                                          

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width:150px;">ID</th>
                                        <td>{{ $adminusers->id }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:150px;"> Name </th>
                                        <td> {{ $adminusers->name }} </td>
                                    </tr>
                                    <tr>
                                        <th style="width:150px;"> Email </th>
                                        <td> {{ $adminusers->email }}  </td>
                                    </tr>
                                    
                      
                                    <tr>
                                          <th style="width:150px;"> Timezone </th>
                                         <td> {{ $adminusers->timezone->value  }} [ {{ $adminusers->timezone->text }} ] </td>
                                    </tr>
                                    <tr>
                                        <th style="width:150px;"> Status </th>
                                        <td>{{ config('settings.active_field')[$adminusers->status] }}  </td>
                                    </tr>                                    
                                    <tr>
                                        <th style="width:150px;"> Created At</th>
                                        <td> {{ $adminusers->created_at }} </td>
                                    </tr>
                                    @if(!empty($adminusers->created_user->name))
                                    <tr>
                                        <th style="width:150px;"> Created By</th>
                                        <td> {{ $adminusers->created_user->name }} </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th style="width:150px;"> Modified At</th>
                                        <td> {{ $adminusers->updated_at }} </td>
                                    </tr>
                                    @if(!empty($adminusers->updated_user->name))
                                    <tr>
                                        <th style="width:150px;"> Modified By</th>
                                        <td> {{ $adminusers->updated_user->name }} </td>
                                    </tr>
                                    @endif
                                      
                                </tbody>
                            </table>
                        </div>

                        <div class="col-xl-12">

                        <div class="float-right">

                         <a href="{{ route('admin.adminusers.edit', ['adminuser'=>$adminusers->id]) }}" title="Edit Admin Users"><button class="btn btn-success btn-sm"><i class="icon-pencil mr-2" aria-hidden="true"></i> Edit</button></a>
                        <!-- <form method="POST" action="{{ route('admin.adminusers.destroy', ['adminuser'=>$adminusers->id]) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete tutor" ><i class="icon-bin2 mr-2" aria-hidden="true"></i> Delete</button>
                        </form> -->


                         </div>
                         </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

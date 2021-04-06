@extends('rbac::layouts.master')

@section('content')
<script>
  $(document).ready(function (){
    //Initialize Select2 Elements
    $('.select2').select2();
  });
</script>
<section class="content">
	<div class="row">
		<div class="col-xs-3"></div>
		<div class="col-xs-6">
			<form action="/user-role" method="POST" role="search">
			    {{ csrf_field() }}
			    <div style="display: inline-block;">
			    	<div class="input-group">
				       <div class="form-group">
			                <label>User</label>
			                 <select class="form-control select2" style="width: 100%;" name="user_id">
			             	@foreach($user_list as $user)
			             		<option value="{{ $user->id  }}">{{ $user->full_name }} ({{ $user->username }})</option>
			             	@endforeach
		                </select>
		              </div>
		              <br>
		              <div class="form-group">
			                <label>Role</label>
			                 <select class="form-control" style="width: 100%;" name="role_id">
			             	@foreach($role_list as $role)
			             		<option value="{{ $role->id  }}">{{ $role->display_name }}</option>
			             	@endforeach
		                </select>
		              </div>
		               <div class="form-group pull-right">
			                <br>
			                <input type="submit" name="submit" class="btn btn-info" value="Search User Role">
			                <input type="submit" name="submit" class="btn btn-success" value="Assign Role">
		                </select>
		              </div>
				    </div>
				    
			    </div>
			</form>
			<br>
			<br>
		</div>

		
		
			@if($search_result!=NULL && count($search_result)>0)
			<div class="col-xs-3">
				<div class="box box-danger">
					
					<h3 class="text-center">Result</h3>
					
						<ol>
						<h4>Current Roles:</h4>
						@foreach($search_result as $result)
							<li>{{ $result->role->display_name }}</li>
						@endforeach
						</ol>
						<br>
					</div>
				</div>
			@elseif($search_result!=NULL)
			<div class="col-xs-3">
				<div class="box box-danger">
					
					<h3 class="text-center">Result</h3>
					<p style="padding-left:15px;">No roles found!</p>
				
					<br>
				</div>
			</div>
		@endif
		
		

		<div class="col-xs-12">

			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><b>{{ $title }}</h3>
					<div class="box-tools">
					</div>
				</div>
			<!-- /.box-header -->
	          	<div class="box-body table-responsive no-padding">
	              <table class="table table-hover">
	              	<tr>
	                  <th>#</th>
	                  <th>Employee Name</th>
	                  <th>Username</th>
	                  <th>Role Name</th>
	                  <th>Created at</th>
	                  <th>Updated at</th>
	                  <th>Edit</th>
	             	</tr>

	             	@php 
		             	$color = "";
	             	@endphp
	             	@foreach($user_role_list as $key => $user_role)
	         		
	         			<tr style="font-weight: normal;" bgcolor="<?php if(($key + $user_role_list->firstItem())%2==1) echo "#eaeef1"; else echo "#ffffff"?>">
		         			<td>{{$key + $user_role_list->firstItem()}}</td>
		         			<td>{{$user_role->user->full_name}} </td>
		         			<td>{{$user_role->user->username}}</td>
		         			<td>{{$user_role->role->display_name}}</td>
		         			<td>{{$user_role->created_at}}</td>
		         			<td>{{$user_role->updated_at}}</td>


		         			<td><a href="user-role/edit/{{ $user_role->id }}"><i class="fa fa-edit"></i></a></td>
	             		</tr>
	             	@endforeach

	              </table>
	            </div>
            <!-- /.box-body -->
            <div class="box-footer text-right">
            	{{$user_role_list->links()}}  
            </div>
			</div>
		<!-- /.box -->
		</div>
	</div>
</section>

@endsection
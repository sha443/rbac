@extends('rbac::layouts.master')
<style type="text/css">
	input[type=checkbox]
	{
	  /* Double-sized Checkboxes */
	  -ms-transform: scale(2); /* IE */
	  -moz-transform: scale(2); /* FF */
	  -webkit-transform: scale(2); /* Safari and Chrome */
	  -o-transform: scale(2); /* Opera */
	  transform: scale(2);
	  padding: 12px;
	}

	/* Might want to wrap a span around your checkbox text */
	.checkboxtext
	{
	  /* Checkbox text */
	  font-size: 110%;
	  display: inline;
	}
</style>
@section('content')

<section class="content">
	<div class="row">
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
	                  <th>Role Name (ID)</th>
	                  <th>Permission Name (ID)</th>
	                  <th>Created at</th>
	                  <th>Updated at</th>
	                  <!-- <th>Edit</th> -->
	             	</tr>

	             	@php 
		             	$color = "";
	             	@endphp
	             	@foreach($role_permission_list as $key => $role_permission)
	         		
	         			<tr style="font-weight: normal;" bgcolor="<?php if(($key + $role_permission_list->firstItem())%2==1) echo "#eaeef1"; else echo "#ffffff"?>">
	         				<td> {{ $key + $role_permission_list->firstItem() }} </td>
		         			<td>{{$role_permission->role->display_name}} ({{$role_permission->role_id}})</td>
		         			<td>{{$role_permission->permission->display_name}} ({{$role_permission->permission_id}})</td>
		         			<td>{{$role_permission->created_at}}</td>
		         			<td>{{$role_permission->updated_at}}</td>


		         			<!-- <td><a href="role-permission/edit/{{ $role_permission->id }}"><i class="fa fa-edit"></i></a></td> -->
	             		</tr>
	             	@endforeach

	              </table>
	            </div>
            <!-- /.box-body -->
            <div class="box-footer text-right">
            	{{$role_permission_list->links()}}  
            </div>
			</div>
		<!-- /.box -->
		</div>
	</div>
</section>

@endsection
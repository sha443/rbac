@extends('rbac::layouts.master')

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
	          	<div class="box-body table-responsive no-padding">
	              <table class="table table-hover">
	              	<tr>
	                  <th>Role ID</th>
	                  <th>Menu ID</th>
	                  <th>Created at</th>
	                  <th>Updated at</th>
	             	</tr>

	             	@php 
		             	$i=1;
		             	$color = "";
	             	@endphp
	             	@foreach($role_menu_list as $role_menu)
	         		
	         			<tr style="font-weight: normal;" bgcolor="<?php if($i++%2==1) echo "#eaeef1"; else echo "#ffffff"?>">
		         			<td>{{$role_menu->role_id}}</td>
		         			<td>{{$role_menu->menu_id}}</td>
		         			<td>{{$role_menu->created_at}}</td>
		         			<td>{{$role_menu->updated_at}}</td>
		         		
	             		</tr>
	             	@endforeach

	              </table>
	            </div>
            <!-- /.box-body -->
			</div>
		<!-- /.box -->
		</div>
	</div>
</section>
@endsection
@extends('rbac::layouts.master')

@section('content')

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><b>{{ $title }}</h3>
					<div class="box-tools">
						<div class="input-group-btn text-right">
	                    	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="margin-right: 20px"><i class="fa fa-plus"></i>  Add</button>
	                    </div>
						<div class="input-group input-group-sm">

		                  

		                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
		                    <div class="modal-dialog" role="document">
		                      <div class="modal-content">
		                        <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                          <h4 class="modal-title">Add New Role</h4>
		                        </div>
		                        <form action=" {{ route('role_create') }} " method="post">
		                        	{{ csrf_field() }}
			                        <div class="modal-body">
			                          <div class="box-body">
		                            	<div class="form-group">
			                                <input type="hidden" class="form-control" id="id" name="id" />
			                              </div>
			                              <div class="form-group">
			                                <label>Name</label>
			                                <input class="form-control" id="name" name="name" placeholder="Name"/>
			                              </div>

			                              <div class="form-group">
			                                <label>Display Name</label>
			                                <input class="form-control" id="display_name" name="display_name" placeholder="Display Name"/>
			                              </div>
			                              <div class="form-group">
			                                <label>Active</label>
			                                <select class="form-control"  name="active">
			                                	<option value="1">1</option>
			                                	<option value="0">0</option>
			                                </select>
			                              </div>
			                          </div>
			                        </div>
			                        <div class="modal-footer">
			                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			                          <input type="submit" class="btn btn-primary" name="submit" value="Submit">
			                        </div>
		                    	</form>
		                      </div><!-- /.modal-content -->
		                    </div><!-- /.modal-dialog -->
		                  </div><!-- /.modal -->

		                  <!--<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">-->

		                  <!--<div class="input-group-btn">-->
		                    <!--<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>-->
		                  <!--</div>-->

		                </div>
					</div>
				</div>
			<!-- /.box-header -->
	          	<div class="box-body table-responsive no-padding">
	              <table class="table table-hover">
	              	<tr>
	                  <th>#</th>
	                  <th>Name</th>
	                  <th>Display Name</th>
	                  <th>Created at</th>
	                  <th>Updated at</th>
	                  <th>Active</th>
	                  <th>Edit</th>
	             	</tr>

	             	@php 
		             	$color = "";
	             	@endphp
	             	@foreach($role_list as $key=> $role)
	         		
	         			<tr style="font-weight: normal;" bgcolor="<?php if(($key + $role_list->firstItem())%2==1) echo "#eaeef1"; else echo "#ffffff"?>">
		         			<td>{{ $key + $role_list->firstItem() }}</td>
		         			<td>{{$role->name}}</td>
		         			<td>{{$role->display_name}}</td>
		         			<td>{{$role->created_at}}</td>
		         			<td>{{$role->updated_at}}</td>
		         			<td>{{$role->active}}</td>
		         			<td><button type="button" class="btn btn-success btn-xs"  onclick="editItem({{$role->id}},'{{ $role->name }}','{{ $role->display_name }}')"><i class="fa fa-edit"></i></button></td>
	             		</tr>
	             	@endforeach

	              </table>
	            </div>
            <!-- /.box-body -->
            <div class="box-footer text-right">
            	{{$role_list->links()}}  
            </div>
			</div>
		<!-- /.box -->
		</div>
	</div>
</section>

@section('script')
<script type="text/javascript">
	function editItem(id, name, display_name)
	{
		document.getElementById('id').value = id;
		document.getElementById('name').value = name;
		document.getElementById('display_name').value = display_name;
		$("#myModal").modal();
	}
</script>
@endsection
@endsection
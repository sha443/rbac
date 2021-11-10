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
		                          <h4 class="modal-title">Add New Menu Item</h4>
		                        </div>
		                        <form action="{{ route('manu_create') }}" method="post">
		                        	{{ csrf_field() }}
			                        <div class="modal-body">
			                          <div class="box-body">
		                            	<div class="form-group">
			                                <input type="hidden" class="form-control" id="id" name="id" />
			                              </div>
			                              
			                              <div class="form-group">
			                                <label>Display Name</label>
			                                <input class="form-control" id="display_name" name="display_name" placeholder="Display Name"/>
			                              </div>
			                              <div class="form-group">
			                                <label>Action</label>
			                                <input class="form-control" id="action" name="action" placeholder="/action"/>
			                              </div>
			                              <div class="form-group">
			                                <label>Icon</label>
			                                <input class="form-control" id="icon" name="icon" placeholder="fa fa-ok"/>
			                              </div>
			                              <div class="form-group">
			                                <label>Display Level</label>
			                                <input type="text" class="form-control" name="level" required placeholder="0, 1, 2 ... etc.">
			                              </div>
			                              <div class="form-group">
			                                <label>Active</label>
			                                <select class="form-control"  name="active" id='active'>
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
	                  <th>Display Name</th>
	                  <th>Action</th>
	                  <th>Icon</th>
	                  <th>Display Level</th>
	                  <th>Created at</th>
	                  <th>Updated at</th>
	                  <th>Active</th>
	                  <th>Edit</th>
	             	</tr>

	             	@php 
		             	$color = "";
	             	@endphp
	             	@foreach($menu_list as $key => $menu)
	         		
	         			<tr style="font-weight: normal;" bgcolor="<?php if(($key + $menu_list->firstItem())%2==1) echo "#eaeef1"; else echo "#ffffff"?>">
		         			<td>{{$key + $menu_list->firstItem()}}</td>
		         			<td>{{$menu->display_name}}</td>
		         			<td>{{$menu->action}}</td>
		         			<td>{{$menu->icon}}</td>
		         			<td>{{$menu->level}}</td>
		         			<td>{{$menu->created_at}}</td>
		         			<td>{{$menu->updated_at}}</td>
		         			<td>{{$menu->active}}</td>
		         			<td><button type="button" class="btn btn-success btn-xs"  onclick="editItem({{$menu->id}},'{{ $menu->action }}','{{ $menu->display_name }}','{{ $menu->icon }}','{{ $menu->active }}')"><i class="fa fa-edit"></i></button></td>
	             		</tr>
	             	@endforeach

	              </table>
	            </div>
            <!-- /.box-body -->
            <div class="box-footer text-right">
            	{{$menu_list->links()}}  
            </div>
			</div>
		<!-- /.box -->
		</div>
	</div>
</section>

@section('script')
<script type="text/javascript">
	function editItem(id, action, display_name, icon, active)
	{
		document.getElementById('id').value = id;
		document.getElementById('action').value = action;
		document.getElementById('display_name').value = display_name;
		document.getElementById('icon').value = icon;
		document.getElementById('active').value = active;
		$("#myModal").modal();
	}
</script>
@endsection
@endsection
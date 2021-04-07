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
		<div class="col-xs-3"></div>
		<div class="col-xs-6">
			<form action="/role-permission/old-permission" method="GET">
			    {{ csrf_field() }}
			    <div style="display: inline-block;">
			    	<div class="input-group">
				       
		              <div class="form-group">
			                <h4>Select a Role</h4>
			                 <select class="form-control" style="width: 100%;" name="role_id" onchange="this.form.submit()">
			                 	<option value="" disabled selected>Please Select a role</option>
			             	@foreach($role_list as $role)
			             		@isset($role_id)
				             		@if($role_id!=NULL && $role_id==$role->id)
				             			<option value="{{ $role->id  }}" selected>{{ $role->display_name }} </option>
				             		@else
			             			<option value="{{ $role->id  }}">{{ $role->display_name }}</option>
			             			@endif
			             		@else
			             			<option value="{{ $role->id  }}">{{ $role->display_name }}</option>
			             		@endisset
			             		
			             	@endforeach
		                	</select>
		              </div>
		              <br> 
				    </div>
			    </div>
			</form>
			<form action="/role-permission" method="POST">
			    {{ csrf_field() }}
			    <div style="display: inline-block;">
			    	<div class="input-group">
				        <input type="hidden" name="role_id" value="{{ $role_id or 'NULL' }}"/>
		            
		              <div class="form-group">
			                <h4>Select Permissions</h4>
			                <br>
			               @foreach($permission_groups as $permission_list)
			               @php 
			               		$key = explode( '@', $permission_list[0]->display_name)[0];
			               		$group_all_check = 1;
			               @endphp
			               
			               <div class="form-group">
			                 @foreach($permission_list as $permission)
			                 <?php 

			                 	if(isset($old_role_permission_id_array) && in_array($permission->id,$old_role_permission_id_array))
			                 	{

			                 		echo  '<input type="checkbox" name="permission['.$permission->id .']" data-group="'.$key.'"  id="'.$permission->id.'" value="'.$permission->id.'" checked /> <span class="checkboxtext"> &nbsp;'.$permission->display_name.' </span> <br>';
			                 	}
			                 	else
			                 	{
			                 		echo '<input type="checkbox"  name="permission['.$permission->id .']" data-group="'.$key.'" id="'.$permission->id.'" value="'.$permission->id.'" /> <span class="checkboxtext"> &nbsp;'.$permission->display_name.' </span> <br>';

			                 		$group_all_check = 0;
			                 	}
			                 ?>
			             	@endforeach

			             	@if($group_all_check)

			             		<input type="checkbox" name="select-group" id="{{$key}}" onclick="toggleChekbox(this.id);" checked /><span class="checkboxtext alert-info"> &nbsp;Select all in {{ $key }}</span> <br>

			             	@else
			             		<input type="checkbox" name="select-group" id="{{$key}}" onclick="toggleChekbox(this.id);" /><span class="checkboxtext alert-info"> &nbsp;Toggle all in {{ $key }}</span> <br>
			             	@endif

			             </div>
			             @endforeach
		              </div>

		               <div class="form-group pull-right">
			                <input type="submit" name="submit" class="btn btn-success" value="Assign Role Permissions">
		              </div>

		               <input type="checkbox" name="select-all" id="select-all"/><span class="checkboxtext alert-warning"> &nbsp;Select All</span>
		             	
				    </div>
				    
			    </div>
			</form>

			<br>
			<br>
		</div>
	</div>
</section>

@endsection

@section('script')
<script type="text/javascript">
	// Listen for click on toggle checkbox
$('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});


function toggleChekbox(id_to_name)
{
	var group = document.getElementById(id_to_name);
	if(group.checked)
	{
		var groupAll = $('[data-group="'+id_to_name+'"]');
		for (var i = 0; i < groupAll.length; i++) {
		  groupAll[i].checked = true;
		}
	}
	else
	{
		var groupAll = $('[data-group="'+id_to_name+'"]');
		for (var i = 0; i < groupAll.length; i++) {
		  groupAll[i].checked = false;
		}
	}
	
}
</script>
@endsection
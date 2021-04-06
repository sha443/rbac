@extends('rbac::layouts.master')

@section('content')

<section class="content">
	<div class="row">
		<div class="col-xs-3"></div>
		<div class="col-xs-6">
			<form action="/user-role/{{$user_role->id}}" method="POST" role="search">
			    {{ csrf_field() }}
			    {{ method_field('PUT') }}
			    <div style="display: inline-block;">
			    	<div class="input-group">
				       <div class="form-group">
			                <label>User</label>
			                 <select class="form-control" style="width: 100%;" name="user_id">
			             	@foreach($user_list as $user)
			             		@if ($user_role->user_id == $user->id)
								      <option value="{{ $user->id }}" selected>{{ $user->full_name }} ({{ $user->username }})</option>
								@else
								      <option value="{{ $user->id }}">{{ $user->full_name }} ({{ $user->username }})</option>
								@endif
			             	@endforeach
		                </select>
		              </div>
		              <br>
		              <div class="form-group">
			                <label>Role</label>
			                 <select class="form-control" style="width: 100%;" name="role_id">
			             	@foreach($role_list as $role)
			             		@if ($user_role->role_id == $role->id)
								      <option value="{{ $role->id }}" selected>{{ $role->display_name }}</option>
								@else
								      <option value="{{ $role->id }}">{{ $role->display_name }}</option>
								@endif
			             	@endforeach
		                </select>
		              </div>
		               <div class="form-group pull-right">
			                <br>
			                <input type="submit" name="submit" class="btn btn-success" value="Update Role">
		                </select>
		              </div>
				    </div>
				    
			    </div>
			</form>
			<br>
			<br>
		</div>
	</div>
</section>

@endsection
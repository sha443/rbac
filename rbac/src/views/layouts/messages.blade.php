@if (isset($messages))
	<div class="col-md-12 text-center">
			@foreach ($messages as $message)
		      <div class="alert alert-{{ $message['level'] }} alert-dismissible"  style="display: inline-block">
	                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
	                <!-- <h4><i class="icon fa fa-{{ $message['level'] }}"></i> {{ ucfirst($message['level']) }}!</h4> -->
	                {{ $message['message'] }}
	          </div>
		  	@endforeach
	</div>
@endif

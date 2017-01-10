@if(session('success_status'))
	<div class="col-xs-12 alert alert-success">
		{{ session('success_status') }}
	</div>
@endif
@if(session('danger_status'))
	<div class="col-xs-12 alert alert-danger">
		{{ session('danger_status') }}
	</div>
@endif
@if(session('warning_status'))
	<div class="col-xs-12 alert alert-warning">
		{{ session('warning_status') }}
	</div>
@endif
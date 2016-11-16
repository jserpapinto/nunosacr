<!-- Admin template for artists --> 

@extends('admin.layout')

@section('title', 'Obras')

@section('subtitle', 'Lista de Obras')

@section('addBtn')
	<a href="{!! URL::action('Admin\WorkController@editCreate') !!}" class="btn btn-primary">
		<i class="glyphicon glyphicon-plus"></i>
		Nova Obra
	</a>
@endsection

@section('content')
	@if(Request::get('created'))
		<div class="col-xs-12 alert alert-success">
			Sucesso, Obra criada!
		</div>
	@endif
	@if(Request::get('updated'))
		<div class="col-xs-12 alert alert-success">
			Sucesso, Obra atualizada!
		</div>
	@endif
	@if(Request::get('deleted')) 
		<div class="col-xs-12 alert alert-danger">
			Obra apagada!
		</div>
	@endif
	<!-- List All Artists -->
	<div class="col-xs-12">
		@if($allWorks->isEmpty())
			<div class="col-xs-12">
				<p class="text-center"><strong>Lista de obras vazia</strong></p>
			</div>
		@endif
		<ul class="list-group">

			@foreach ($allWorks as $work)
				<li class="list-group-item">
					<!-- Artist name -->
					<div class="col-xs-7 col-sm-2">{{ $work->name }}</div>
					<!-- .Artist name -->

					<!-- Artist bio -->
					<div class="hidden-xs col-sm-4">
						<img src="/upload/works/thumb/{{ $work->img }}" class="img-responsive"/>
					</div>
					<!-- .Artist bio -->

					<!-- Artist email -->
					<div class="hidden-xs col-sm-3">{{ $work->artist_name }}</div>
					<!-- .Artist email -->

					<!-- Action Buttons -->
					<div class="col-xs-5 col-sm-3">
						<!-- Update Button -->
						<div class="col-xs-6"> 
							<a href="/admin/obras/{{ $work->work_slug }}">
								<button type="button" class=" btn btn-sm btn-warning btn-edit">
									<i class="glyphicon glyphicon-pencil"></i>
								</button>
							</a>
						</div>
						<!-- .Update Button -->
						<!-- Delete Form -->
						<div class="col-xs-6"> 
							{!! Form::open(['action' => ["Admin\WorkController@remove", $work->work_slug],  'method' => 'DELETE', 'name' => "deleteForm-" . $work->work_slug ]) !!}
								<button onclick="removeItem(this);" type="button" class="btn btn-sm btn-danger btn-remove">
									<i class="glyphicon glyphicon-remove"></i>
								</button>
							{!! Form::close() !!}
						</div>
						<!-- .Delete Form -->
					</div>
					<!-- .Action Buttons -->
				</li>
			@endforeach

		</ul>
	</div>
	<!-- .List All Artists -->
@endsection
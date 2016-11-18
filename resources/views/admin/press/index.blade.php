<!-- Admin template for artists --> 

@extends('admin.layout')

@section('title', 'Press')

@section('subtitle', 'Lista de Presses')

@section('addBtn')
	<a href="{!! URL::action('Admin\PressController@editCreate') !!}" class="btn btn-primary">
		<i class="glyphicon glyphicon-plus"></i>
		Novo Press
	</a>
@endsection

@section('content')
	@if(Request::get('created'))
		<div class="col-xs-12 alert alert-success">
			Sucesso, Press criado!
		</div>
	@endif
	@if(Request::get('updated'))
		<div class="col-xs-12 alert alert-success">
			Sucesso, Press atualizado!
		</div>
	@endif
	@if(Request::get('deleted')) 
		<div class="col-xs-12 alert alert-danger">
			Press apagado!
		</div>
	@endif
	<!-- List All Artists -->
	<div class="col-xs-12">
		@if($allPress->isEmpty())
			<div class="col-xs-12">
				<p class="text-center"><strong>Lista de presses vazia</strong></p>
			</div>
		@endif
		<ul class="list-group">

			@foreach ($allPress as $press)
				<li class="list-group-item">
					<!-- Artist name -->
					<div class="col-xs-7 col-sm-2">{{ $press->name }}</div>
					<!-- .Artist name -->

					<!-- Artist bio -->
					<div class="hidden-xs col-sm-4">
						<img src="/upload/press/thumb/{{ $press->img }}" class="img-responsive"/>
					</div>
					<!-- .Artist bio -->

					<!-- Artist email -->
					<div class="hidden-xs col-sm-3">
						@if ($press->pdf)
						<a href="/upload/press/pdfs/{{ $press->pdf }}">
							<button class="btn btn-default">
								PDF
							</button>
						</a>
						@else
							Sem PDF
						@endif
					</div>
					<!-- .Artist email -->

					<!-- Action Buttons -->
					<div class="col-xs-5 col-sm-3">
						<!-- Update Button -->
						<div class="col-xs-6"> 
							<a href="/admin/press/{{ $press->slug }}/editar">
								<button type="button" class=" btn btn-sm btn-warning btn-edit">
									<i class="glyphicon glyphicon-pencil"></i>
								</button>
							</a>
						</div>
						<!-- .Update Button -->
						<!-- Delete Form -->
						<div class="col-xs-6"> 
							{!! Form::open(['action' => ["Admin\PressController@remove", $press->slug],  'method' => 'DELETE', 'name' => "deleteForm-" . $press->slug ]) !!}
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
<!-- Admin template for artists --> 

@extends('admin.layout')

@section('title', 'Exposições')

@section('subtitle', 'Lista de Exposições')

@section('addBtn')
	<a href="{!! URL::action('Admin\ExhibitionController@editCreate') !!}" class="btn btn-primary">
		<i class="glyphicon glyphicon-plus"></i>
		Nova Exposição
	</a>
@endsection

@section('content')
	@if(Request::get('created'))
		<div class="col-xs-12 alert alert-success">
			Sucesso, Exposição criada!
		</div>
	@endif
	@if(Request::get('updated'))
		<div class="col-xs-12 alert alert-success">
			Sucesso, Exposição atualizada!
		</div>
	@endif
	@if(Request::get('deleted')) 
		<div class="col-xs-12 alert alert-danger">
			Exposição apagada!
		</div>
	@endif
	<!-- List All Artists -->
	<div class="col-xs-12">
		@if($allExhibitions->isEmpty())
			<div class="col-xs-12">
				<p class="text-center"><strong>Lista de Exposições vazia</strong></p>
			</div>
		@endif
		<ul class="list-group">

			@foreach ($allExhibitions as $exhibition)
				<li class="list-group-item">
					<!-- Artist name -->
					<div class="col-xs-7 col-sm-2">{{ $exhibition->title }}</div>
					<!-- .Artist name -->

					<!-- Artist bio -->
					<div class="hidden-xs col-sm-4">
						<img src="/upload/exhibitions/thumb/{{ $exhibition->img }}" class="img-responsive"/>
					</div>
					<!-- .Artist bio -->

					<!-- Artist email -->
					<div class="hidden-xs col-sm-3">
						@if ($exhibition->catalog)
						<a target="_blank" href="/upload/exhibitions/catalogs/{{ $exhibition->catalog }}">
							<button class="btn btn-default">
								Catálogo
							</button>
						</a>
						@else
							Sem Catálogo
						@endif
					</div>
					<!-- .Artist email -->

					<!-- Action Buttons -->
					<div class="col-xs-5 col-sm-3">
						<!-- Update Button -->
						<div class="col-xs-6"> 
							<a href="/admin/exposicoes/{{ $exhibition->slug }}/editar">
								<button type="button" class=" btn btn-sm btn-warning btn-edit">
									<i class="glyphicon glyphicon-pencil"></i>
								</button>
							</a>
						</div>
						<!-- .Update Button -->
						<!-- Delete Form -->
						<div class="col-xs-6"> 
							{!! Form::open(['action' => ["Admin\ExhibitionController@remove", $exhibition->slug],  'method' => 'DELETE', 'name' => "deleteForm-" . $exhibition->slug ]) !!}
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
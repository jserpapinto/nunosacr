<!-- Admin template for artists --> 

@extends('admin.layout')

@section('title', 'Obras')

@section('subtitle', 'Lista de Obras')

@section('addBtn')
	<div class="row">
		<div class="col-xs-12">
			<a href="{!! URL::action('Admin\WorkController@editCreate') !!}" class="btn btn-primary">
				<i class="glyphicon glyphicon-plus"></i>
				Nova Obra
			</a>
		</div>
		<hr>
		<div class="col-xs-12">
			<a href="{!! URL::action('Admin\WorkController@index') !!}" class="btn btn-default">
				<i class="glyphicon glyphicon-search"></i>
				Todas
			</a>
			<a href="{!! URL::action('Admin\WorkController@indexWithoutOpportunities') !!}" class="btn btn-default">
				<i class="glyphicon glyphicon-search"></i>
				Excepto Oportunidades
			</a>
			<a href="{!! URL::action('Admin\WorkController@indexOpportunities') !!}" class="btn btn-default">
				<i class="glyphicon glyphicon-search"></i>
				Apenas Oportunidades
			</a>
		</div>
	</div>
@endsection

@section('content')

	@include('admin.shared.alertMessages')

	<div class="col-xs-12 form-group">
		{!! Form::open(['action' => ["Admin\WorkController@search"],  'method' => 'GET', 'name' => "search"]) !!}
			<div class="input-group">
				{!! Form::label('search', 'Pesquisar', ['class' => 'input-group-addon']) !!}
				{!! Form::text('search', isset($_GET['search']) ? $_GET['search'] : null, ['class' => 'form-control']) !!}
				{!! Form::submit('GO', ['class' => 'form-control btn btn-primary']) !!}
			</div>
		{!! Form::close() !!}
	</div>
	

	<!-- List All Artists -->
	<div class="col-xs-12">
		@unless($allWorks)
			<div class="col-xs-12">
				<p class="text-center"><strong>Lista de obras vazia</strong></p>
			</div>
		@endunless
		<ul class="list-group">

			@foreach ($allWorks as $work)
				<li class="list-group-item {{ $work->featured_to_home && $work->opportunity == 1 ? "destacado-opo" : null }} {{ $work->featured_to_home && $work->opportunity == 0 ? "destacado" : null }}">
					<!-- Artist name -->
					<div class="col-xs-6 col-sm-2">{{ $work->name }}</div>
					<!-- .Artist name -->

					<!-- Artist bio -->
					<div class="hidden-xs col-sm-4">
						<img src="/upload/works/thumb/{{ $work->img }}" class="img-responsive"/>
					</div>
					<!-- .Artist bio -->

					<!-- Artist email -->
					<div class="hidden-xs col-sm-3">
						<a href="{!! action("Admin\ArtistController@listWorks", $work->artist_slug) !!}">
							{{ $work->artist_name }}
						</a>
					</div>
					<!-- .Artist email -->

					<!-- Action Buttons -->
					<div class="col-xs-6 col-sm-3">
						<!-- Update Button -->
						<div class="col-xs-6"> 
							<a href="/admin/obras/{{ $work->slug }}/editar">
								<button type="button" class=" btn btn-sm btn-warning btn-edit">
									<i class="glyphicon glyphicon-pencil"></i>
								</button>
							</a>
						</div>
						<!-- .Update Button -->
						<!-- Delete Form -->
						<div class="col-xs-6"> 
							{!! Form::open(['action' => ["Admin\WorkController@remove", $work->slug],  'method' => 'DELETE', 'name' => "deleteForm-" . $work->slug ]) !!}
								<button onclick="removeItem(this);" type="button" class="btn btn-sm btn-danger btn-remove">
									<i class="glyphicon glyphicon-remove"></i>
								</button>
							{!! Form::close() !!}
						</div>
						<!-- .Delete Form -->
							<!-- Opportunity feature -->
							<div class="col-xs-12"> 
								<a href="/admin/obras/{{ $work->slug }}/destaque_oportunidade">
									<button type="button" class=" btn btn-sm btn-{{ $work->featured_to_home ? "default" : "primary" }} btn-edit">
										<i class="glyphicon glyphicon-{{ $work->featured_to_home ? "minus" : "plus" }}"></i>
										{{ $work->featured_to_home ? "Tirar destaque" : "Destacar" }}
									</button>
								</a>
							</div>
							<!-- .Opportunity feature -->
					</div>
					<!-- .Action Buttons -->

					<!-- .Action Buttons -->
					@if ($work->opportunity)
						<!-- Opportunity badge -->
						<div class="opportunity-badge">
							Oportunidade
						</div>
						<!-- .Opportunity badge -->
					@endif
				</li>
			@endforeach

		</ul>

		{{ $allWorks->links('vendor.pagination.default') }}
	</div>
	<!-- .List All Artists -->
@endsection
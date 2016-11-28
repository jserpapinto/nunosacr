<!-- Admin template for artists --> 

@extends('admin.layout')

@section('title', 'Artistas')

@section('subtitle', 'Lista de Artistas')

@section('addBtn')
	<a href="{!! URL::action('Admin\ArtistController@editCreate') !!}" class="btn btn-primary">
		<i class="glyphicon glyphicon-plus"></i>
		Novo Artista
	</a>
@endsection

@section('content')
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
	<!-- List All Artists -->
	<div class="col-xs-12">
		<ul class="list-group">
			@if($allArtists->isEmpty())
				<div class="col-xs-12">
					<p class="text-center"><strong>Lista de Artistas vazia</strong></p>
				</div>
			@endif

			@foreach ($allArtists as $artist)
				<li class="list-group-item {{ ($artist->featured) ? "destacado" : null }}">
					<!-- Artist name -->
					<div class="col-xs-5 col-sm-2">{{ $artist->name }}</div>
					<!-- .Artist name -->

					<!-- Artist bio -->
					<div class="hidden-xs col-sm-4">
						<img src="/upload/artists/profile/thumb/{{ $artist->img }}" class="img-responsive"/>
					</div>
					<!-- .Artist bio -->

					<!-- Artist email -->
					<div class="hidden-xs col-sm-3">{{ $artist->email }}</div>
					<!-- .Artist email -->

					<!-- Action Buttons -->
					<div class="col-xs-7 col-sm-3">
						<div class="row">
							<!-- Update Button -->
							<div class="col-xs-6"> 
								<a href="/admin/artistas/{{ $artist->slug }}/editar">
									<button type="button" class=" btn  btn-warning btn-edit">
										<i class="glyphicon glyphicon-pencil"></i>
									</button>
								</a>
							</div>
							<!-- .Update Button -->
							<!-- Delete Form -->
							<div class="col-xs-6"> 
								{!! Form::open(['action' => ["Admin\ArtistController@remove", isset($artist) ? $artist->slug : $artist ],  'method' => 'DELETE', 'name' => "deleteForm-" . $artist->slug ]) !!}
									<button onclick="removeItem(this);" type="button" class="btn btn-danger btn-remove">
										<i class="glyphicon glyphicon-remove"></i>
									</button>
								{!! Form::close() !!}
							</div>
							<!-- .Delete Form -->
						</div>
						<div class="row">
							<!-- View all Works Button -->
							<div class="col-xs-12"> 
								<a href="/admin/artistas/{{ $artist->slug }}/obras" class=" btn btn-default btn-info">
									<i class="glyphicon glyphicon-search"></i>
									Obras
								</a>

								@unless ($artist->featured)
									<a href="{!! URL::action('Admin\ArtistController@feature', $artist->slug) !!}" class="btn btn-primary">
										<i class="glyphicon glyphicon-plus"></i>
										Destacar
									</a>
								@endunless
							</div>
							<!-- .View all Works Button -->
						</div>
					</div>
					<!-- .Action Buttons -->
				</li>
			@endforeach

		</ul>
	</div>
	<!-- .List All Artists -->
@endsection
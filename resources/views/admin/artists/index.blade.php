<!-- Admin template for artists --> 

@extends('admin.layout')

@section('title', 'Artistas')

@section('subtitle', 'Lista de Artistas')

@section('addBtn')
	<a href="{!! URL::action('ArtistController@editCreate') !!}" class="btn btn-primary">
		<i class="glyphicon glyphicon-plus"></i>
		Novo Artista
	</a>
@endsection

@section('content')
	@if(Request::get('created'))
		<div class="col-xs-12 alert alert-success">
			Sucesso, Artista criado!
		</div>
	@endif
	@if(Request::get('updated'))
		<div class="col-xs-12 alert alert-success">
			Sucesso, Artista atualizado!
		</div>
	@endif
	@if(Request::get('deleted')) 
		<div class="col-xs-12 alert alert-danger">
			Artista apagado!
		</div>
	@endif
	<!-- List All Artists -->
	<div class="col-xs-12">
		<ul class="list-group">

			@foreach ($allArtists as $artist)
				<li class="list-group-item">
					<!-- Artist name -->
					<div class="col-xs-7 col-sm-2">{{ $artist->name }}</div>
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
					<div class="col-xs-5 col-sm-3">
						<!-- Delete Form -->
						<div class="pull-right"> 
							{!! Form::open(['action' => ["ArtistController@remove", $artist],  'method' => 'delete', 'name' => "deleteForm-" . $artist->id ]) !!}
								<button onclick="removeArtist(this);" type="button" class="btn btn-sm btn-danger btn-remove">
									<i class="glyphicon glyphicon-remove"></i>
								</button>
							{!! Form::close() !!}
						</div>
						<!-- .Delete Form -->
						<!-- Update Button -->
						<div class="pull-right"> 
							<a href="/admin/artistas/{{ $artist->id }}">
								<button type="button" class="pull-right btn btn-sm btn-warning btn-edit">
									<i class="glyphicon glyphicon-pencil"></i>
								</button>
							</a>
						</div>
						<!-- .Update Button -->
					</div>
					<!-- .Action Buttons -->
				</li>
			@endforeach

		</ul>
	</div>
	<!-- .List All Artists -->
@endsection
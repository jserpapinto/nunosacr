<!-- Admin template for artists --> 

@extends('admin.layout')

@section('title', "$artist->name")

@section('subtitle', "Obras do Artista" )

@section('addBtn')
	<a href="/admin/artistas/{{ $artist->slug }}/editar">
		<button class="btn btn-primary ">Editar Artista</button>
	</a>
@endsection

@section('content')


	@if (isset($artist) && !empty($artist->img))
		<div class="col-xs-4">
		    <img alt="Imagem de Artista" class="img-responsive" src="/upload/artists/profile/midsize/{{ $artist->img }}" />
		</div>
	@endif

	@include('admin.shared.alertMessages')


	<div class="col-xs-12 form-group">
		<ul class="list-group">
			@if($works->isEmpty())
				<div class="col-xs-12">
					<p class="text-center"><strong>Artista não tem obras associadas</strong></p>
				</div>
			@endif
			@foreach($works as $work)
				<li class="list-group-item {{ $work->featured_to_artist ? "destacado" : null }}">
					<div class="col-xs-3">{{ $work->name }}</div>
					<div class="col-xs-3"><img src="/upload/works/thumb/{{ $work->img}}" class="img-responsive" /></div>
					<div class="col-xs-2"><strong>{{ $work->price }}</strong><br/><small>{{ $work->discount }}</small></div>
					<div class="col-sm-1 hidden-xs">{!! $work->opportunity == 1 ? "Sim" : "Não" !!}</div>
					<div class="col-xs-3">
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
							{!! Form::open(['action' => ["Admin\WorkController@remove", $work->work_slug],  'method' => 'DELETE', 'name' => "deleteForm-" . $work->work_slug ]) !!}
								<button onclick="removeItem(this);" type="button" class="btn btn-sm btn-danger btn-remove">
									<i class="glyphicon glyphicon-remove"></i>
								</button>
							{!! Form::close() !!}
						</div>
						<!-- .Delete Form -->
						<!-- Feature work from Artist Button -->
						{{--<div class="col-xs-12"> 
							<a href="{!! URL::action('Admin\WorkController@featureToArtist', [$work->slug, $artist->id]) !!}" class="btn btn-{{ $work->featured_to_artist ? "default" : "primary" }}">
								<i class="glyphicon glyphicon-{{ $work->featured_to_artist ? "minus" : "plus" }}"></i>
								{{ $work->featured_to_artist ? "Tirar Destaque" : "Destacar" }}
							</a>
						</div>--}}
						<!-- .Feature work from Artist Button -->

					</div>
				</li>
			@endforeach
		</ul>
		
	</div>
@endsection
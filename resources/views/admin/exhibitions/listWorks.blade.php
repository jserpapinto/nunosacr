<!-- Admin template for artists --> 

@extends('admin.layout')

@section('title', $exhibition->title)

@section('subtitle', 'Obras associadas à exposição')

@section('addBtn')
	<a href="{{ route('ExhibitionEdit', $exhibition->slug) }}" class="btn btn-primary">
		<i class="glyphicon glyphicon-pencil"></i> Editar Exposição
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

	{{--<!-- List All Artists and Works -->
	<div class="col-xs-12">
		@if($allArtists->isEmpty())
			<div class="col-xs-12">
				<p class="text-center"><strong>Exposição sem artistas associados.</strong></p>
			</div>
		@else
			<h3>Artistas</h3>
		@endif

		<ul class="list-group">
			@foreach ($allArtists as $artist)
				<li class="list-group-item">
					<!-- Work name -->
					<div class="col-xs-7 col-sm-2">{{ $artist->name }}</div>
					<!-- .Work name -->

					<!-- Work bio -->
					<div class="hidden-xs col-sm-4">
						<img src="{!! asset("upload/artists/profile/thumb/$artist->img") !!}" class="img-responsive"/>
					</div>
					<!-- .Work bio -->


					<!-- Action Buttons -->
					<div class="col-xs-5 col-sm-3">
						<div class="row">
							<!-- Update Button -->
							<div class="col-xs-6"> 
								<a href="{!! route('artistEdit', $artist->slug) !!}">
									<button type="button" class=" btn btn-sm btn-warning btn-edit">
										<i class="glyphicon glyphicon-pencil"></i>
									</button>
								</a>
							</div>
							<!-- .Update Button -->
							<!-- Delete Form -->
							<div class="col-xs-6"> 
								{!! Form::open(['action' => ["Admin\ArtistController@remove", $artist->slug],  'method' => 'DELETE', 'name' => "deleteForm-" . $artist->slug ]) !!}
									<button onclick="removeItem(this);" type="button" class="btn btn-sm btn-danger btn-remove">
										<i class="glyphicon glyphicon-remove"></i>
									</button>
								{!! Form::close() !!}
							</div>
							<!-- .Delete Form -->
						</div>
					</div>
					<!-- .Action Buttons -->
				</li>
			@endforeach
		</ul>
	</div>--}}

	<div class="col-xs-12">
		@if($allWorks->isEmpty())
			<div class="col-xs-12">
				<p class="text-center"><strong>Exposição sem obras associadas.</strong></p>
			</div>
		@else
			<h3>Obras</h3>
		@endif

		<ul class="list-group">

			@foreach ($allWorks as $work)
				<li class="list-group-item {{ ($work->featured_to_exhibition) ? "destacado" : null }}">
					<!-- Work name -->
					<div class="col-xs-7 col-sm-2">{{ $work->name }}</div>
					<!-- .Work name -->

					<!-- Work bio -->
					<div class="hidden-xs col-sm-4">
						<img src="{!! asset("upload/works/thumb/$work->img") !!}" class="img-responsive"/>
					</div>
					<!-- .Work bio -->


					<!-- Action Buttons -->
					<div class="col-xs-5 col-sm-3">
						<div class="row">
							<!-- Update Button -->
							<div class="col-xs-6"> 
								<a href="{!! route('workEdit', $work->slug) !!}">
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
							<div class="col-xs-12">
								<a href="{{ route('WorkExhibitionFeature', [$exhibition->slug, $work->slug]) }}">

									@unless ($work->featured_to_exhibition)
										<button type="button" class=" btn btn-sm btn-primary ">
											<i class="glyphicon glyphicon-plus"></i> Destacar
										</button>
									@else
										<button type="button" class=" btn btn-sm btn-default ">
											<i class="glyphicon glyphicon-minus"></i> Tirar Destacar
										</button>
									@endif
									
								</a> 
							</div>
						</div>
					</div>
					<!-- .Action Buttons -->
				</li>
			@endforeach

		</ul>
	</div>
	<!-- .List All Artists -->
@endsection
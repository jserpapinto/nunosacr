<!-- Admin template for artists --> 

@extends('admin.layout')

@section('title', 'Artista')

@section('subtitle', isset($artist) ? $artist->name : "Novo Artista")


@section('content')

	@if (isset($artist) && !empty($artist->img))
		<div class="col-xs-4">
		    <img alt="Imagem de Artista" class="img-responsive" src="/upload/artists/profile/midsize/{{ $artist->img }}" />
		</div>
	@endif

	@if (count($errors) > 0)
	    <div class="alert alert-danger col-xs-12">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif

	<div class="form-group">
		{!! Form::open(['action' => [isset($artist) ? "Admin\ArtistController@update" : "Admin\ArtistController@create", isset($artist) ? $artist->slug : $artist],  'method' => isset($artist) ? 'put' : "post", 'files' => true]) !!}

			<div class="col-xs-12 col-md-6">
				<!-- Nome -->
				<div class="input-group">
					{!! Form::label('name', 'Nome', ['class' => 'input-group-addon']) !!}
					{!! Form::text('name', isset($artist) ? "$artist->name" : null, ['class' => 'form-control']) !!}
				</div>
				<!-- .Nome -->
				<!-- Site -->
				<div class="input-group">
					{!! Form::label('site', 'Site', ['class' => 'input-group-addon']) !!}
					{!! Form::text('site', isset($artist) ? "$artist->site" : null, ['class' => 'form-control']) !!}
				</div>
				<!-- Site -->
				<!-- Email -->
				<div class="input-group">
					{!! Form::label('email', 'Email', ['class' => 'input-group-addon']) !!}
					{!! Form::email('email', isset($artist) ? "$artist->email" : null, ['class' => 'form-control']) !!}
				</div>
				<!-- Email -->
				<!-- CV -->
				<div class="input-group">
					{!! Form::label('cv', 'CV', ['class' => 'input-group-addon']) !!}
					{!! Form::file('cv',  ['class' => 'form-control']) !!}

					@if (isset($artist) && !empty($artist->cv))
						<span class="input-group-addon">
							<a target="_blank" href="{{ asset('/upload/artists/cv/' . $artist->cv) }}">CV</a>
						</span>
					@endif
				</div>
				<!-- CV -->
				<!-- Imagem -->
				<div class="input-group">
					{!! Form::label('img', 'Imagem', ['class' => 'input-group-addon']) !!}
					{!! Form::file('img', ['class' => 'form-control']) !!}
				</div>
				<!-- Imagem -->
			</div>
			<!-- Bio -->
			<div class="col-xs-12 col-md-6">
				<div class="input-group">
					{!! Form::label('bio', 'Biografia', ['class' => 'input-group-addon']) !!}
					{!! Form::textarea('bio', isset($artist) ? "$artist->bio" : null, ['class' => 'form-control']) !!}
				</div>
			</div>
			<!-- .Bio -->
			<!-- Submit -->
			<div class="col-xs-12">
				{!! Form::submit('Atualizar', ['class' => 'btn btn-success']) !!}
			</div>
			<!-- .Submit -->

		{!! Form::close() !!}
	</div>
@endsection
<!-- Admin template for artists --> 

@extends('admin.layout')

@section('title', 'Artista')

@section('subtitle', $artist->name)


@section('content')

	@if (!empty($artist->img))
		<div class="col-xs-4">
		    <img alt="Imagem de Artista" class="img-responsive" src="/upload/artist/$artist->id/$artist->img" />
		</div>
	@endif

	<div class="form-group">
		{!! Form::open(['action' => ["ArtistController@update", $artist],  'method' => 'put', 'files' => true]) !!}

			<div class="col-xs-12 col-md-6">
				<!-- Nome -->
				<div class="input-group">
					{!! Form::label('name', 'Nome', ['class' => 'input-group-addon']) !!}
					{!! Form::text('name', "$artist->name", ['class' => 'form-control']) !!}
				</div>
				<!-- .Nome -->
				<!-- Site -->
				<div class="input-group">
					{!! Form::label('site', 'Site', ['class' => 'input-group-addon']) !!}
					{!! Form::text('site', "$artist->site", ['class' => 'form-control']) !!}
				</div>
				<!-- Site -->
				<!-- Email -->
				<div class="input-group">
					{!! Form::label('email', 'Email', ['class' => 'input-group-addon']) !!}
					{!! Form::email('email', "$artist->email", ['class' => 'form-control']) !!}
				</div>
				<!-- Email -->
				<!-- CV -->
				<div class="input-group">
					{!! Form::label('cv', 'CV', ['class' => 'input-group-addon']) !!}
					{!! Form::file('cv',  ['class' => 'form-control']) !!}
					<span class="input-group-addon">
						<a href='/upload/$artist->id/cv/$artist->cv'>CV</a>
					</span>
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
					{!! Form::textarea('bio', "$artist->bio", ['class' => 'form-control']) !!}
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
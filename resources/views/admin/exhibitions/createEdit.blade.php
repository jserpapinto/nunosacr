<!-- Admin template for exhibition --> 

@extends('admin.layout')

@section('title', 'Exposições')

@section('subtitle', isset($exhibition) ? $exhibition->title : "Nova Exposição")


@section('content')
	@if (isset($exhibition) && !empty($exhibition->img))
		<div class="col-xs-4">
		    <img alt="Imagem de Exposição" class="img-responsive" src="/upload/exhibitions/midsize/{{ $exhibition->img }}" />
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


	@include('admin.shared.alertMessages')
	

	<div class="form-group">
		{!! Form::open(['action' => [isset($exhibition) ? "Admin\ExhibitionController@update" : "Admin\ExhibitionController@create", isset($exhibition) ? $exhibition->slug : $exhibition],  'method' => isset($exhibition) ? 'put' : "post", 'files' => true]) !!}

			<div class="col-xs-12 col-md-6">
				<!-- Nome -->
				<div class="input-group">
					{!! Form::label('title', 'Título', ['class' => 'input-group-addon']) !!}
					{!! Form::text('title', isset($exhibition) ? "$exhibition->title" : null, ['class' => 'form-control']) !!}
				</div>
				<!-- .Nome -->
				<!-- Catalog -->
				<div class="input-group">
					{!! Form::label('catalog', 'Catálogo', ['class' => 'input-group-addon']) !!}
					{!! Form::text('catalog',  isset($exhibition) ? "$exhibition->catalog" : null, ['class' => 'form-control']) !!}

					@if (isset($exhibition) && !empty($exhibition->catalog))
						<span class="input-group-addon">
							<a target="_blank" href="http://{{ $exhibition->catalog }}">Catálogo</a>
						</span>
					@endif
				</div>
				<!-- Catalog -->
				<!-- Imagem -->
				<div class="input-group">
					{!! Form::label('img', 'Imagem', ['class' => 'input-group-addon']) !!}
					{!! Form::file('img', ['class' => 'form-control']) !!}
				</div>
				<!-- Imagem -->
				<!-- Artists -->
				<div class="input-group">
					{!! Form::label('artists', 'Artistas', ['class' => 'input-group-addon']) !!}
					{!! Form::select('artists[]', $allArtists, isset($exhibition) ? $exhibitionArtists : null, ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'artists']) !!}
				</div>
				<!-- .Artists -->
				<!-- Works -->
				<div class="input-group">
					{!! Form::label('works', 'Obras', ['class' => 'input-group-addon']) !!}
					{!! Form::select('works[]', $allWorks, isset($exhibition) ? $exhibitionWorks : null, ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'works']) !!}
				</div>
				<!-- .Works -->
				<!-- From -->
				<div class="input-group">
					{!! Form::label('from', 'Data Início', ['class' => 'input-group-addon']) !!}
					{!! Form::date('from', isset($exhibition) ? "$exhibition->from" : \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
				</div>
				<!-- .From -->
				<!-- To -->
				<div class="input-group">
					{!! Form::label('to', 'Data Fim', ['class' => 'input-group-addon']) !!}
					{!! Form::date('to', isset($exhibition) ? "$exhibition->to" : \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
				</div>
				<!-- .To -->
			</div>
			<!-- Bio -->
			<div class="col-xs-12 col-md-6">
				<div class="input-group">
					{!! Form::label('description', 'Descrição', ['class' => 'input-group-addon']) !!}
					{!! Form::textarea('description', isset($exhibition) ? "$exhibition->description" : null, ['class' => 'form-control']) !!}
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
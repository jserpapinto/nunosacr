<!-- Admin template for press --> 

@extends('admin.layout')

@section('title', 'Press')

@section('subtitle', isset($press) ? $press->name : "Novo Press")


@section('content')

	@if (isset($press) && !empty($press->img))
		<div class="col-xs-4">
		    <img alt="Imagem de Press" class="img-responsive" src="/upload/press/midsize/{{ $press->img }}" />
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
		{!! Form::open(['action' => [isset($press) ? "Admin\PressController@update" : "Admin\PressController@create", isset($press) ? $press->slug : $press],  'method' => isset($press) ? 'put' : "post", 'files' => true]) !!}

			<div class="col-xs-12 col-md-6">
				<!-- Nome -->
				<div class="input-group">
					{!! Form::label('name', 'Título', ['class' => 'input-group-addon']) !!}
					{!! Form::text('name', isset($press) ? "$press->name" : null, ['class' => 'form-control']) !!}
				</div>
				<!-- .Nome -->
				<!-- CV -->
				<div class="input-group">
					{!! Form::label('pdf', 'PDF', ['class' => 'input-group-addon']) !!}
					{!! Form::file('pdf',  ['class' => 'form-control']) !!}

					@if (isset($press) && !empty($press->pdf))
						<span class="input-group-addon">
							<a target="_blank" href="{{ asset('/upload/press/pdfs/' . $press->pdf) }}">PDF</a>
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
					{!! Form::label('description', 'Descrição', ['class' => 'input-group-addon']) !!}
					{!! Form::textarea('description', isset($press) ? "$press->description" : null, ['class' => 'form-control']) !!}
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
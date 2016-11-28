<!-- Admin template for works --> 

@extends('admin.layout')

@section('title', 'Obra')

@section('subtitle', isset($work) ? $work->name : "Nova Obra")


@section('content')

	@if (isset($work) && !empty($work->img))
		<div class="col-xs-4">
		    <img alt="Imagem da obra" class="img-responsive" src="/upload/works/midsize/{{ $work->img }}" />
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

	<div class="form-group">
		{!! Form::open(['action' => [isset($work) ? "Admin\WorkController@update" : "Admin\WorkController@create", isset($work) ? $work->slug : $work],  'method' => isset($work) ? 'put' : "post", 'files' => true]) !!}

			<div class="col-xs-12 col-md-6">
				<!-- Nome -->
				<div class="input-group">
					{!! Form::label('name', 'Nome', ['class' => 'input-group-addon']) !!}
					{!! Form::text('name', isset($work) ? "$work->name" : null, ['class' => 'form-control']) !!}
				</div>
				<!-- .Nome -->
				<!-- Site -->
				<div class="input-group">
					{!! Form::label('price', 'Preço', ['class' => 'input-group-addon']) !!}
					{!! Form::number('price', isset($work) ? "$work->price" : null, ['class' => 'form-control', 'step' => '0.01', 'min' => 0]) !!}
				</div>
				<!-- .Site -->
				<!-- Email -->
				<div class="input-group">
					{!! Form::label('discount', 'Desconto', ['class' => 'input-group-addon']) !!}
					{!! Form::number('discount', isset($work) ? "$work->discount" : null, ['class' => 'form-control', 'step' => '0.01', 'min' => 0]) !!}
				</div>
				<!-- .Email -->
				<!-- Artist -->
				<div class="input-group">
					{!! Form::label('artist', 'Artista', ['class' => 'input-group-addon']) !!}
					{!! Form::select('artist',  $allArtists, isset($work) ? $work->artist_id : null, ['class' => 'form-control']) !!}
				</div>
				<!-- .Artist -->
				<!-- Imagem -->
				<div class="input-group">
					{!! Form::label('img', 'Imagem', ['class' => 'input-group-addon']) !!}
					{!! Form::file('img', ['class' => 'form-control']) !!}
				</div>
				<!-- .Imagem -->
				<!-- Oportunidade -->
				<div class="input-group">
					{!! Form::label('opportunity', 'Oportunidade', ['class' => 'input-group-addon']) !!}
					Sim: {!! Form::radio('opportunity', 1, isset($work) && $work->opportunity == true ? true : false, ['class' => 'radio-inline']) !!}
					Não: {!! Form::radio('opportunity', 0, isset($work) && $work->opportunity == false ? true : false, ['class' => 'radio-inline']) !!}
				</div>
				<!-- .Oportunidade -->
				<!-- Sold -->
				<div class="input-group">
					{!! Form::label('sold', 'Vendido', ['class' => 'input-group-addon']) !!}
					Sim: {!! Form::radio('sold', 1, isset($work) && $work->sold == true ? true : false, ['class' => 'radio-inline']) !!}
					Não: {!! Form::radio('sold', 0, isset($work) && $work->sold == false ? true : false, ['class' => 'radio-inline']) !!}
				</div>
				<!-- .Sold -->
			</div>
			<!-- Bio -->
			<div class="col-xs-12 col-md-6">
				<div class="input-group">
					{!! Form::label('description', 'Descrição', ['class' => 'input-group-addon']) !!}
					{!! Form::textarea('description', isset($work) ? "$work->description" : null, ['class' => 'form-control']) !!}
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

@section('pageScripts')
<script type="text/javascript">


/*$(document).ready(function() {
	var names = JSON.parse('{!! $allArtists !!}');
	console.log(names);
	$( "#q" ).autocomplete({
	  source: names,
	  minLength: 3,
	  select: function(event, ui) {
	  	$('#q').val(ui.item.value);
	  }
	});

})*/
</script>
@endsection
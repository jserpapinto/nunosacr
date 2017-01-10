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
				<!-- Imagem BANNER -->
				<div class="input-group">
					{!! Form::label('imgBanner', 'Imagem Banner (1920x525)', ['class' => 'input-group-addon']) !!}
					{!! Form::file('imgBanner', ['class' => 'form-control']) !!}
				</div>
				<!-- Imagem BANNER -->
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
				<!-- Artists -->
				<div class="input-group">
					{!! Form::label('artists', 'Artistas', ['class' => 'input-group-addon']) !!}
					{!! Form::text('artist', null, ['class' => 'form-control', 'id' => 'artists', 'placeholder' => 'Comece a escrever o nome do artista']) !!}
					<ul id="artist-list" class="list-group"></ul>
				</div>
				<!-- Works to select -->
				<div class="row ">
					<div class=" col-xs-12">Obras do artista selecionado</div>
					<div class="col-xs-12">
						<ul id="works-ul" class="list-group ">
							
						</ul>
					</div>
				</div>
				<!-- .Works to select -->
				<!-- .Artists -->
				{{--<!-- Works -->
				<div class="input-group">
					{!! Form::label('works', 'Obras', ['class' => 'input-group-addon']) !!}
					{!! Form::select('works[]', $allWorks, isset($exhibition) ? $exhibitionWorks : null, ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'works']) !!}
				</div>
				<!-- .Works -->--}}
			</div>
			<!-- Bio -->
			<div class="col-xs-12 col-md-6">
				<div class="input-group">
					{!! Form::label('description', 'Descrição', ['class' => 'input-group-addon']) !!}
					{!! Form::textarea('description', isset($exhibition) ? "$exhibition->description" : null, ['class' => 'form-control']) !!}
				</div>
			</div>
			<!-- .Bio -->
			<!-- Works selected -->
			<div class="col-xs-12 col-md-6">
				<div class="row ">
					<div class=" col-xs-12">Obras selecionadas</div>
					<div class="col-xs-12">
						<ul id="works-selected-ul" class="list-group ">
							@if (isset($exhibitionWorks))
								@foreach($exhibitionWorks as $work)
									{!! Form::hidden('selected_works[]',  $work->id, []) !!}
									<li class="col-xs-12 list-group-item" data-id="{{$work->id}}">
										<div class="row">
											<div class="col-xs-5">{{$work->name}}</div>
											<div class="col-xs-4">
												<img src="{!! asset("/upload/works/thumb/" . $work->img) !!}" class="img-responsive pull-right mini" />
											</div>
											<div class="col-xs-3">
												<button type="button" class="pull-right btn btn-danger unfeature-work"><i class="glyphicon glyphicon-remove"></i></button>
											</div>
										</div>
									</li>
								@endforeach
							@endif
						</ul>
					</div>
				</div>
			</div>
			<!-- .Works selected -->
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
	// Template
	var template = '<a href="javascript:;"><li class="list-group-item artist-li" data-id="ID">NOME</li></a>';

	// On keyup get artists name to present his works
	$('#artists').on('keyup', function() {
		console.log($(this).val());
		// Sem letras no input, quit
		if ($(this).val().length == 0) {
			$('#artist-list').html("");
			return false;
		}
		// Com letras no input
		$.ajax({
			url: '{{ action('Admin\ExhibitionController@matchArtist') }}',
			data: {
				search: $(this).val()
			},
			type: 'GET',
			success: function(res) {
				console.log(res);
				// Limpa ul
				$('#artist-list').html("");

				// Verifica se tem resultados
				if (!res.data.length == 0) {
					// Põe resultados na UL
					res.data.forEach(function(artist) {
						$('#artist-list').append(
							template.replace('NOME', artist.name)
									.replace('ID', artist.id)
						);
					});
				} else {
					// Sem resultados
					$('#artist-list').append(template.replace('NOME', 'Sem resultados'));
				}
			},
			error: function(xhr, desc, err) {
				console.log("erro"); 
				console.log(xhr, err); 
			} 
		})
	});


	var template2 = '<li class="col-xs-12 list-group-item" data-id="ID"><div class="row"><div class="col-xs-5">NOME</div><div class="col-xs-4"><img src="{!! asset("/upload/works/thumb/") !!}/SRC" class="img-responsive pull-right mini" /></div><div class="col-xs-3"><button type="button" DESATIVADO class="pull-right btn btn-primary feature-work"><i class="glyphicon GLY"></i></button></div></div></li>';
	// On click get works from artist
	$(document).on('click', '.artist-li', function() {
		// Limpa ul
		$('#artists').val($(this).html());
		$('#artist-list').html("");
		var este = $(this);

		$.ajax({
			url: '{{ action('Admin\ExhibitionController@getWorksFromArtist') }}',
			data: {
				id: $(this).data('id')
			},
			type: 'GET',
			success: function(res) {
				console.log(res);
				// Limpa ul
				$('#works-ul').html("");

				// Verifica se tem resultados
				if (!res.length == 0) {
					// Check quais tao selecionados
					var idsSelected = [];
					for (var i = 0; i < $('#works-selected-ul').find('input').length; i++) {
						idsSelected.push($('#works-selected-ul').find('input')[i].value);
					}

					// Põe resultados na UL
					res.forEach(function(work) {
						var desativado = '';
						if (idsSelected.indexOf(work.id.toString()) != -1) {
							desativado = 'disabled="disabled"';
						}
						$('#works-ul').append(
							template2.replace('NOME', work.name)
									.replace('SRC', work.img)
									.replace('ID', work.id)
									.replace('GLY', 'glyphicon-share-alt')
									.replace('DESATIVADO', desativado)
						);
					});
				} else {
					// Sem resultados
					var t = '<li class="col-xs-12 list-group-item"><div class="row"><div class="col-xs-5">NOME</div></div></li>';
					$('#works-ul').append(
						t.replace('NOME', 'Sem Obras')
					);
				}
			},
			error: function(xhr, desc, err) {
				console.log("erro"); 
				console.log(xhr, err); 
			} 
		})
	});

	// Feature Work
	$(document).on('click', '.feature-work', function() {
		// Add hidden input pra poder inserir
		$('#works-selected-ul').append('<input type="hidden" name="selected_works[]" value="'+ $(this).closest('li').data('id') +'" />');
		$('#works-selected-ul').append('<li class="col-xs-12 list-group-item" data-id="' + $(this).closest('li').data('id') + '">' + 
								$(this).closest('li')
								.clone()
								.html()
								.replace('primary','danger')
								.replace('glyphicon-share-alt', 'glyphicon-remove')
								.replace('feature-work', 'unfeature-work') + '</li>'
		);
		$(this).prop('disabled',true);
	});

	// Unfeature Work
	$(document).on('click', '.unfeature-work', function() {
		var id = $(this).closest('li').prev().val();
		//Remove hidden input
		$(this).closest('li').prev().remove();
		$(this).closest('li').remove();
		for (var j = 0; j < $('#works-ul').find('li').length; j++) {
			if ($('#works-ul').find('li')[j].dataset.id == id) $($('#works-ul').find('li')[j]).find('button').prop('disabled', false);
		}
	});

</script>
@stop
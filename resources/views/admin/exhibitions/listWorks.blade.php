<!-- Admin template for artists --> 

@extends('admin.layout')

@section('title', $exhibition->title)

@section('subtitle', 'Lista de Exposições')

@section('addBtn')
	<a href="{!! URL::action('Admin\ExhibitionController@editCreate', $exhibition->slug) !!}" class="btn btn-primary">
		<i class="glyphicon glyphicon-plus"></i>
		Editar Exposição
	</a>
@endsection

@section('content')
	@if(Request::get('created'))
		<div class="col-xs-12 alert alert-success">
			Sucesso, Exposição criada!
		</div>
	@endif
	@if(Request::get('updated'))
		<div class="col-xs-12 alert alert-success">
			Sucesso, Exposição atualizada!
		</div>
	@endif
	@if(Request::get('deleted')) 
		<div class="col-xs-12 alert alert-danger">
			Exposição apagada!
		</div>
	@endif
	<!-- List All Artists -->
	<div class="col-xs-12">
		@if($allWorks->isEmpty())
			<div class="col-xs-12">
				<p class="text-center"><strong>Exposição sem obras associadas.</strong></p>
			</div>
		@endif
		<ul class="list-group">

			@foreach ($allWorks as $work)
				<li class="list-group-item">
					<!-- Work name -->
					<div class="col-xs-7 col-sm-2">{{ $work->title }}</div>
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
								<a href="/admin/works/{{ $exhibition->slug }}/editar">
									<button type="button" class=" btn btn-sm btn-warning btn-edit">
										<i class="glyphicon glyphicon-pencil"></i>
									</button>
								</a>
							</div>
							<!-- .Update Button -->
							<!-- Delete Form -->
							<div class="col-xs-6"> 
								{!! Form::open(['action' => ["Admin\ExhibitionController@remove", $work->slug],  'method' => 'DELETE', 'name' => "deleteForm-" . $work->slug ]) !!}
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
	</div>
	<!-- .List All Artists -->
@endsection
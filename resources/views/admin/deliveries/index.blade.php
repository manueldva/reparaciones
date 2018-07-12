@extends('layouts.app')


@section('include_delete')
	@include('include.modal-delete')
@stop


@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Lista de Entregas</strong> 
					
					<form class="navbar-form navbar-right" role="search">
						
						{{ Form::model(Request::only('type', 'val'), array('route' => 'deliveries.index', 'method' => 'GET'), array('role' => 'form', 'class' => 'navbar-form pull-right')) }}
						<div class="form-group">
							{{ form::label('buscar', 'Tipo Busqueda:') }}
							{{ form::select('type', config('options.deliverytypes'), null, ['class' => 'form-control', 'id' => 'type'] ) }}
							{{ form::text('val', null, ['class' => 'form-control', 'id' => 'val']) }}
							
							<button type="submit" class="btn btn-sm btn-success"> Buscar</button>
							@if(Auth::user()->userType !== 'READONLY')
							<a href="{{ route('deliveries.create')}}" class="btn btn-sm btn-primary">
								 Crear
							</a>	
							@endif
						</div>
						
						{{ Form::close() }}
					</form>
				<br>
				<br>	
					
				</div>

				<div class="panel-body">

					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>
									<!--<th width="10px"> ID</th>-->
									<th> Codigo</th>
									<th> Cliente</th>
									<th> Equipo</th>
									<th> F. Entrega</th>
									<th colspan="3">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($deliveries as $delivery)
									<tr>
										<td>{{ $delivery->id }}</td>
										<td>{{ $delivery->reception->client->name }}</td>
										<td>{{ $delivery->reception->equipment->description }}</td>
										<td>{{ $delivery->deliverDate }}</td>
										<td width="10px">
											<a href="{{ route('deliveries.show', $delivery->id) }}" class="btn btn-sm btn-default">
												Ver
											</a>
										</td>
									
										<td width="10px">
											@if(Auth::user()->userType !== 'READONLY')
												@if($delivery->status == 'NOTPRINTED')
													<a href="{{ route('deliveries.edit', $delivery->id) }}" class="btn btn-sm btn-default">
														Editar
													</a>
												@endif
											@endif
										</td>
										<td width="10px">
											@if(Auth::user()->userType !== 'READONLY')
												@if($delivery->status == 'NOTPRINTED')
													{!! Form::model($delivery, ['method' => 'delete', 'route' => ['deliveries.destroy', $delivery->id], 'class' =>'form-inline form-delete']) !!}
													{!! Form::hidden('id', $delivery->id) !!}
													{!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger delete', 'name' => 'delete_modal']) !!}
													{!! Form::close() !!}
												@endif
											@endif
										</td>

									</tr>
								@endforeach
							</tbody>
						</table>
					</div>	
					{{ $deliveries->appends(Request::only(['type', 'val']))->render() }}
				</div>

			</div>
		</div>
	</div>
</div>

@endsection


@section('scripts')

	
	<script src="{{ asset('js/resources/confirm-delete-general.js') }}"></script>

	<script type="text/javascript">

		
		function searchType(){ 
		   var type = $('#type').val();
			if (type == 'date'){
				$('#val').attr('type','date');
				$('#val').focus();
			} else if (type == 'id')
			{
				$('#val').attr('type','number');
				$('#val').focus();
			} else
			{
				$('#val').attr('type','text');
				$('#val').focus();
			}
		}

		searchType(); 
		

		$('#type').change(function(e) {
			searchType(); 
			$('#val').val('');
			$('#val').focus();
		});

		/*function searchType(){ 
		   var type = $('#type').val();
			if (type == 'date'){
				$('#val').attr('type','date');
				$('#val').val('');
				$('#val').focus();
			} else if (type == 'id')
			{
				$('#val').attr('type','number');
				$('#val').val('');
				$('#val').focus();
			} else
			{
				$('#val').attr('type','text');
				$('#val').val('');
				$('#val').focus();
			}
		}

		searchType(); 
		

		$('#type').change(function(e) {
			searchType(); 
		});*/

		$('div.alert').not('.alert-important').delay(3000).fadeOut(350) 
	</script>
@endsection
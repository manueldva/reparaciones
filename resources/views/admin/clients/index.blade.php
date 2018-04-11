@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Lista de Clientes</strong> 
					<form class="navbar-form navbar-right" role="search">
					
						{{ Form::model(Request::only('type', 'val'), array('route' => 'clients.index', 'method' => 'GET'), array('role' => 'form', 'class' => 'navbar-form pull-right')) }}
						<div class="form-group">
							{{ form::label('buscar', 'Tipo Busqueda:') }}
							{{ form::select('type', config('options.clienttypes'), null, ['class' => 'form-control', 'id' => 'type'] ) }}
							{{ form::text('val', null, ['class' => 'form-control', 'id' => 'val']) }}
							
							<button type="submit" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-search"></span> Buscar</button>
							@if(Auth::user()->userType !== 'READONLY')
							<a href="{{ route('clients.create')}}" class="btn btn-sm btn-primary">
								<span class="glyphicon glyphicon-plus"></span> Crear
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
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<!--<th width="10px"> ID</th>-->
									<th> Nombre</th>
									<th> Dirección</th>
									<th> Nro Celular</th>
									<th colspan="3">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($clients as $client)
									<tr>
										<!--<td>{{ $client->id }}</td>-->
										<td>{{ $client->name }}</td>
										<td>{{ $client->address }}</td>
										<td>{{ $client->cellPhone }}</td>
										<td width="10px">
											<a href="{{ route('clients.show', $client->id) }}" class="btn btn-sm btn-default">
												Ver
											</a>
										</td>
										@if(Auth::user()->userType !== 'READONLY')
										<td width="10px">
											<a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-default">
												Editar
											</a>
										</td>
										<td width="10px">
											{{ Form::open(['route' => ['clients.destroy', $client->id], 'method' => 'DELETE']) }}
												{!! Form::open(['route' => ['clients.destroy', $client->id], 'method' => 'DELETE']) !!}
	                                        	<button class="btn btn-sm btn-danger">
	                                            	Eliminar
	                                        	</button>                           
	                                    	{!! Form::close() !!}
										</td>
										@endif
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>	
					{{ $clients->appends(Request::only(['type', 'val']))->render() }}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection


@section('scripts')
	<script type="text/javascript">

		$('#type').change(function(e) {

			$('#val').val('');
			$('#val').focus();
	
		});
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350) 
	</script>
@endsection
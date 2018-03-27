@extends('layouts.app')

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
						{{ form::select('type', config('options.types'), null, ['class' => 'form-control', 'id' => 'type'] ) }}
						{{ form::text('val', null, ['class' => 'form-control', 'id' => 'val']) }}
						
						<button type="submit" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-search"></span> Buscar</button>
						<a href="{{ route('deliveries.create')}}" class="btn btn-sm btn-primary">
							<span class="glyphicon glyphicon-plus"></span> Crear
						</a>	
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
											<a href="{{ route('deliveries.edit', $delivery->id) }}" class="btn btn-sm btn-default">
												Editar
											</a>
										</td>
										<td width="10px">
											{{ Form::open(['route' => ['deliveries.destroy', $delivery->id], 'method' => 'DELETE']) }}
												{!! Form::open(['route' => ['deliveries.destroy', $delivery->id], 'method' => 'DELETE']) !!}
	                                        	<button class="btn btn-sm btn-danger">
	                                            	Eliminar
	                                        	</button>                           
	                                    	{!! Form::close() !!}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>	
					{{ $deliveries->render() }}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection


@section('scripts')
	<script type="text/javascript">
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350) 
	</script>
@endsection
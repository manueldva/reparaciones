@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Lista de Recepciones</strong> 
					<a href="{{ route('receptions.create')}}" class="btn btn-sm btn-primary pull-right">
						Crear
					</a>
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
									<th> Motivo</th>
									<th colspan="3">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($receptions as $reception)
									<tr>
										<td>{{ $reception->id }}</td>
										<td>{{ $reception->client->name }}</td>
										<td>{{ $reception->equipment->description }}</td>
										<td>{{ $reception->reason->description }}</td>
										<td width="10px">
											<a href="{{ route('receptions.show', $reception->id) }}" class="btn btn-sm btn-default">
												Ver
											</a>
										</td>
										<td width="10px">
											<a href="{{ route('receptions.edit', $reception->id) }}" class="btn btn-sm btn-default">
												Editar
											</a>
										</td>
										<td width="10px">
											{{ Form::open(['route' => ['receptions.destroy', $reception->id], 'method' => 'DELETE']) }}
												{!! Form::open(['route' => ['receptions.destroy', $reception->id], 'method' => 'DELETE']) !!}
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
					{{ $receptions->render() }}
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
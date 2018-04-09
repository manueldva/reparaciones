@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Lista de Equipos</strong> 
					@if(Auth::user()->userType !== 'READONLY')
					<a href="{{ route('equipments.create')}}" class="btn btn-sm btn-primary pull-right">
						Crear
					</a>
					@endif
				</div>
		

				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<!--<th width="10px"> ID</th>-->
									<th> ID</th>
									<th> Descripciòn</th>
									<th colspan="3">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($equipments as $equipment)
									<tr>
										<td>{{ $equipment->id }}</td>
										<td>{{ $equipment->description }}</td>
										<td width="10px">
											<a href="{{ route('equipments.show', $equipment->id) }}" class="btn btn-sm btn-default">
												Ver
											</a>
										</td>
										@if(Auth::user()->userType !== 'READONLY')
										<td width="10px">
											<a href="{{ route('equipments.edit', $equipment->id) }}" class="btn btn-sm btn-default">
												Editar
											</a>
										</td>
										<td width="10px">
											{{ Form::open(['route' => ['equipments.destroy', $equipment->id], 'method' => 'DELETE']) }}
												{!! Form::open(['route' => ['equipments.destroy', $equipment->id], 'method' => 'DELETE']) !!}
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
					{{ $equipments->render() }}
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
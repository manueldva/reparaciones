@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Lista de Recepciones</strong> 
					<form class="navbar-form navbar-right" role="search">
					
						{{ Form::model(Request::only('type', 'val'), array('route' => 'receptions.index', 'method' => 'GET'), array('role' => 'form', 'class' => 'navbar-form pull-right')) }}
						<div class="form-group">
							{{ form::label('buscar', 'Tipo Busqueda:') }}
							{{ form::select('type', config('options.receptiontypes'), null, ['class' => 'form-control', 'id' => 'type'] ) }}
							{{ form::text('val', null, ['class' => 'form-control', 'id' => 'val']) }}
							
							<button type="submit" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-search"></span> Buscar</button>
							@if(Auth::user()->userType !== 'READONLY')
							<a href="{{ route('receptions.create')}}" class="btn btn-sm btn-primary">
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
									<th> Codigo</th>
									<th> Cliente</th>
									<th> Equipo</th>
									<th> Motivo</th>
									<th> Estado</th>
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
										<td> <font color="{{trans("color.$reception->status") }}">{{trans("resource.$reception->status") }}</font></td>
										<td width="10px">
											<a href="{{ route('receptions.show', $reception->id) }}" class="btn btn-sm btn-default">
												Ver
											</a>
										</td>
										@if(Auth::user()->userType !== 'READONLY')
											@if($reception->status !== 'REPAIRING')
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
											@else
												<td width="10px">
													
												</td>
												<td width="10px">
													
												</td>
											@endif
										@endif
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					{{ $receptions->appends(Request::only(['type', 'val']))->render() }}
					
				</div>
			</div>
		</div>
	</div>
</div>

@endsection


@section('scripts')
	<script type="text/javascript">

		function searchType(){ 
		    var type = $('#type').val();
			if (type == 'id')
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
		});


	$('div.alert').not('.alert-important').delay(3000).fadeOut(350) 
	</script>
@endsection
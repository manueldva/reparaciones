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
					<strong>Lista de Usuarios</strong> 
					<a href="{{ route('manageusers.create')}}" class="btn btn-sm btn-primary pull-right">
						Crear
					</a>
				</div>
		

				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>
									<th width="10px"> ID</th>
									<th> Nombre</th>
									<th> Usuario</th>
									<th> Tipo Usuario</th>
									<th colspan="3">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($users as $user)
									<tr>
										<td>{{ $user->id }}</td>
										<td>{{ $user->name }}</td>
										<td>{{ $user->username }}</td>
										<td>{{ trans("resource.$user->userType") }}</td>
										<td width="10px">
											<a href="{{ route('manageusers.show', $user->id) }}" class="btn btn-sm btn-default">
												Ver
											</a>
										</td>
										<td width="10px">
											<a href="{{ route('manageusers.edit', $user->id) }}" class="btn btn-sm btn-default">
												Editar
											</a>
										</td>
										<td width="10px">
											{!! Form::model($user, ['method' => 'delete', 'route' => ['manageusers.destroy', $user->id], 'class' =>'form-inline form-delete']) !!}
											{!! Form::hidden('id', $user->id) !!}
											{!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger delete', 'name' => 'delete_modal']) !!}
											{!! Form::close() !!}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>	
					{{ $users->render() }}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection


@section('scripts')

	<script src="{{ asset('js/resources/confirm-delete-general.js') }}"></script>
	
	<script type="text/javascript">
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350) 
	</script>
@endsection
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
					<strong>Lista de Razones</strong> 
					@if(Auth::user()->userType !== 'READONLY')
					<a href="{{ route('reasons.create')}}" class="btn btn-sm btn-primary pull-right">
						Crear
					</a>
					@endif
				</div>
		

				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-hover" data-form="Form">
							<thead>
								<tr>
									<!--<th width="10px"> ID</th>-->
									<th> ID</th>
									<th> Descripciòn</th>
									<th colspan="3">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($reasons as $reason)
									<tr>
										<td>{{ $reason->id }}</td>
										<td>{{ $reason->description }}</td>
										<td width="10px">
											<a href="{{ route('reasons.show', $reason->id) }}" class="btn btn-sm btn-default">
												Ver
											</a>
										</td>
										@if(Auth::user()->userType !== 'READONLY')
										<td width="10px">
											<a href="{{ route('reasons.edit', $reason->id) }}" class="btn btn-sm btn-default">
												Editar
											</a>
										</td>
										<td width="10px">
											{!! Form::model($reason, ['method' => 'delete', 'route' => ['reasons.destroy', $reason->id], 'class' =>'form-inline form-delete']) !!}
											{!! Form::hidden('id', $reason->id) !!}
											{!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger delete', 'name' => 'delete_modal']) !!}
											{!! Form::close() !!}
										</td>
										@endif
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>	
					{{ $reasons->render() }}
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
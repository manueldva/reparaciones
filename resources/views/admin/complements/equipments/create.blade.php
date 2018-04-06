@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Crear Equipo</strong>
				</div>
		
				<div class="panel-body">
					{!! Form::open(['route' => 'equipments.store']) !!}

						@include('admin.complements.equipments.partials.form')

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
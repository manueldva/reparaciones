@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Crear Cliente</strong>
				</div>
		
				<div class="panel-body">
					{!! Form::open(['route' => 'clients.store']) !!}

						@include('admin.clients.partials.form')

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
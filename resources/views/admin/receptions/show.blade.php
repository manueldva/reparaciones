@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Ver Recepción</strong>	
				</div>
		
				<div class="panel-body">
					<p> <strong>Codigo:</strong> {{ $reception->id }}</p>

					<p> <strong>Cliente:</strong> {{ $reception->client->name }}</p>

					<p> <strong>Equipo:</strong> {{ $reception->equipment }}</p>

					<p> <strong>Concepto:</strong> {{ $reception->concept }}</p>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Ver </strong>
					
					<a  href="{{ route('print', $delivery->id) }}" class="btn btn-sm btn-default pull-right" target="_blank">
						Imprimir Detalle
					</a>
					<a  href="{{ route('printvoucherdelivery', $delivery->id) }}" class="btn btn-sm btn-default pull-right" target="_blank">
						
						Imprimir Comprobante
					</a>
					
				</div>
		
				<div class="panel-body">
					<p> <strong>Codigo:</strong> {{ $delivery->id }}</p>

					<p> <strong>Cliente:</strong> {{ $delivery->reception->client->name }}</p>

					<p> <strong>Equipo:</strong> {{ $delivery->reception->equipment->description }}</p>
					
					<p> <strong>Trabajo Hecho:</strong> {{ $delivery->workDone }}</p>

					<p> <strong>Precio Trabajo:</strong> {{ $delivery->workPrice }}</p>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

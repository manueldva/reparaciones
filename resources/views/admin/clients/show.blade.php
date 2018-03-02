@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Ver Cliente</strong>	
				</div>
		
				<div class="panel-body">
					<p> <strong>Nombre:</strong> {{ $client->name }}</p>

					<p> <strong>Dirección:</strong> {{ $client->address }}</p>

					<p> <strong>Nro Celular:</strong> {{ $client->cellPhone }}</p>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

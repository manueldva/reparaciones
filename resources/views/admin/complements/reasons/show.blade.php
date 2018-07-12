@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Ver Razon</strong>	
					<a  href="{{ route('reasons.index') }}" class="btn btn-sm btn-default pull-right">
						Listado
					</a>
				</div>
		
				<div class="panel-body">
					<p> <strong>ID:</strong> {{ $reason->id }}</p>

					<p> <strong>Descripciòn:</strong> {{ $reason->description }}</p>

				</div>
			</div>
		</div>
	</div>
</div>

@endsection

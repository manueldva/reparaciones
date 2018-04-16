@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/resources/select2.css') }}">
@endsection

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Crear Recepción</strong>
				</div>
		
				<div class="panel-body">
					{!! Form::open(['route' => 'receptions.store', 'files' => true]) !!}

						@include('admin.receptions.partials.form')

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection


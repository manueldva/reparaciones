@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong> Editar Equipo </strong>
				</div>
		
				<div class="panel-body">

					{!! Form::model($equipment, ['route' => ['equipments.update', $equipment->id], 'method' => 'PUT']) !!}
                        
                        @include('admin.complements.equipments.partials.form')

                    {!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
</div>

@endsection
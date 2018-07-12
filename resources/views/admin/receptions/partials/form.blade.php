
<div class="form-group">
	{{ form::label('client_id', 'Cliente:') }}
	@if(isset($reception))
		{{ form::text('clientname', $reception->client->name, ['class' => 'form-control', 'disabled']) }}
	@else

		{{ form::select('client_id', $clients, null, ['class' => 'form-control', 'placeholder' => 'Seleccionar...', 'id' => 'client_id' ] ) }}
	@endif
</div>

<div class="form-group">
	{{ form::label('equipment_id', 'Equipo:') }}
	{{ form::select('equipment_id', $equipments, null, ['class' => 'form-control','placeholder' => 'Seleccionar...'] ) }}
</div>

<div class="form-group">
	{{ form::label('description', 'Descripcion:') }}
	{{ form::textarea('description', null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
    {{ Form::label('image', 'Imagen (Opcional):') }}
    {{ Form::file('image') }}
</div>

<div class="form-group">
	{{ form::label('reason_id', 'Razon:') }}
	{{ form::select('reason_id', $reasons, null, ['class' => 'form-control','placeholder' => 'Seleccionar...'] ) }}
</div>

<div class="form-group">
	{{ form::label('concept', 'Concepto:') }}
	{{ form::textarea('concept', null, ['class' => 'form-control']) }}
</div>

@if (isset($reception))
	@if($reception->status !== 'REPAIRING')
		<div class="form-group">
			{{ form::label('status', 'Estado:') }}
			<label>
				{{ Form::radio('status','WAITING')}} En Espera
			</label>
			<label>
				{{ Form::radio('status','RECEIVED')}} Recibido
			</label>
		</div>
	@endif
@else
	<div class="form-group">
		{{ form::label('status', 'Estado:') }}
		<label>
			{{ Form::radio('status','WAITING')}} En Espera
		</label>
		<label>
			{{ Form::radio('status','RECEIVED')}} Recibido
		</label>
	</div>
@endif


<div class="form-group">
	<button type="submit" class="btn btn-sm btn-primary"> Guardar</button>
</div>

@section('js')
<script src="{{ asset('js/resources/select2.js') }}"></script>
@endsection

@section('scripts')
	<script type="text/javascript">

		$('div.alert').not('.alert-important').delay(3000).fadeOut(350) 

		
		$('#client_id').select2();
		$('#equipment_id').select2();
		$('#reason_id').select2();
		

	</script>
@endsection
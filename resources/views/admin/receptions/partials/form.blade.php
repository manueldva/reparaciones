<div class="form-group">
	{{ form::label('client_id', 'Cliente:') }}
	{{ form::select('client_id', $clients, null, ['class' => 'form-control'] ) }}
</div>

<div class="form-group">
	{{ form::label('equipment_id', 'Equipo:') }}
	{{ form::select('equipment_id', $equipment, null, ['class' => 'form-control'] ) }}
</div>

<div class="form-group">
	{{ form::label('description', 'Descripcion') }}
	{{ form::textarea('description', null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
    {{ Form::label('image', 'Imagen') }}
    {{ Form::file('image') }}
</div>

<div class="form-group">
	{{ form::label('reason_id', 'Razon:') }}
	{{ form::select('reason_id', $reasons, null, ['class' => 'form-control'] ) }}
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
	<button type="submit" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
</div>


@section('scripts')
	<script type="text/javascript">
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350) 
	</script>
@endsection
<div class="form-group">
	{{ form::label('reception_id', 'Codigo Recepción:') }}
	{{ form::select('reception_id', $receptions, null, ['class' => 'form-control'] ) }}
</div>

<div class="form-group">
	{{ form::label('deliverDate', 'Fecha Entrega:') }}
	{{ form::date('deliverDate', null, ['class' => 'form-control', 'id' => 'deliverDate']) }}
</div>
<div class="form-group">
	{{ form::label('workDone', 'Trabajo Hecho:') }}
	{{ form::textarea('workDone', null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
	{{ form::label('workPrice', 'Precio del Trabajo:') }}
	{{ form::number('workPrice', null, ['class' => 'form-control', 'id' => 'workPrice', 'step' => '0.01']) }}
</div>

<div class="form-group">
	{{ form::submit('Guardar',['class' => 'btn btn-sm btn-primary']) }}
</div>


@section('scripts')
	<script type="text/javascript">
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350) 
	</script>
@endsection
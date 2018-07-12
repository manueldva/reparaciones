<div class="form-group">
	{{ form::label('name', 'Nombre/Razon social del cliente:') }}
	{{ form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
</div>
<div class="form-group">
	{{ form::label('address', 'Dirección:') }}
	{{ form::text('address', null, ['class' => 'form-control', 'id' => 'address']) }}
</div>
<div class="form-group">
	{{ form::label('cellPhone', 'Nro Celular:') }}
	{{ form::number('cellPhone', null, ['class' => 'form-control', 'id' => 'cellPhone']) }}
</div>
<div class="form-group">
	{{ form::label('phone', 'Nro Telefono (opcional):') }}
	{{ form::number('phone', null, ['class' => 'form-control', 'id' => 'phone']) }}
</div>
<div class="form-group">
	{{ form::label('email', 'Correo Electronico (opcional):') }}
	{{ form::email('email', null, ['class' => 'form-control', 'id' => 'email']) }}
</div>
<div class="form-group">
	<button type="submit" class="btn btn-sm btn-primary"></span> Guardar</button>
</div>



@section('scripts')
	<script type="text/javascript">
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350) 
	</script>
@endsection
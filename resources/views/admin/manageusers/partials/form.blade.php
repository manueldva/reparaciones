<div class="form-group">
	{{ form::label('name', 'Nombre:') }}
	{{ form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
</div>

<div class="form-group">
	{{ form::label('username', 'Usuario:') }}
	{{ form::text('username', null, ['class' => 'form-control', 'id' => 'username']) }}
</div>

<div class="form-group">
	{{ form::label('email', 'Email:') }}
	{{ form::email('email', null, ['class' => 'form-control', 'id' => 'email']) }}
</div>

<div class="form-group">
    {{ Form::label('image', 'Imagen') }}
    {{ Form::file('image') }}
</div>


<div class="form-group">
	{{ form::label('status', 'Estado:') }}
	<label>
		{{ Form::radio('status','ADMINISTRATOR')}} Administrador
	</label>
	<label>
		{{ Form::radio('status','MANAGMENT')}} Gestiòn
	</label>
	<label>
		{{ Form::radio('status','READONLY')}} Solo Lectura
	</label>
</div>



<div class="form-group">
	<button type="submit" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
</div>


@section('scripts')
	<script type="text/javascript">
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350) 
	</script>
@endsection
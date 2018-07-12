<div class="form-group">
	{{ form::label('description', 'Descripciòn:') }}
	{{ form::text('description', null, ['class' => 'form-control', 'id' => 'description']) }}
</div>
<div class="form-group">
	<button type="submit" class="btn btn-sm btn-primary"> Guardar</button>
</div>



@section('scripts')
	<script type="text/javascript">
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350) 
	</script>
@endsection
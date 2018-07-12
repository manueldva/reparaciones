@extends('layouts.report')

@section('customstyle')

<style>
table {
    width: 20%;
	height: 100px;
}
</style>
<!-- END PAGE LEVEL STYLES -->
@stop
<?php
/*highlight_string(var_export($cajachicas, true));
exit();*/
?>
@section('cuerpo')
  <h3></h3>
  
  <table class="collapse"> <!--width="600"-->
    <thead>
      <tr>
        <td>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <center> 
         <!--Alta Complejidad <br>-->
         @if($empresa->file)
              <img src="{{ $empresa->file }}" height="70" width="120" ><br>
         @elseif(isset($empresa->nombre))
          <strong>Empresa<br>
          "{{$empresa->nombre}}" <br>
         @else
            <strong>Empresa<br>
            "Nombre Empresa"<br>
         @endif
         @if(isset($empresa->direccion))
          </strong> {{$empresa->direccion}}<br>
         @else
          </strong> S/D<br>
         @endif 
         - <br>
        <!-- <strong>I.V.A. EXENTO</strong>-->
       </center></td>

        <td><center><font size=10>X</font><br></center></td>

        <td><center>&nbsp;&nbsp;&nbsp;</center></td>

        <td><strong>N° 0001 - {{$delivery->id}}<br>
        FECHA: {{$delivery->deliverDate}}<br>
        CUIT. N°:  {{ isset($empresa->cuit) ? $empresa->cuit : "-"}} <br>
        ING. BRUTOS:  {{ isset($empresa->ingresosbrutos) ? $empresa->ingresosbrutos :  "-" }} <br>
        INICIO DE ACTIVIDADES:{{ isset($empresa->inicioactividades) ? $empresa->inicioactividades :  "-" }} </strong></td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="4">Señor/es: <strong>{{ $delivery->reception->client->name }} </strong></td>
      </tr>
      <tr>
        <td colspan="4">Domicilio: <strong>{{ $delivery->reception->client->address }}</strong></td>
      </tr>
      <tr>
      	<td colspan="4">
	        <table class="collapse">
			    <thead>
			      <tr>
			        <td><strong>I.V.A.</strong></td>

			        <td><label>Exento<input type="checkbox" name="exento" id="exento"></label></td>

			        <td><label>No Resp.<input type="checkbox" name="noresp" id="noresp"></label></td>

			        <td><label>C. Final<input type="checkbox" name="cfinal" id="cfinal"></label></td>

			        <td><label>Resp. Insc.<input type="checkbox" name="respinsc" id="respinsc"></label></td>

			        <td><label>Monotributo<input type="checkbox" name="monotributo" id="monotributo"></label></td>

			        <td><strong>CUIT N°:</strong>........................</td>

			      </tr>
			    </thead>
			</table>
		</td>
      </tr>
      <tr>
        <td colspan="4">Recibi (mos) la suma de pesos: <strong> {{ $delivery->workPrice }} </strong></td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">en Concepto de: <strong>{{ $delivery->reception->reason->description }} - {{ $delivery->reception->equipment->description }} </strong></td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">Efectivo:  </strong></td>
      </tr>
      <tr>
        <td colspan="4">Tarjeta de Crédito: <strong>  </strong></td>
      </tr>

      <tr>
      	<td colspan="2">
	        <table class="collapse">
			    <thead>
			      <tr>
			        <td><H3><strong> FACTURA </strong></H3><br>
			        <table class="collapse">
                <thead>
                  <tr>
                    <td>
                      <strong>TOTAL</strong>
                    </td>
                    <td>
                      <input type="text" name="total" id="total" value="$ {{ $delivery->workPrice }}"><br>
                    </td>
                  </tr>
                </thead>
              </table>
			        </td>
			      </tr>
			    </thead>
			</table>
		</td>
      	<td colspan="2">
	        <table class="collapse">
			    <thead>
			      <tr>
			        <td><H3><strong>FIRMA:</strong></H3><br>
			        <H3><strong>ACLARACION:</strong></H3>
			      	</td>
			      </tr>
			    </thead>
			</table>
		</td>
      </tr>
    </tbody>   
  </table>
@stop

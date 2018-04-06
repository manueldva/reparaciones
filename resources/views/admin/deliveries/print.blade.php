@extends('layouts.report')

@section('customstyle')
<!-- BEGIN PAGE LEVEL STYLES -->

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
      
    <tbody>
      <tr>
        <td colspan="4">Codigo Recepción: <strong>{{ $delivery['0']['reception']['id'] }}</strong></td>
      </tr>
      <tr>
        <td colspan="4">Señor/es: <strong> {{ $delivery['0']['reception']['client']['name'] }} </strong></td>
      </tr>
      <tr>
        <td colspan="4">Domicilio: <strong>{{ $delivery['0']['reception']['client']['address'] }}</strong></td>
      </tr>
      <tr>
        <td colspan="4">Celular: <strong>{{ $delivery['0']['reception']['client']['cellPhone'] }}</strong></td>
      </tr>
      <tr>
        <td colspan="4">Equipo: <strong>{{ $delivery['0']['reception']['equipment']['description'] }}</strong></td>
      </tr>

      <tr>
        <td colspan="4">Caracteristicas: <strong>{{ $delivery['0']['reception']['description'] }} </strong></td>
      </tr>
      <tr>
        <td colspan="4">Tipo Trabajo: <strong>{{ $delivery['0']['reception']['reason']['description'] }} </strong></td>
      </tr>
      <tr>
        <td colspan="4">Solicitud Cliente: <strong>{{ $delivery['0']['reception']['concept'] }} </strong></td>
      </tr>
      
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">Codigo Reparación: <strong>{{ $delivery['0']['id'] }} </strong></td>
      </tr>
      <tr>
        <td colspan="4">Trabajo Realizado: <strong>{{ $delivery['0']['workDone'] }} </strong></td>
      </tr>
      <tr>
        <td colspan="4">Fecha Entrega: <strong>{{ $delivery['0']['deliverDate'] }} </strong></td>
      </tr>
      <tr>
        <td colspan="4">Precio del Trabajo: <strong> $ {{ $delivery['0']['workPrice'] }} </strong></td>
      </tr>
      

    </tbody>   
  </table>
@stop

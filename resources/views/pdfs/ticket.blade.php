<!DOCTYPE html>
<html>
<head>
	<title>Ticket #{{$engagement->id}}</title>
	<style>
	body{
		max-width: 240px;
	}
	 table{
		 width: 100%;
	 }
	 .text-right{
		 text-align: right;
	 }
	 .text-center{
		 text-align: center;
	 }
	</style>
</head>
<body>
     <img src="{{ asset('images/logo.png') }}" alt="">
     <table>
	 <tbody>
	 <tr>
	  <td>Ticket:</td>
	  <td class="text-right">#{{$engagement->id}}</td>
	 </tr>
	 <tr>
	  <td>Fecha:</td>
	  <td class="text-right">{{date('d/m/Y', strtotime($engagement->reservation))}}</td>
	 </tr>
	 <tr>
	  <td>Terminal:</td>
	  <td class="text-right">#Pendiente#</td>
	 </tr>
	 <tr>
	  <td>Asesor:</td>
	  <td class="text-right">{{$engagement->adviser->name}}</td>
	 </tr>
	 </tbody>
	 </table>
	 <br>
	 <table>
	 <tbody>
	 <tr>
	  <td class="text-center">Servicio</td>
	  <td class="text-center">Cantidad</td>
	  <td class="text-right">Costo</td>
	 </tr>
	 <tr>
	 <td class="text-center" colspan="3">------------------------------------------------</td>
	 </tr>
	 <tr>
	  <td class="text-center">{{$engagement->service->name}}</td>
	  <td class="text-center">X1</td>
	  <td class="text-right">${{number_format($engagement->service->price)}}</td>
	 </tr>
	 <tr>
	 <td class="text-center" colspan="3">------------------------------------------------</td>
	 </tr>
	 <tr>
	  <td colspan="3">Cantidad de artículos:    1</td>
	 </tr>
	 <tr>
	 </tbody>
	 </table>
	 <table>
	 <tbody>
	 <tr>
	  <td><b>Ticket</b></td>
	  <td class="text-right">${{number_format($engagement->service->price)}}</td>
	 </tr>
	 <tr>
	  <td colspan="2"><b>{{$engagement->payment_method}}</b></td>
	 </tr>
	 <tr>
	  <td>Se recibe:</td>
	  <td class="text-right">${{number_format($pay,2)}}</td>
	 </tr>
	 <tr>
	  <td>Cambio:</td>
	  <td class="text-right">${{number_format($pay - $engagement->service->price, 2)}}</td>
	 </tr>
	 <tr>
	  <td class="text-center" colspan="2">
	  <b>Cejas HD</b>
	  </td>
	 </tr>
	 <tr>
	  <td class="text-center" colspan="2">
	  <b></b>
	  </td>
	 </tr>
	 <tr>
	  <td class="text-center" colspan="2">
	  <b>¡Gracias!</b>
	  </td>
	 </tr>
	 <tr>
	 <td class="text-center" colspan="2">------------------------------------------------</td>
	 </tr>
	 <tr>
	 <td class="text-right" colspan="2">cejashd.miradspa</td>
	 </tr>
	 <tr>
	 <td class="text-right" colspan="2">Cejas HD Keratin System</td>
	 </tr>
	 <tr>
	 <td class="text-center" colspan="2"><b>sitioweb.com</b></td>
	 </tr>
	 </tbody>
	 </table>
</body>
</html>
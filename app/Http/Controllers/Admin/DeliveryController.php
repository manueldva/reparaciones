<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\FechaHelper;
use Barryvdh\DomPDF\Facade as PDF;
use Alert;

use App\Http\Requests\DeliveryStoreRequest;
use App\Http\Requests\DeliveryUpdateRequest;

use App\Delivery;
use App\Empresa;
use App\Reception;
use App\Client;
use App\reason;

class DeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $deliveries = Delivery::type($request->get('type'), $request->get('val'))->paginate(10);
        $deliveries->setPath('deliveries');

       //$deliveries = Delivery::orderBy('id', 'DESC')->paginate(2);




       foreach ($deliveries as $delivery) {
           $delivery->deliverDate = FechaHelper::getFechaImpresion($delivery->deliverDate); 
       }

       return view('admin.deliveries.index', compact('deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        /*$receptions =  array();*/

        //$receptions = Reception::where('status','RECEIVED')->orderBy('id', 'DESC')->get();
        
        //dd($receptionstemp);
        /*
        foreach ($receptionstemp as  $value) {
            $client = Client::find($value->client_id);
            $receptions = [ $value->id => $value->id .' - '. $client->name];
        }*/

        $temp = Reception::where('status','RECEIVED')->orderBy('id', 'DESC')->get();
        

        foreach ($temp as  $value) {
            $client = Client::find($value->client_id);
            $value->description =  $value->id .' - '. $client->name;
        }

        $receptions = $temp->pluck('description','id');
       




        //$receptions = Reception::where('status','RECEIVED')->orderBy('id', 'ASC')->pluck('id', 'id');
        return view('admin.deliveries.create', compact('receptions'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryStoreRequest $request)
    {
        $delivery = Delivery::create($request->all());

        $reception = Reception::find($request->get('reception_id'));
            $reception->status = 'REPAIRING';
        $reception->save();

        Alert::success('Entrega creada con exito')->persistent('Cerrar');
        return redirect()->route('deliveries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $delivery = Delivery::find($id);

        return view('admin.deliveries.show', compact('delivery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $delivery = Delivery::find($id);
        
        $delivery->deliverDate = FechaHelper::getFechaInputDate($delivery->deliverDate); 

        $receptions =  array();

        $receptionstemp = Reception::where('id', $delivery->reception_id)->get();

        foreach ($receptionstemp as  $value) {
            $client = Client::find($value->client_id);
            $receptions  = [ $value->id => $client->name];
        }

        //$receptions = Reception::where('id',$delivery->reception_id)->orderBy('id', 'ASC')->pluck('id', 'id');

        return view('admin.deliveries.edit', compact('delivery', 'receptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DeliveryUpdateRequest $request, $id)
    {
        $delivery = Delivery::find($id);

        $delivery->fill($request->all())->save();

        Alert::success('Entrega actualizada con exito')->persistent('Cerrar');
        return redirect()->route('deliveries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $delivery = Delivery::find($id);

        $reception = Reception::find($delivery->reception_id);
            $reception->status = 'RECEIVED';
        $reception->save();

        $delivery->delete();

        Alert::success('Eliminado correctamente')->persistent('Cerrar');
        return back();
    }


    public function print($id)
    {
        $delivery = Delivery::where('id', $id)->get();
        $delivery['0']['deliverDate'] = FechaHelper::getFechaImpresion($delivery['0']['deliverDate']); 

        /*highlight_string(var_export($delivery->reception->client, true));
        exit();*/

        $pdf = PDF::loadView('admin.deliveries.print', compact('delivery'));

        return $pdf->stream('reporte');

        //return $pdf->download('informe.pdf');

        //return $id;
    }


    public function printvoucherdelivery($id)
    {
        /*$delivery = Delivery::where('id', $id)->get();
        $delivery['0']['deliverDate'] = FechaHelper::getFechaImpresion($delivery['0']['deliverDate']);*/

        $empresa = Empresa::first();
        $empresa->inicioactividades = FechaHelper::getFechaImpresion($empresa->inicioactividades);

        $delivery = Delivery::find($id);

        $delivery->status = 'PRINTED';
        $delivery->save();

        $delivery->deliverDate = FechaHelper::getFechaImpresion($delivery->deliverDate);
        /*highlight_string(var_export($delivery->reception->client, true));
        exit();*/



        $pdf = PDF::loadView('admin.deliveries.printvoucher', compact('delivery', 'empresa'));


        return $pdf->stream('reporte');

        //return $pdf->download('informe.pdf');

        //return $id;
    }
}

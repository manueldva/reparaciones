<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\FechaHelper;
use Barryvdh\DomPDF\Facade as PDF;

use App\Http\Requests\DeliveryStoreRequest;
use App\Http\Requests\DeliveryUpdateRequest;

use App\Delivery;
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
    public function index()
    {
       $deliveries = Delivery::orderBy('id', 'DESC')->paginate();

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
        $receptions =  array();

        $receptionstemp = Reception::where('status','RECEIVED')->get();

        foreach ($receptionstemp as  $value) {
            $client = Client::find($value->client_id);
            $receptions  = [ $value->id => $value->id .' - '. $client->name];
        }

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

        return redirect()->route('deliveries.edit', $delivery->id)->with('info', 'Entrega creada con exito');
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

        return redirect()->route('deliveries.edit', $delivery->id)->with('info', 'Entrega actualizada con exito');
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

        return back()->with('info', 'Eliminado correctamente');
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
}

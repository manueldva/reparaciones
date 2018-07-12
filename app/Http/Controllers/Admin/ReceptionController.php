<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\ReceptionStoreRequest;
use App\Http\Requests\ReceptionUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Alert;

use App\Helpers\FechaHelper;
use Barryvdh\DomPDF\Facade as PDF;

use App\Delivery;
use App\Empresa;
use App\Reception;
use App\Client;
use App\Reason;
use App\Equipment;


class ReceptionController extends Controller
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
       //$receptions = Reception::orderBy('id', 'DESC')->paginate();

        $receptions = Reception::type($request->get('type'), $request->get('val'),$request->get('status'))->paginate(10);
        $receptions->setPath('receptions');

        //$status[] = ['WAITING' => 'En Espera', 'RECEIVED' => 'Recibido', 'REPAIRING' => 'Reparado'];
        //return $receptions;


       return view('admin.receptions.index', compact('receptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        
        $clients   = Client::orderBy('name', 'ASC')->pluck('name', 'id');

        //dd($clients);
        //$clients    = Client::orderBy('name', 'ASC')->pluck('name', 'id');
        $reasons    = Reason::orderBy('description', 'ASC')->pluck('description' , 'id');
        $equipments = Equipment::orderBy('description', 'ASC')->pluck('description' , 'id');

        return view('admin.receptions.create', compact('clients', 'reasons', 'equipments'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReceptionStoreRequest $request)
    {
        $reception = Reception::create($request->all());

        //IMAGE 
        if($request->file('image')){
            $path = Storage::disk('public')->put('image',  $request->file('image'));
            $reception->fill(['file' => asset($path)])->save();
        }

        Alert::success('Recepción creada con exito')->persistent('Cerrar');
        return redirect()->route('receptions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reception = Reception::find($id);

        return view('admin.receptions.show', compact('reception'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reception = Reception::find($id);

        $clients    = Client::orderBy('name', 'ASC')->pluck('name', 'id');
        $reasons    = Reason::orderBy('description', 'ASC')->pluck('description' , 'id');
        $equipments = Equipment::orderBy('description', 'ASC')->pluck('description' , 'id');

        return view('admin.receptions.edit', compact('reception', 'clients', 'reasons', 'equipments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReceptionUpdateRequest $request, $id)
    {
        $reception = Reception::find($id);

        $reception->fill($request->all())->save();

        //IMAGE 
        if($request->file('image')){
            $path = Storage::disk('public')->put('image',  $request->file('image'));
            $reception->fill(['file' => asset($path)])->save();
        }

        Alert::success('Recepción actualizada con exito')->persistent('Cerrar');
        return redirect()->route('receptions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        if(Delivery::where('reception_id', $id)->first()) 
        {
            Alert::error('No se puede eliminar el registro')->persistent('Cerrar');
            return back();
        }

        Reception::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent('Cerrar');
        return back();
    }


    public function printvoucherreception($id)
    {
        /*$delivery = Delivery::where('id', $id)->get();
        $delivery['0']['deliverDate'] = FechaHelper::getFechaImpresion($delivery['0']['deliverDate']);*/

        $empresa = Empresa::first();
        $empresa->inicioactividades = FechaHelper::getFechaImpresion($empresa->inicioactividades);

        $reception = Reception::find($id);
        $reception->description = FechaHelper::getFechaImpresion( now());
        
        //dd($reception);
        
        
        $pdf = PDF::loadView('admin.receptions.printvoucher', compact('reception', 'empresa'));

        return $pdf->stream('reporte');

        //return $pdf->download('informe.pdf');

        //return $id;
    }

}

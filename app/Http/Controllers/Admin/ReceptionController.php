<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\ReceptionStoreRequest;
use App\Http\Requests\ReceptionUpdateRequest;
use Illuminate\Support\Facades\Storage;

use App\Delivery;
use App\Reception;
use App\Client;
use App\reason;
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
    public function index()
    {
       $receptions = Reception::orderBy('id', 'DESC')->paginate();

       return view('admin.receptions.index', compact('receptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $clients    = Client::orderBy('name', 'ASC')->pluck('name', 'id');
        $reasons    = Reason::orderBy('description', 'ASC')->pluck('description' , 'id');
        $equipment = Equipment::orderBy('description', 'ASC')->pluck('description' , 'id');

        return view('admin.receptions.create', compact('clients', 'reasons', 'equipment'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReceptionStoreRequest $request)
    {
        $receptions = Reception::create($request->all());

        //IMAGE 
        if($request->file('image')){
            $path = Storage::disk('public')->put('image',  $request->file('image'));
            $receptions->fill(['file' => asset($path)])->save();
        }


        return redirect()->route('receptions.edit', $receptions->id)->with('info', 'Recepción creada con exito');
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
        $equipment = Equipment::orderBy('description', 'ASC')->pluck('description' , 'id');

        return view('admin.receptions.edit', compact('reception', 'clients', 'reasons', 'equipment'));
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

        return redirect()->route('receptions.edit', $reception->id)->with('info', 'Recepción actualizada con exito');
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
            return back()->with('danger', 'No se puede eliminar el registro');
        }

        Reception::find($id)->delete();

        return back()->with('info', 'Eliminado correctamente');
    }
}

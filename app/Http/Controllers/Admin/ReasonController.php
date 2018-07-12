<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\ReasonStoreRequest;
use App\Http\Requests\ReasonUpdateRequest;
use Alert;

use App\Reason;
use App\Reception;

class ReasonController extends Controller
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
       $reasons = Reason::orderBy('id', 'DESC')->paginate();

       return view('admin.complements.reasons.index', compact('reasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.complements.reasons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReasonStoreRequest $request)
    {
        $reason = Reason::create($request->all());


        Alert::success('Razon creada con exito')->persistent('Cerrar');
        return redirect()->route('reasons.index');

        //return redirect()->route('reasons.edit', $reason->id)->with('info', 'Razon creada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reason = Reason::find($id);

        return view('admin.complements.reasons.show', compact('reason'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reason = Reason::find($id);

        return view('admin.complements.reasons.edit', compact('reason'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReasonUpdateRequest $request, $id)
    {
        $reason = Reason::find($id);

        $reason->fill($request->all())->save();

        //return redirect()->route('admin.complements.equipments.edit', $equipment->id)->with('info', 'Equipo actualizado con exito');
        Alert::success('Razon actualizada con exito')->persistent('Cerrar');
        return redirect()->route('reasons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        if(Reception::where('reason_id', $id)->first()) 
        {
            Alert::error('No se puede eliminar el registro')->persistent('Cerrar');
            return back();
        }

        Reason::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent('Cerrar');
        return back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\EquipmentStoreRequest;
use App\Http\Requests\EquipmentUpdateRequest;
use Alert;

use App\Equipment;
use App\Reception;

class EquipmentController extends Controller
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
       $equipments = Equipment::orderBy('id', 'DESC')->paginate();

       return view('admin.complements.equipments.index', compact('equipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.complements.equipments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipmentStoreRequest $request)
    {
        $equipment = Equipment::create($request->all());

        Alert::success('Equipo creado con exito')->persistent('Cerrar');
        return redirect()->route('equipments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipment = Equipment::find($id);

        return view('admin.complements.equipments.show', compact('equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipment = Equipment::find($id);

        return view('admin.complements.equipments.edit', compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EquipmentUpdateRequest $request, $id)
    {
        $equipment = Equipment::find($id);

        $equipment->fill($request->all())->save();

        //return redirect()->route('admin.complements.equipments.edit', $equipment->id)->with('info', 'Equipo actualizado con exito');
        Alert::success('Equipo actualizado con exito')->persistent('Cerrar');
        return redirect()->route('equipments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        if(Reception::where('equipment_id', $id)->first()) 
        {
            Alert::error('No se puede eliminar el registro')->persistent('Cerrar');
            return back();
        }

        Equipment::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent('Cerrar');
        return back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmpresaUpdateRequest;
use Illuminate\Support\Facades\Storage;
use App\Helpers\FechaHelper;
use Alert;

use App\Empresa;


class EmpresaController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresa = Empresa::find($id);
    
        $empresa->inicioactividades = FechaHelper::getFechaInputDate($empresa->inicioactividades);

        return view('admin.empresas.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmpresaUpdateRequest $request, $id)
    {
        $empresa = Empresa::find($id);

        $empresa->fill($request->all())->save();


         //IMAGE 
        if($request->file('image')){
            $path = Storage::disk('public')->put('image',  $request->file('image'));
            $empresa->fill(['file' => asset($path)])->save();
        }

        Alert::success('Empresa actualizada con exito')->persistent('Cerrar');
        return redirect()->route('empresas.edit', $empresa->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

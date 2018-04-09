<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Alert;
use Validator;

use App\User;

class ManageuserController extends Controller
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
       $users = User::orderBy('id', 'DESC')->paginate();

       foreach ($users as $user) {
           if ($user->status == 'ADMINISTRATOR') {
                $user->status = 'Administrador';
           }elseif ($user->status == 'READONLY') {
                $user->status = 'Solo Lectura';
           }else {
                $user->status = 'Gestiòn';
           }
       }

       return view('admin.manageusers.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manageusers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if ($request->input('name') == ''  || $request->input('username') == '' || $request->input('email') == '') 
        {
            //Alert::error('Faltas datos para dar de alta el Usuario');
            return back()->with('danger', 'Complete todos los datos del usuario')->withInput();
        }


        if (User::where('username', $request->input('username'))->first()) 
        {
            return back()->with('danger', 'Este username ya esta en uso')->withInput();
        }

        if (User::where('email', $request->input('email'))->first()) 
        {
            return back()->with('danger', 'Este email ya esta en uso')->withInput();
        }

        if($request->file('image')){

            $input  = array('image' => $request->file('image'));

            $rules = array('image' => 'mimes:jpg,jpeg,png');

            $validator = Validator::make($input,  $rules);

            if ($validator->fails())
            {
                return back()->with('danger', 'La imagen no posee un formato valido')->withInput();
            }
        }   



        $user = User::create($request->all());

        //IMAGE 
        if($request->file('image')){
            $path = Storage::disk('public')->put('image',  $request->file('image'));
            $user->fill(['file' => asset($path)])->save();
        }

        $user->password = bcrypt('123456');
        $user->save();

        Alert::success('Usuario creado con exito');
        return redirect()->route('manageusers.edit', $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('admin.manageusers.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.manageusers.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        if ($request->input('name') == ''  || $request->input('username') == '' || $request->input('email') == '') 
        {
            //Alert::error('Faltas datos para dar de alta el Usuario');
            return back()->with('danger', 'Complete todos los datos del usuario')->withInput();
        }


        if (User::where('username', $request->input('username'))->where('id', '!=', $id)->first()) 
        {
            return back()->with('danger', 'Este username ya esta en uso')->withInput();
        }

        if (User::where('email', $request->input('email'))->where('id', '!=',  $id)->first()) 
        {
            return back()->with('danger', 'Este email ya esta en uso')->withInput();
        }

        if($request->file('image')){

            $input  = array('image' => $request->file('image'));

            $rules = array('image' => 'mimes:jpg,jpeg,png');

            $validator = Validator::make($input,  $rules);

            if ($validator->fails())
            {
                return back()->with('danger', 'La imagen no posee un formato valido')->withInput();
            }
        }


        $user = User::find($id);

        $user->fill($request->all())->save();

         //IMAGE 
        if($request->file('image')){
            $path = Storage::disk('public')->put('image',  $request->file('image'));
            $user->fill(['file' => asset($path)])->save();
        }

        Alert::success('Usuario actualizado con exito');
        return redirect()->route('manageusers.edit', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        User::find($id)->delete();

        Alert::success('Eliminado correctamente');
        return back();
    }
}

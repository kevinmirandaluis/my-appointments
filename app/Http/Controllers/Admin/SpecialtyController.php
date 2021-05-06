<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Specialty;

class SpecialtyController extends Controller
{

    public function index()
    {
    	$specialties = Specialty::all();
    	return view('specialties.index', compact('specialties'));
    }

    public function create()
    {
    	return view('specialties.create');
    }

    public function store(Request $request)
    {

   $this->performeValidation($request);
   
    	$specialty = new Specialty();
    	$specialty->name = $request->input('name');
    	$specialty->description = $request->input('description');
    	$specialty->save();


        $notification = 'La especialidad se ha registrado correctamente';
    	return redirect('/specialties')->with(compact('notification'));
    }

    public function edit(Specialty $specialty)
    {
    	return view ('specialties.edit', compact('specialty'));
    }

    private function performeValidation(Request $request)
    {        
        $rules=[
            'name' => 'required|min:3'      
        ];

        $messages = [
            'name.required' =>'Es Necesario ingresar un nombre.',
            'name.min' =>'Como minimo el nombre debe tener 3 caracteres.', 
        ];

        $this->validate($request, $rules, $messages);
    }


    public function update(Request $request, Specialty $specialty)
    {

        $this->performeValidation($request);
    //dd($request->all());	
    	
    	$specialty->name = $request->input('name');
    	$specialty->description = $request->input('description');
    	$specialty->save(); //Update

        $notification = 'La especialidad se ha actualizado correctamente';
    	return redirect('/specialties')->with(compact('notification'));
    }

    public function destroy(Specialty $specialty)
    {
        $deletedSpecialty = $specialty->name;
        $specialty->delete();

        $notification='La especialidad '.$deletedSpecialty.' se ha eliminado correctamente';
        return redirect('/specialties')->with(compact('notification'));
    }
}


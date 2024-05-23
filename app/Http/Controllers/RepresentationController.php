<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Representation;
use Carbon\Carbon;

use App\Models\Location;
use App\Models\Show;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RepresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $representations = Representation::all();
        
        return view('representation.index',[
            'representations' => $representations,
            'resource' => 'représentations',
        ]);
    }

        /**
     * Display a listing of the resource.
     */
    public function index_admin()
    {
        $representations = Representation::all();
        
        return view('representation_admin.index',[
            'representations' => $representations,
            'resource' => 'représentations',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Récupérer toutes les désignations des locations
        $locations = Location::pluck('designation', 'id');
        
        // Récupérer tous les titres des shows
        $shows = Show::pluck('title', 'id');
        
        // Passer les locations et les shows à la vue
        return view('representation.create', compact('locations', 'shows'));
    }

// Dans RepresentationController.php

public function store(Request $request)
{
    $request->validate([
        'location_id' => 'required|exists:locations,id',
        'show_id' => 'required|exists:shows,id',
        'when' => 'required|date_format:Y-m-d H:i:s',
        // Valider les autres champs de formulaire...
    ]);

    // Traiter les données du formulaire, par exemple :
    $representation = new Representation();
    $representation->location_id = $request->location_id;
    $representation->show_id = $request->show_id;
    $representation->when = $request->when;
    // Affecter d'autres champs...
    $representation->save();

    return redirect()->route('representation_admin.index');
}



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $representation = Representation::find($id);
        $date = Carbon::parse($representation->when)->format('d/m/Y');
        $time = Carbon::parse($representation->when)->format('G:i');
        
        return view('representation.show',[
            'representation' => $representation,
            'date' => $date,
            'time' => $time,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_admin($id)
    {
        $representation = Representation::find($id);
        $date = Carbon::parse($representation->when)->format('d/m/Y');
        $time = Carbon::parse($representation->when)->format('G:i');
        
        return view('representation_admin.show',[
            'representation' => $representation,
            'date' => $date,
            'time' => $time,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

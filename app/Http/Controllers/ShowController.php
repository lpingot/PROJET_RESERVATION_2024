<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Show;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)  // Ajoutez Request ici
    {
        $query = Show::query();

        if ($request->has('tag')) {
            $tag = $request->input('tag');
            $query->whereHas('tags', function($q) use ($tag) {
                $q->where('tag', 'LIKE', "%{$tag}%");
            });
        }

        $shows = $query->get();
        return view('show.index',[
            'shows' => $shows,
            'resource' => 'spectacles',
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
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
        $show = Show::find($id);
        $user = Auth::user();
        $tags = Tag::all();  // Récupérer tous les tags disponibles

        
        //Récupérer les artistes du spectacle et les grouper par type
        $collaborateurs = [];
        
        foreach($show->artistTypes as $at) {
            $collaborateurs[$at->type->type][] = $at->artist;
        }
        
        return view('show.show',[
            'show' => $show,
            'collaborateurs' => $collaborateurs,
            'user' => $user,  // Passer l'utilisateur connecté à la vue
            'tags' => $tags,  // Passer les tags à la vue

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
    
    public function addTag(Request $request, $id)
    {
        $request->validate([
            'tag_id' => 'required|exists:tags,id',
        ]);

        $show = Show::find($id);
        $tag_id = $request->tag_id;

        // Ajouter le tag au show
        $show->tags()->attach($tag_id);

        return redirect()->route('show.show', $id)->with('success', 'Tag ajouté avec succès!');
    }


    public function untaggedShows()
    {
        // Récupérer les shows qui n'ont pas de tags
        $untaggedShows = Show::doesntHave('tags')->get();

        return view('show.untagged', [
            'untaggedShows' => $untaggedShows,
        ]);
    }
}

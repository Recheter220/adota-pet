<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PetController extends Controller
{
    protected $fields = [
        'name' => 'nome',
        'species' => 'espécie',
        'gender' => 'sexo',
        'breed' => 'raça',
        'color' => 'cor',
        'birthday' => 'nascimento',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::all();

        return Inertia::render('pets/List', [
            'pets' => $pets,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('pets/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'species' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'breed' => ['required', 'string'],
            'color' => ['required', 'string'],
            'birthday' => ['required', 'date'],
            'bio' => ['required', 'string'],
        ], $this->messages, $this->fields);

        $pet = Pet::create($validated);

        return redirect()->route('pets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pet = Pet::find($id);

        return Inertia::render('pets/Edit', [
            'pet' => $pet,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        /** @var Pet */
        $pet = Pet::find($id);
        $pet->fill($request->input());
        $pet->save();

        return redirect()->route('pets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pet = Pet::find($id);
        if ($pet) {
            $pet->delete();
        }

        return redirect()->route('pets.index');
    }
}

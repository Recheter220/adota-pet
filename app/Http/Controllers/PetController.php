<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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
        'gallery' => 'galeria de fotos'
    ];

    protected $messages = [
        'gallery' => 'A galeria de fotos deve conter apenas arquivos de imagem',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::with('organization')->get();

        return Inertia::render('pets/Index', [
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
            'gallery' => ['mimetypes:image/*']
        ], $this->messages, $this->fields);

        /** TODO: remove hardcoded organization_id before Auth */
        $organization_id = Organization::inRandomOrder()->first()->id;
        $validated['organization_id'] = $organization_id;

        $pet = Pet::create($validated);

        /** @var UploadedFile $picture */
        $picture = $validated['gallery'];
        $path = sprintf('pets/gallery/%d', $pet->id);
        $pet->picture = $picture->storePublicly($path);
        $pet->save();

        return redirect()->route('pets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        return Inertia::render('pets/Edit', [
            'pet' => $pet,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        $pet->fill($request->input());
        $pet->save();

        return redirect()->route('pets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        $pet->delete();

        return redirect()->route('pets.index');
    }
}

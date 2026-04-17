<?php

namespace App\Http\Controllers;

use App\Models\PetGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
     */
    public function show(PetGallery $petGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PetGallery $petGallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PetGallery $petGallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PetGallery $item)
    {
        if (Storage::delete($item->path)) {
            $item->delete();
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('albums.index', [
            'albums' => auth()->user()->albums,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumRequest $request)
    {
        $album = auth()->user()->albums()->create([
            'name' => $request->name,
            'cover_image' => 'image.jpg',
        ]);
        $album->addMedia($request->file('cover_image'))->toMediaCollection('cover_image');
        return redirect()->route('albums.index')->with('success', 'Album created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = auth()->user()->albums()->findOrFail($id);

        return view('albums.show', [
            'album' => $album,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        return view('albums.edit', [
            'album' => $album,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $album = auth()->user()->albums()->findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cover_image' => 'sometimes|nullable|image|mimes:png,jpg,jpeg,gif|max:5120',
        ]);
        $album->update(['name' => $validated['name']]);
        if($request->has('cover_image')) {
            $album->clearMediaCollection('cover_image');
            $album->addMedia($request->file('cover_image'))->toMediaCollection('cover_image');
        }
        return redirect()->route('albums.index')->with('success', 'Album updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = auth()->user()->albums()->findOrFail($id);
        $album->clearMediaCollection('cover_image');
        $album->delete();
        return redirect()->route('albums.index')->with('success', 'Album Deleted successfully.');
    }
}

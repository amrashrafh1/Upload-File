<?php

namespace App\Http\Controllers;

use App\Jobs\MovePhotos;
use App\Models\Album;
use Illuminate\Http\Request;

class MovePhotoController extends Controller
{
    public function move(Request $request, $album_id)
    {
        return view('albums.move', [
            'album' => auth()->user()->albums()->findOrFail($album_id),
        ]);
    }


    public function delete_and_move(Request $request, $album_id)
    {
        $album = auth()->user()->albums()->findOrFail($album_id);
        $validated = $request->validate([
            'name' => 'required|string|exists:albums,name',
        ]);
        $newAlbum = auth()->user()->albums()->where('name', '=', $validated['name'])->first();
        if(isset($newAlbum)){
            MovePhotos::dispatch($album, $newAlbum);
        }
        return redirect()->route('albums.index')->with('success', 'Photos moved successfully');
    }
}

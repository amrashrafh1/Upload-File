<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class PhotoController extends Controller
{

    public function index(Request $request, $album_id)
    {
        if($request->ajax()) {

            $album = auth()->user()->albums()->where('id', $album_id)->first();
            $photos = $album->getMedia('photos');
            return $photos->map->only(['name', 'size', 'original_url', 'uuid']);
        }
        return response()->json(['success' => false]);
    }

    public function store(Request $request, $album_id)
    {
        if($request->ajax()) {
            $validated = $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $album = auth()->user()->albums()->findOrFail($album_id);

            $album->addMedia($validated['file'])->toMediaCollection('photos');
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function destroy(Request $request, $album_id)
    {
        if($request->ajax()) {
            $album = auth()->user()->albums()->findOrFail($album_id);
            $validated = $request->validate([
                'id' => 'required|string|exists:media,uuid',
            ]);
            $album->getMedia('photos')->where('uuid', $validated['id'])->first()->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

}

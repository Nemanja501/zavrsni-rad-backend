<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Http\Resources\GalleryResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->input('filter');
        if($filter){
            $galleries = Gallery::with('user')->where('title', 'like', "%$filter%")->orWhereHas('user', function($q) use ($filter){
                $q->where('first_name', 'like', "%$filter%");
            })->orWhereHas('user', function($q) use ($filter){
                $q->where('last_name', 'like', "%$filter%");
            })->paginate(10);
        }else{
            $galleries = Gallery::with('user')->paginate(10);
        }
        return GalleryResource::collection($galleries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGalleryRequest $request)
    {
        $validated = $request->validated();
        $gallery = Gallery::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'pictures' => $validated['pictures'],
            'user_id' => $validated['user_id']
        ]);

        return new GalleryResource($gallery);
    }

    public function myGalleries(Request $request){
        $userId = Auth::user()->id;
        
        $filter = $request->input('filter');
        if($filter){
            $galleries = Gallery::with('user')->where('user_id', $userId)->where('title', 'like', "%$filter%")->paginate(10);
        }else{
            $galleries = Gallery::with('user')->where('user_id', $userId)->paginate(10);
        }
        return GalleryResource::collection($galleries);
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}

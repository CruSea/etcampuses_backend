<?php

namespace App\Http\Controllers\API;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\CampusAdmin;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {

            //image validation
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            //campus admin validation

            $gallery = new Gallery();

            //retrieve campusID from campusAdmin table
            $campusAdmin = CampusAdmin::where('email', $request->session()->get('userEmail'))->first();

            $gallery->campusID = $campusAdmin->campusID;
                    
            $path = $request->image->storePublicly('gallery','public');
            $gallery->imageURL = $path;

            $gallery->save();

            return response()->json([
                'status' => 200,
                'message' => 'Image uploaded successfully',
            ],);

        }
        else{
            return response()->json([
                'status' => 403,
                'message' => 'Not Logged in!',
            ]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //check if session exsists
        if ($request->session()->exists('userEmail')) {

            $gallery = Gallery::where('imageURL',$request->imageURL)->first();
            if($gallery == null){
                return response()->json([
                    'status' => 404,
                    'message' => 'Image not found!',
                ],);
            }

            //make sure the image belongs to the campus admin
            $campusAdmin = CampusAdmin::where('email',$request->session()->get('userEmail'))->first();

            if($gallery->campusID != $campusAdmin->campusID){
                return response()->json([
                    'status' => 403,
                    'message' => 'Not authorized!',
                ],);
            }

            $gallery->delete();

            Storage::disk('public')->delete($request->imageURL);

            return response()->json([
                'status' => 200,
                'message' => 'Image deleted successfully',
            ],);

        }
        else{
            return response()->json([
                'status' => 403,
                'message' => 'Not Logged in!',
            ]);
        }
    }
}

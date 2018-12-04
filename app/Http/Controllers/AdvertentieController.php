<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use Illuminate\Support\Facades\Auth;
use App\Advertentie;
use Image;

class AdvertentieController extends Controller
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
        return view('advertentie.create')->withCategories(Category::all())->withSubcategories(Subcategory::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        $this->validate($request, array(
            'title' => 'required|string|max:255|min:3|unique:advertenties',
            'body'  => 'required|string|max:25500',
            'photo1' => 'sometimes|image|max:255',
            'photo2' => 'sometimes|image|max:255',
            'photo3' => 'sometimes|image|max:255',
            'photo4' => 'sometimes|image|max:255',
            'photo5' => 'sometimes|image|max:255',
            'photo6' => 'sometimes|image|max:255',
            'price'  => 'reqiured|numeric',
            'subcategory_id' => 'exists:subcategories,id',
        ));

        $advertentie = new Advertentie;
        $advertentie->title = $request->title;
        $advertentie->body = $request->body;
        $advertentie->subcategory_id = $request->subcategory_id;
        $advertentie->price = $request->price;

        foreach([1,2,3,4,5,6] as $v) {

            if ($request->hasFile("photo$v")) {
                $image = $request->file("photo$v");
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('images/' . $filename);
                Image::make($image)->save($location);
                $oldFilename = $post->image;

                $post->image = $filename;
                File::delete('images/'.$oldFilename);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

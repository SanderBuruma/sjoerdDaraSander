<?php

namespace App\Http\Controllers;

use File;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Subcategory;
use App\Advertentie;

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
        
        $this->validate($request, array(
            'title'             => 'required|string|max:255|min:3|unique:advertenties',
            'description'       => 'required|string|max:25500',
            'photo1'            => 'sometimes|image|max:255',
            'photo2'            => 'sometimes|image|max:255',
            'photo3'            => 'sometimes|image|max:255',
            'photo4'            => 'sometimes|image|max:255',
            'photo5'            => 'sometimes|image|max:255',
            'photo6'            => 'sometimes|image|max:255',
            'price'             => 'required|numeric',
            'subcategory_id'    => 'exists:subcategories,id',
        ));

        $advertentie = new Advertentie;
        $advertentie->title             = $request->title;
        $advertentie->description       = $request->description;
        $advertentie->subcategory_id    = $request->subcategory;
        $advertentie->user_id    = auth()->id();
        $advertentie->price             = $request->price*100;
        $advertentie->slug              = random_int(1e15,1e16-1)."-".time();

        foreach([1,2,3,4,5,6] as $v) {
            if ($request->hasFile("photo$v")) {
                $image = $request->file("photo$v");
                $randomNr = random_int(1e10,1e11-1);
                $filename = time() . "$randomNr." . $image->getClientOriginalExtension();
                $location = '/images/' . $filename;
                Image::make($image)->save($location);
                $advertentie["photo$v"] = $location;
            }
        }

        $advertentie->save();
        Session::flash('success', "$advertentie->title geplaatst!");
		return redirect()->route('advertentie.show', $advertentie->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
		$advertentie = Advertentie::where('slug', '=', $slug)->first();
        return view('advertentie.show')->withAdvertentie($advertentie);
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advertentie;

class AdvertentiesSearchController extends Controller
{
    public function homeSearch(Request $request) {
        $advertenties = Advertentie::
              where('price', '<', 500)
            // ->join('contacts', 'users.id', '=', 'contacts.user_id')
            // ->join('subcategories', 'advertenties.subcategory_id', '=', 'subcategories.category_id')
            ->join('subcategories', 'advertenties.subcategory_id', '=', 'subcategories.id')
            ->select('advertenties.*', 'subcategories.category_id')
            // ->where('subcategories.category_id',$request->home_search_select)
            // ->where('advertenties.title','like',"%$request->home_search_text%")
            ->where([
                ['advertenties.title','like',"%$request->home_search_text%"],
                ['subcategories.category_id','=',$request->home_search_select],
            ])
            ->limit(25)
            ->orderByDesc('advertenties.created_at')
            ->get();
        return $advertenties;
    }
}

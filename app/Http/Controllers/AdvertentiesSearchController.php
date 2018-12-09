<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advertentie;

class AdvertentiesSearchController extends Controller
{
	public function homeSearch(Request $request) {
		$queryWhereArr = [
			['advertenties.title','like',"%$request->home_search_text%"],
		];
		if ($request->home_search_select != 1) {
			//doesn't include this where condition if ALL is selected
			$queryWhereArr[] = ['subcategories.category_id','=',$request->home_search_select];
		}
		$advertenties = Advertentie::
				where('price', '<', 500)
			->join('subcategories', 'advertenties.subcategory_id', '=', 'subcategories.id')
			->select('advertenties.*', 'subcategories.category_id')
			->where($queryWhereArr)
			->limit(25)
			->orderByDesc('advertenties.created_at')
			->get();
		return $advertenties;
	}
}

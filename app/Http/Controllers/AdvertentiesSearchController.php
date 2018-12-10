<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advertentie;

class AdvertentiesSearchController extends Controller
{
	public function homeSearch(Request $request) {

		$queryWhereArr = [
			['advertenties.title','like',"%$request->search_text%"],
		];

		if ($request->search_select != 1) {
			//doesn't include this where condition if ALL category is selected
			$queryWhereArr[] = ['subcategories.category_id','=',$request->search_select];
		}

		$offset = 12;
		$advertenties = Advertentie::
				where('price', '<', 1e9)
			->join('subcategories', 'advertenties.subcategory_id', '=', 'subcategories.id')
			->join('users', 'advertenties.user_id', '=', 'users.id')
			->select('advertenties.*', 'subcategories.category_id', 'users.city')
			->where($queryWhereArr)
			->limit($offset)
			->offset(($request->search_paginate_nr-1)*$offset)
			->orderByDesc('advertenties.created_at')
			->get();
		return $advertenties;
	}
}

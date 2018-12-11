<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advertentie;
use App\User;

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

		$user = User::find(auth()->id());
		if ($request->search_distance > 0) {
			$queryWhereArr[] = ['users.latitude','>',$user->latitude-(1/111.1111)*$request->search_distance];
			$queryWhereArr[] = ['users.latitude','<',$user->latitude+(1/111.1111)*$request->search_distance];
			$longitudeMargin = (1/111.1111)/cos(abs($user->latitude)/57.295);
			$queryWhereArr[] = ['users.longitude','>',$user->longitude-$longitudeMargin*$request->search_distance];
			$queryWhereArr[] = ['users.longitude','<',$user->longitude+$longitudeMargin*$request->search_distance];
		}
		// return $queryWhereArr;

		$offset = 6;
		$advertenties = Advertentie::
				where('price', '<', 1e9)
			->join('subcategories', 'advertenties.subcategory_id', '=', 'subcategories.id')
			->join('users', 'advertenties.user_id', '=', 'users.id')
			->select('advertenties.*', 'subcategories.category_id', 'users.city', 'users.latitude', 'users.longitude')
			->where($queryWhereArr)
			// ->limit($offset)
			// ->offset(($request->search_paginate_nr-1)*$offset)
			->orderByDesc('advertenties.created_at')
			->get();

		//calculate distances and filter out far away advertenties
		$tempArr = [];
		$debug = [];
		foreach ($advertenties as $advertentie) {
			$advertentie->distance = (($advertentie->latitude - $user->latitude)**2)+((($advertentie->longitude - $user->longitude)/cos($advertentie->latitude/57.295))**2)**.5 / .009;
			if ($advertentie->distance < $request->search_distance) {
				$tempArr[] = $advertentie;
			}
		}

		$offset = 6;
		$count = 0;
		$data = [];
		while ($count++ < $offset) {
			if (isset($tempArr[$count+$offset*($request->search_paginate_nr-1)])) {
				$data[] = $tempArr[$count+$offset*($request->search_paginate_nr-1)];
			}
		}

		return $data;

	}
}

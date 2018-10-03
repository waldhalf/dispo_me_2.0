<?php

namespace App\Http\Controllers;

use IlluminateHttpRequest;

use DB;
use App\SkillTagModel;

class Select2AutocompleteController extends Controller

{

/**

* Show the application layout.

*

* @return IlluminateHttpResponse

*/

public function layout()

{

	return view('select2');

}

/**

* Show the application dataAjax.

*

* @return IlluminateHttpResponse

*/

public function dataAjax(Request $request)

{

	$data = [];

	if($request->has('q')){

		$search = $request->q;
		var_dump('dans le controller');
		$data = DB::table("skill_tags")

		->select("id","skill_name")

		->where('skill_name','LIKE',"%$search%")

		->get();

	}

	return response()->json($data);

}

}
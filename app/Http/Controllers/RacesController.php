<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\Round;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RacesController extends Controller
{
	public function index()
	{
		$data = Race::with(['rounds' => function ($query) {
			$query->select('race_id', 'id', 'time');
		}])->select('id', 'name', 'year')->get();

		return $data;
	}

	public function create(Request $request){
		$request->validate([
            'name' => 'required|string',
            'year' => 'required|integer',
        ]);

		$race = new Race([
			'name' => $request->input('name'),
            'year' => $request->input('year'),
		]);

		$race->save();

		//return $race;
	}
}

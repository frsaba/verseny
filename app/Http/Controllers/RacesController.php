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
		// $data = Race::with(['rounds' => function ($query) {
		// 	$query->select('race_id', 'id', 'time');
		// }])->select('id', 'name', 'year')->get();

		$allRaces = Race::with(['rounds' => function ($query) {
			$query->select('id', 'race_id', 'time');
			$query->with(['contestants' => function ($query) {
				$query->select('users.id', 'name', 'email');
			}]);
		}])
		->select('id', 'name', 'year')->orderBy('id', 'desc')
		->get();

		return $allRaces;
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

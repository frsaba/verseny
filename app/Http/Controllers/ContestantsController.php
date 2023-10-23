<?php

namespace App\Http\Controllers;

use App\Models\Contestant;
use Illuminate\Http\Request;

class ContestantsController extends Controller
{
    public function create($roundID, Request $request){
		$request->validate([
            'user_id' => 'required|int',
        ]);

		

		$contestant = new Contestant([
			'round_id' => $roundID,
			'user_id' => $request->input('user_id'),
		]);

		$contestant->save();
	}
}

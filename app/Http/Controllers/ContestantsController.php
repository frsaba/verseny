<?php

namespace App\Http\Controllers;

use App\Models\Contestant;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class ContestantsController extends Controller
{
    public function create($round_id, Request $request){
		$request->validate([
            'user_id' => 'required|int',
        ]);

		

		$contestant = new Contestant([
			'round_id' => $round_id,
			'user_id' => $request->input('user_id'),
		]);

		$contestant->save();
	}

	public function destroy($round_id, $user_id){

		Contestant::where('user_id', $user_id)
              ->where('round_id', $round_id)
              ->delete();
	}
}

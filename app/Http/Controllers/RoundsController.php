<?php

namespace App\Http\Controllers;

use App\Models\Round;
use Illuminate\Http\Request;

class RoundsController extends Controller
{
    public function create($id, Request $request){
		// $request->validate([
        //     'race_id' => 'required|integer',
        // ]);

		$round = new Round([
			'race_id' => $id,
		]);

		$round->save();
	}
}

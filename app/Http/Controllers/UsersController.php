<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index()
	{
		$data = ['users' => User::all()];

		return Inertia::render('Users', $data);
	}

	public function create(Request $request){
		$request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
        ]);

		$user = new User([
			'name' => $request->input('name'),
            'email' => $request->input('email'),
		]);

		$user->save();


		return $this->index();
	}
}

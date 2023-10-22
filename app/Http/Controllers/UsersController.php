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
}

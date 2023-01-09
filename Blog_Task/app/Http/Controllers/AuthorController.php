<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function create()
    {
        return view('dashboard.authors.create');


    } //end of create author method

    public function store(Request $request)
    {
        $request->validate( [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'type' => 'author'
        ]);

        return to_route('dashboard.author.create')->with('message', 'Author created successfully');

        
    } //end of store author method

} //end of authors controller

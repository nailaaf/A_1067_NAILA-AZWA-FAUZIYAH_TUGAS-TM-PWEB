<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $username = 'Owner';
        return view('profile', compact('username'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    public function users()
    {
        // try{
            $usersList = User::where('role', 'User')->get();
            return view('admin.Users.list' , compact('usersList') );
        // } catch (\Throwable $th) {
            // return redirect()->back()->with('error', $th->getMessage());
        // }
    }
    
}

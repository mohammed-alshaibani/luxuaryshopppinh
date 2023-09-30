<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);
        return view('BackEnd.Admin.User.Index', compact('users'));
    } 
    
   public function edit(Request $request, $id)
    {
        $user = User::find($id);
        return view('BackEnd.Admin.User.Index', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->type = $request->input('type');
        $user->save();;

        return redirect()->route('User.Index')
            ->with('success', 'تم تحديث نوع المستخدم بنجاح');
    }
}
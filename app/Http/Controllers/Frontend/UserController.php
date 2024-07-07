<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.users.profile');
    }

    public function updateUserDetails(Request $request)

    {
        $request->validate([


             'username'=>['required','string'],
            'phone' => ['required'],
            'pin_code' => ['required'],
            'address' =>  ['required','string', 'max:499'],

        ]);

        $user = User::findOrFail(Auth::user()->id);

        $user ->update([
           'name'=>$request->username
        ]);

        $user->userDetails()->updateOrCreate(
            [
               // 'user_id'=> $user->id,
            ],
            [
                'phone' => $request ->phone,
                'pin_code' => $request ->pin_code,
                'address' =>  $request ->address
            ]
        );

        return redirect()->back()->with('message', 'Perfil Alterado com Sucesso');
    }
}

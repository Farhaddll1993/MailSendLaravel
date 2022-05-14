<?php

namespace App\Http\Controllers;

use App\Mail\MailSent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function getUserList()
    {
        $users = User::all();
        return $users;
    }

    public function sendEmail(Request $request)
    {        
        $data =  Mail::to($request->userEmail)->send(new MailSent());
        // return $request->index;
        return response()->json(['index' => $request->index]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

	public function __constract()
	{
		$this->middleware('auth');
	}

    public function chat()
    {
    	return view('chat');
    }

    public function send(Request $req)
    {
    	// return $req->all();
    	$user = User::find(Auth::id());
    	event(new ChatEvent($req->message,$user));
    }

    // public function send()
    // {
    // 	$message = 'Hello!';
    // 	$user = User::find(Auth::id());
    // 	event(new ChatEvent($message,$user));
    // }
}

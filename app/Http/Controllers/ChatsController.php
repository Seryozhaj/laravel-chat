<?php

namespace App\Http\Controllers;

use App\Room;
use App\RoomUser;
use App\Events\MessageSent;
use App\Message;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {   
        
        $fillurl = url()->full();
        $chatArrayUlr = explode('/', $fillurl);
        $chatUrl = $chatArrayUlr[count($chatArrayUlr) - 1];
        $room = Room::where('url', $chatUrl)->get();
        if ($room->isEmpty()) {
            return redirect('/');
        }
        $roomId = $room[0]->id;
        $room_users = RoomUser::where([
            ['room_id', '=', $roomId],
        ])->get();
        if ($room_users->isEmpty()) {
            return redirect('/');
        }
        return view('chat');
    }

    public function fetchMessages()
    {
        $link = url()->previous();
        $linkarr = explode('/', $link);
        $url = $linkarr[count($linkarr) - 1];
        $room = Room::where('url', $url)->get();
        return Message::with('user')->where('room_id', $room[0]->id)->get();
    }

    public function sendMessage(Request $request)
    {
        $link = url()->previous();
        $linkarr = explode('/', $link);
        $url = $linkarr[count($linkarr) - 1];
        $room = Room::where('url', $url)->get();

        $message = \Auth::user()->messages()->create([
            'message' => $request->message,
            'room_id' => $room[0]->id
        ]);

		broadcast(new MessageSent(auth()->user(), $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}

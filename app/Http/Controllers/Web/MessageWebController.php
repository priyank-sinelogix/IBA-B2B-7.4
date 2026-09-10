<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageWebController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::with('sender')
            ->where('company_id', $request->user()->company_id)
            ->latest()->paginate(100);

        Message::where('company_id', $request->user()->company_id)
            ->where('is_read', false)
            ->whereHas('sender', function ($q) {
                $q->whereIn('role', ['admin', 'super_admin']);
            })
            ->update(['is_read' => true]);

        return view('messages.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate(['body' => 'required|string|max:2000']);

        Message::create([
            'company_id' => $request->user()->company_id,
            'sender_id' => $request->user()->id,
            'body' => $request->input('body'),
            'is_read' => true,
        ]);

        return back()->with('success', 'Message sent.');
    }
}

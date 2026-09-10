<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Inbox: every client company that has messaged us, newest conversation first,
     * with an unread badge (messages sent by a customer that no admin has opened yet).
     */
    public function index()
    {
        $companies = Company::query()
            ->whereHas('messages')
            ->with(['messages' => function ($q) {
                $q->latest()->limit(1);
            }])
            ->withCount(['messages as unread_count' => function ($q) {
                $q->where('is_read', false)
                    ->whereHas('sender', function ($s) {
                        $s->where('role', 'customer');
                    });
            }])
            ->get()
            ->sortByDesc(function ($company) {
                return optional($company->messages->first())->created_at;
            })
            ->values();

        return view('admin.messages.index', compact('companies'));
    }

    public function show(Company $company)
    {
        $messages = Message::with('sender')
            ->where('company_id', $company->id)
            ->oldest()
            ->get();

        Message::where('company_id', $company->id)
            ->where('is_read', false)
            ->whereHas('sender', function ($s) {
                $s->where('role', 'customer');
            })
            ->update(['is_read' => true]);

        return view('admin.messages.show', compact('company', 'messages'));
    }

    public function store(Request $request, Company $company)
    {
        $request->validate(['body' => 'required|string|max:2000']);

        Message::create([
            'company_id' => $company->id,
            'sender_id' => $request->user()->id,
            'body' => $request->input('body'),
            'is_read' => true,
        ]);

        return redirect('/admin/messages/'.$company->id);
    }
}

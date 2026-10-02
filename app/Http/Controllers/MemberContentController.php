<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberContentController extends Controller
{
    public function storeTicket(Request $request)
    {
        $data = $request->validate(['title' => ['required','string','max:255'], 'type' => ['required','string','max:50'], 'attachment' => ['nullable','file','max:10240']]);
        if ($request->hasFile('attachment')) $data['attachment'] = $request->file('attachment')->store('support', 'public');
        $request->user()->supportTickets()->create($data);
        return back()->with('success', 'Support request sent.');
    }

    public function storeComment(Request $request)
    {
        $data = $request->validate(['body' => ['required','string','max:2000']]);
        $request->user()->contentComments()->create($data);
        return back()->with('success', 'Comment sent.');
    }
}

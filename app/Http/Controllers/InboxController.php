<?php

namespace App\Http\Controllers;

use App\Models\InboxMessage;
use App\Models\User;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->with(['inboxMessages' => fn ($query) => $query->latest()->limit(1)])
            ->orderBy('name')
            ->get();

        $selectedUser = $request->filled('user')
            ? $users->firstWhere('id', (int) $request->user)
            : $users->first();

        $messages = collect();
        if ($selectedUser) {
            $messages = $selectedUser->inboxMessages()->oldest()->get();
            InboxMessage::where('user_id', $selectedUser->id)
                ->where('sent_by_admin', false)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);
        }

        return view('admin.inbox.index', compact('users', 'selectedUser', 'messages'));
    }

    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        $user->inboxMessages()->create([
            'body' => $validated['body'],
            'sent_by_admin' => true,
        ]);

        return redirect()->route('inbox.index', ['user' => $user->id]);
    }

    public function update(Request $request, User $user, InboxMessage $message)
    {
        abort_unless($message->user_id === $user->id && $message->sent_by_admin, 404);
        $message->update($request->validate(['body' => ['required', 'string', 'max:2000']]));
        return redirect()->route('inbox.index', ['user' => $user->id])->with('success', 'Message updated.');
    }

    public function destroy(User $user, InboxMessage $message)
    {
        abort_unless($message->user_id === $user->id, 404); $message->delete();
        return redirect()->route('inbox.index', ['user' => $user->id])->with('success', 'Message deleted.');
    }
}

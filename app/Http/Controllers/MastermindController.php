<?php

namespace App\Http\Controllers;

use App\Models\MastermindGroup;
use App\Models\MastermindMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MastermindController extends Controller
{
    public function index(Request $request)
    {
        $groups = MastermindGroup::query()->with('members')
            ->when($request->filled('status') && $request->status !== 'All', fn ($query) => $query->where('status', $request->status))
            ->latest()
            ->paginate(6)
            ->withQueryString();

        $coaches = User::orderBy('name')->get();

        return view('admin.mastermind.index', compact('groups', 'coaches'));
    }

    public function details(MastermindGroup $group = null)
    {
        $groups = MastermindGroup::with('members')->latest()->paginate(6);
        $selectedGroup = $group ?? $groups->first();
        $messages = $selectedGroup?->messages()->oldest()->get() ?? collect();

        return view('admin.mastermind.details', compact('groups', 'selectedGroup', 'messages'));
    }

    public function storeMessage(Request $request, MastermindGroup $group)
    {
        $validated = $request->validate(['body' => ['required', 'string', 'max:2000']]);

        MastermindMessage::create([
            'mastermind_group_id' => $group->id,
            'sender_name' => $request->session()->get('admin_name', $group->instructor_name),
            'body' => $validated['body'],
        ]);

        return redirect()->route('mastermind.details', $group)->with('success', 'Message sent.');
    }

    public function updateMessage(Request $request, MastermindGroup $group, MastermindMessage $message)
    {
        abort_unless($message->mastermind_group_id === $group->id, 404);
        $message->update($request->validate(['body' => ['required', 'string', 'max:2000']]));
        return back()->with('success', 'Message updated.');
    }

    public function destroyMessage(MastermindGroup $group, MastermindMessage $message)
    {
        abort_unless($message->mastermind_group_id === $group->id, 404); $message->delete();
        return back()->with('success', 'Message deleted.');
    }

    public function update(Request $request, MastermindGroup $group)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'instructor_name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:Active,Closed'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('cover_image')) {
            if ($group->cover_image) Storage::disk('public')->delete($group->cover_image);
            $validated['cover_image'] = $request->file('cover_image')->store('mastermind-covers', 'public');
        }

        $group->update($validated);

        $coach = User::where('name', $validated['instructor_name'])->first();
        if ($coach) {
            $members = $group->members()->pluck('users.id')->mapWithKeys(fn ($id) => [$id => ['role' => 'member']])->all();
            $members[$coach->id] = ['role' => 'coach'];
            $group->members()->sync($members);
        }

        return redirect()->route('mastermind.index')->with('success', 'Group updated successfully.');
    }

    public function updateMembers(Request $request, MastermindGroup $group)
    {
        $validated = $request->validate([
            'members' => ['nullable', 'array'],
            'members.*' => ['integer', 'exists:users,id'],
        ]);

        $coach = User::where('name', $group->instructor_name)->first();
        $members = collect($validated['members'] ?? [])->mapWithKeys(fn ($id) => [$id => ['role' => 'member']]);
        if ($coach) {
            $members[$coach->id] = ['role' => 'coach'];
        }
        $group->members()->sync($members);
        $group->update(['members_count' => $group->members()->wherePivot('role', 'member')->count()]);

        return redirect()->route('mastermind.index')->with('success', 'Group members updated successfully.');
    }

    public function destroy(MastermindGroup $group)
    {
        if ($group->cover_image) Storage::disk('public')->delete($group->cover_image);
        $group->delete();

        return redirect()->route('mastermind.index')->with('success', 'Group deleted successfully.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'creation_date' => ['required', 'date'],
            'name' => ['required', 'string', 'max:255'],
            'instructor_name' => ['required', 'string', 'max:255'],
            'members_count' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:Active,Closed'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
            'members' => ['nullable', 'array'],
            'members.*' => ['integer', 'exists:users,id'],
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('mastermind-covers', 'public');
        }

        $validated['members_count'] ??= 0;
        $group = MastermindGroup::create(collect($validated)->except('creation_date')->all());
        $group->created_at = $validated['creation_date'];
        $group->save();

        $members = collect($validated['members'] ?? [])->mapWithKeys(fn ($id) => [$id => ['role' => 'member']]);
        $coach = User::where('name', $validated['instructor_name'])->first();
        if ($coach) {
            $members[$coach->id] = ['role' => 'coach'];
        }
        $group->members()->sync($members);
        $group->update(['members_count' => $group->members()->wherePivot('role', 'member')->count()]);

        return redirect()->route('mastermind.index')->with('success', 'Master Mind group added successfully.');
    }
}

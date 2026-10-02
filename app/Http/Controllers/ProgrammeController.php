<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use Illuminate\Http\Request;

class ProgrammeController extends Controller
{
    public function index(Request $request)
    {
        $programmes = Programme::query()
            ->when($request->filled('status') && $request->status !== 'All', function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.programmes.index', compact('programmes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'creation_date' => ['required', 'date'],
            'title' => ['required', 'string', 'max:255'],
            'instructor_name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'status' => ['required', 'in:Active,Ongoing,Paused'],
            'max_seats' => ['required', 'integer', 'min:1'],
        ]);

        $programme = new Programme([
            'title' => $validated['title'],
            'instructor_name' => $validated['instructor_name'],
            'start_date' => $validated['start_date'],
            'status' => $validated['status'],
            'max_seats' => $validated['max_seats'],
            'available_seats' => $validated['max_seats'],
        ]);
        $programme->created_at = $validated['creation_date'];
        $programme->save();

        return redirect()->route('programmes.index')
            ->with('success', 'Programme added successfully.');
    }

    public function update(Request $request, Programme $programme)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'instructor_name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'status' => ['required', 'in:Active,Ongoing,Paused'],
            'max_seats' => ['required', 'integer', 'min:1'],
        ]);

        $occupiedSeats = max(0, $programme->max_seats - $programme->available_seats);
        $validated['available_seats'] = max(0, $validated['max_seats'] - $occupiedSeats);

        $programme->update($validated);

        return redirect()->route('programmes.index')
            ->with('success', 'Programme updated successfully.');
    }

    public function destroy(Programme $programme)
    {
        $programme->delete();

        return redirect()->route('programmes.index')
            ->with('success', 'Programme deleted successfully.');
    }
}

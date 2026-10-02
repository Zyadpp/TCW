<?php

namespace App\Http\Controllers;

use App\Models\MediaItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $media = MediaItem::latest()->paginate(12);

        return view('admin.media.index', compact('media'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['description' => ['nullable', 'string', 'max:2000'], 'visibility' => ['required', 'in:Public,Friends,Private'], 'video' => ['required', 'file', 'mimetypes:video/mp4,video/webm,video/quicktime', 'max:102400']]);
        $video = $data['video'];
        MediaItem::create(['description' => $data['description'], 'visibility' => $data['visibility'], 'video_path' => $video->store('media', 'public'), 'original_name' => $video->getClientOriginalName()]);
        return to_route('media.index')->with('success', 'Reel uploaded and awaiting review.');
    }

    public function update(Request $request, MediaItem $media)
    {
        $data = $request->validate(['description' => ['nullable', 'string', 'max:2000'], 'visibility' => ['required', 'in:Public,Friends,Private'], 'status' => ['required', 'in:Pending,Published,Rejected']]);
        $media->update($data);
        return back()->with('success', 'Media updated.');
    }

    public function destroy(MediaItem $media)
    {
        Storage::disk('public')->delete($media->video_path);
        $media->delete();
        return back()->with('success', 'Media deleted.');
    }
}

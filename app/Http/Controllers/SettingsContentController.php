<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\ChatbotFile;
use App\Models\ChatbotQuestion;
use App\Models\ContentComment;
use App\Models\PointAction;
use App\Models\SupportTicket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsContentController extends Controller
{
    public function storeBlog(Request $request): RedirectResponse
    {
        $data = $request->validate(['title' => ['required', 'string', 'max:255'], 'overview' => ['nullable', 'string', 'max:2000'], 'status' => ['required', 'in:Published,Paused'], 'published_at' => ['nullable', 'date'], 'cover' => ['nullable', 'image', 'max:5120']]);
        if ($request->hasFile('cover')) $data['cover_image'] = $request->file('cover')->store('blogs', 'public');
        unset($data['cover']);
        Blog::create($data);
        return to_route('settings.blogs')->with('success', 'Blog created successfully.');
    }

    public function destroyBlog(Blog $blog): RedirectResponse
    {
        if ($blog->cover_image) Storage::disk('public')->delete($blog->cover_image);
        $blog->delete();
        return back()->with('success', 'Blog deleted.');
    }

    public function updateBlog(Request $request, Blog $blog): RedirectResponse
    {
        $data = $request->validate(['title' => ['required','string','max:255'], 'overview' => ['nullable','string','max:2000'], 'status' => ['required','in:Published,Paused'], 'published_at' => ['nullable','date'], 'cover' => ['nullable','image','max:5120']]);
        if ($request->hasFile('cover')) { if ($blog->cover_image) Storage::disk('public')->delete($blog->cover_image); $data['cover_image'] = $request->file('cover')->store('blogs', 'public'); }
        unset($data['cover']); $blog->update($data);
        return back()->with('success', 'Blog updated.');
    }

    public function storeAction(Request $request): RedirectResponse
    {
        $data = $request->validate(['type' => ['required', 'in:points,reward'], 'title' => ['required', 'string', 'max:255'], 'description' => ['nullable', 'string', 'max:2000'], 'points' => ['required', 'integer', 'min:0'], 'limitations' => ['nullable', 'string', 'max:100'], 'is_active' => ['nullable', 'boolean']]);
        $data['is_active'] = $request->boolean('is_active');
        PointAction::create($data);
        return to_route('settings.points')->with('success', 'Action created successfully.');
    }

    public function destroyAction(PointAction $pointAction): RedirectResponse
    {
        $pointAction->delete();
        return back()->with('success', 'Action deleted.');
    }

    public function updateAction(Request $request, PointAction $pointAction): RedirectResponse
    {
        $data = $request->validate(['type' => ['required','in:points,reward'], 'title' => ['required','string','max:255'], 'description' => ['nullable','string','max:2000'], 'points' => ['required','integer','min:0'], 'limitations' => ['nullable','string','max:100'], 'is_active' => ['nullable','boolean']]);
        $data['is_active'] = $request->boolean('is_active'); $pointAction->update($data);
        return back()->with('success', 'Action updated.');
    }

    public function updateTicket(Request $request, SupportTicket $supportTicket): RedirectResponse
    {
        $data = $request->validate(['status' => ['required', 'in:Pending,Resolved']]);
        $supportTicket->update($data);
        return back()->with('success', 'Complaint status updated.');
    }

    public function destroyComment(ContentComment $contentComment): RedirectResponse
    {
        $contentComment->delete();
        return back()->with('success', 'Comment deleted.');
    }

    public function destroyComments(Request $request): RedirectResponse
    {
        $data = $request->validate(['comments' => ['required', 'array'], 'comments.*' => ['integer', 'exists:content_comments,id']]);
        ContentComment::destroy($data['comments']);
        return back()->with('success', 'Selected comments deleted.');
    }

    public function storeQuestion(Request $request): RedirectResponse
    {
        $data = $request->validate(['question' => ['required', 'string', 'max:255'], 'answer' => ['nullable', 'string', 'max:3000']]);
        ChatbotQuestion::create($data);
        return back()->with('success', 'Question added.');
    }

    public function updateQuestion(Request $request, ChatbotQuestion $question): RedirectResponse
    {
        $data = $request->validate(['question' => ['required','string','max:255'], 'answer' => ['nullable','string','max:3000'], 'is_active' => ['nullable','boolean']]);
        $data['is_active'] = $request->boolean('is_active'); $question->update($data);
        return back()->with('success', 'Question updated.');
    }

    public function destroyQuestion(ChatbotQuestion $question): RedirectResponse { $question->delete(); return back()->with('success', 'Question deleted.'); }

    public function uploadChatbotFile(Request $request): RedirectResponse
    {
        $data = $request->validate(['file' => ['required', 'file', 'max:10240']]);
        $file = $data['file'];
        ChatbotFile::create(['path' => $file->store('chatbot', 'public'), 'original_name' => $file->getClientOriginalName()]);
        return back()->with('success', 'File uploaded.');
    }

    public function destroyChatbotFile(ChatbotFile $file): RedirectResponse { Storage::disk('public')->delete($file->path); $file->delete(); return back()->with('success', 'File deleted.'); }
}

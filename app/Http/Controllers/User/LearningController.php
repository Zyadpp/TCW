<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    public function liveEvent(Request $request, Event $event)
    {
        return view('user.live-event', [
            'event' => $event,
            'user' => $request->user(),
        ]);
    }

    public function lesson(Request $request, Lesson $lesson)
    {
        $lesson->load('module.programme');

        return view('user.lesson', [
            'lesson' => $lesson,
            'user' => $request->user(),
        ]);
    }
}

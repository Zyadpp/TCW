@extends('layouts.admin')

@push('page-styles')
    <style>
        .settings-layout-page .chatbot-card { min-height: 1075px; overflow: hidden; border-radius: 20px; background: #fff; box-shadow: 0 12px 34px rgba(37,29,14,.045); }
        .chatbot-header { display: flex; align-items: center; justify-content: space-between; min-height: 86px; padding: 0 24px; border-bottom: 1px solid #f1f1f1; }
        .chatbot-header h2 { margin: 0; color: #292929; font-size: 17px; font-weight: 600; }
        .chatbot-toggle { position: relative; width: 48px; height: 25px; margin: 0; appearance: none; border-radius: 20px; background: #eadfc9; cursor: pointer; }
        .chatbot-toggle::after { position: absolute; top: 1px; left: 1px; width: 23px; height: 23px; border-radius: 50%; background: #fff; content: ''; transition: .2s; }
        .chatbot-toggle:checked::after { left: 24px; background: #bd9147; }
        .chatbot-section-title { margin: 0; padding: 17px 25px 13px; border-bottom: 1px solid #f1f1f1; color: #171717; font-size: 14px; font-weight: 500; }
        .chatbot-question { display: flex; align-items: center; justify-content: space-between; min-height: 65px; padding: 0 25px; border-bottom: 1px solid #eee; color: #17624e; font-size: 12px; }
        .chatbot-question button { border: 0; background: transparent; color: #424242; font-size: 17px; cursor: pointer; }
        .chatbot-upload { display: flex; align-items: flex-start; gap: 13px; height: 161px; margin-top: 32px; padding: 19px; border: 1px solid #e6e6e6; border-radius: 5px; color: #999; font-size: 11px; cursor: pointer; }
        .chatbot-upload input { position: absolute; width: 1px; height: 1px; opacity: 0; }
        .chatbot-upload i { color: #aaa; font-size: 20px; line-height: .7; }
        .chatbot-upload-name { display: none; color: #43866e; }
        .chatbot-upload.has-file .chatbot-upload-name { display: inline; }
        .chatbot-upload.has-file .chatbot-upload-label { display: none; }
        @media (min-width: 801px) and (max-height: 1100px) {
            .settings-layout-page .chatbot-card { min-height: 0; height: calc(100vh - 80px); }
            .chatbot-header { min-height: 61px; padding: 0 16px; }
            .chatbot-header h2 { font-size: 14px; }
            .chatbot-toggle { width: 39px; height: 20px; }
            .chatbot-toggle::after { width: 18px; height: 18px; }
            .chatbot-toggle:checked::after { left: 20px; }
            .chatbot-section-title { padding: 12px 18px 9px; font-size: 12px; }
            .chatbot-question { min-height: 48px; padding: 0 18px; font-size: 10px; }
            .chatbot-question button { font-size: 15px; }
            .chatbot-upload { height: 120px; margin-top: 22px; padding: 15px; font-size: 10px; }
        }
        @media (max-width: 800px) { .settings-layout-page .chatbot-card { min-height: 0; } }
    </style>
@endpush

@section('content')
    <section class="settings-page chatbot-page">
        <h1>Setting</h1>
        <div class="settings-layout">
            @include('admin.settings.partials.sidebar')
            <main class="chatbot-card">
                <header class="chatbot-header"><h2>Chat Bot</h2><input class="chatbot-toggle" type="checkbox" checked aria-label="Enable chat bot"></header>
                <h3 class="chatbot-section-title">Common questions</h3>
                @foreach ($questions as $question)
                    <div class="chatbot-question"><span>{{ $question->question }}</span><details><summary>â‹®</summary><form action="{{ route('settings.chatbot.questions.update', $question) }}" method="POST">@csrf @method('PUT')<input name="question" value="{{ $question->question }}"><textarea name="answer">{{ $question->answer }}</textarea><input type="hidden" name="is_active" value="0"><label><input type="checkbox" name="is_active" value="1" @checked($question->is_active)> Active</label><button>Save</button></form><form action="{{ route('settings.chatbot.questions.destroy', $question) }}" method="POST">@csrf @method('DELETE')<button>Delete</button></form></details></div>
                @endforeach
                <form action="{{ route('settings.chatbot.questions.store') }}" method="POST">@csrf <input name="question" placeholder="New question" required><textarea name="answer" placeholder="Answer"></textarea><button>Add question</button></form>
                <form action="{{ route('settings.chatbot.files.store') }}" method="POST" enctype="multipart/form-data">@csrf<label class="chatbot-upload" id="chatbot-upload"><input id="chatbot-file" name="file" type="file" onchange="this.form.submit()"><i class="bi bi-upload"></i><span class="chatbot-upload-label">Upload files</span><span class="chatbot-upload-name" id="chatbot-upload-name"></span></label></form>
                @foreach ($files as $file)<p><a href="{{ asset('storage/'.$file->path) }}" target="_blank">{{ $file->original_name }}</a> <form style="display:inline" action="{{ route('settings.chatbot.files.destroy', $file) }}" method="POST">@csrf @method('DELETE')<button>Delete</button></form></p>@endforeach
            </main>
        </div>
    </section>
    <script>
        document.getElementById('chatbot-file').addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (!file) return;
            document.getElementById('chatbot-upload-name').textContent = file.name;
            document.getElementById('chatbot-upload').classList.add('has-file');
        });
    </script>
@endsection

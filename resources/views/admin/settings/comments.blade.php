@extends('layouts.admin')

@push('page-styles')
    <style>
        .comments-panel {
            min-width: 0;
        }

        .comments-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin: 18px 16px 14px;
        }

        .comments-heading h2 {
            margin: 0;
            color: #292929;
            font-size: 17px;
            font-weight: 600;
        }

        .comments-bulk-actions {
            display: flex;
            align-items: center;
            gap: 27px;
            color: #747474;
            font-size: 12px;
        }

        .comments-select-all {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .comments-select-all input {
            width: 19px;
            height: 19px;
            margin: 0;
            accent-color: #bd8d45;
        }

        .comments-delete {
            display: flex;
            align-items: center;
            gap: 10px;
            border: 0;
            background: transparent;
            color: #df5151;
            font-size: 12px;
            cursor: pointer;
        }

        .comments-delete:disabled {
            opacity: 0.45;
            cursor: not-allowed;
        }

        .comments-delete i {
            font-size: 20px;
        }

        .comments-list {
            display: grid;
            gap: 15px;
        }

        .comment-card {
            position: relative;
            min-height: 150px;
            padding: 12px 35px 12px 55px;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 12px 28px rgba(37, 29, 14, 0.05);
        }

        .comment-card input {
            position: absolute;
            top: 20px;
            left: 28px;
            width: 18px;
            height: 18px;
            margin: 0;
            accent-color: #bd8d45;
        }

        .comment-author {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #444;
            font-size: 16px;
        }

        .comment-author img {
            width: 41px;
            height: 41px;
            border-radius: 50%;
            object-fit: cover;
        }

        .comment-card p {
            max-width: 710px;
            margin: 17px 0 0 56px;
            color: #6f6f6f;
            font-size: 14px;
            line-height: 1.4;
        }

        .comment-menu {
            position: absolute;
            top: 24px;
            right: 22px;
            border: 0;
            background: transparent;
            color: #3d3d3d;
            font-size: 18px;
            cursor: pointer;
        }

        .comments-empty {
            display: none;
            padding: 70px 20px;
            border-radius: 18px;
            background: #fff;
            color: #999;
            font-size: 13px;
            text-align: center;
        }

        /* Laptop / Small Height Screens */
        @media (min-width: 801px) and (max-height: 1100px) {
            .comments-heading {
                margin: 18px 16px 16px;
            }

            .comments-heading h2 {
                font-size: 14px;
            }

            .comments-bulk-actions {
                gap: 20px;
                font-size: 10px;
            }

            .comments-select-all {
                gap: 7px;
            }

            .comments-select-all input {
                width: 16px;
                height: 16px;
            }

            .comments-delete {
                gap: 7px;
                font-size: 10px;
            }

            .comments-delete i {
                font-size: 17px;
            }

            .comments-list {
                gap: 14px;
            }

            .comment-card {
                min-height: 128px;
                padding: 18px 44px 18px 62px;
                border-radius: 14px;
            }

            .comment-card input {
                top: 18px;
                left: 20px;
                width: 15px;
                height: 15px;
            }

            .comment-author {
                gap: 11px;
                font-size: 13px;
            }

            .comment-author img {
                width: 32px;
                height: 32px;
            }

            .comment-card p {
                max-width: 670px;
                margin: 12px 0 0 43px;
                font-size: 11px;
            }

            .comment-menu {
                top: 17px;
                right: 17px;
                font-size: 16px;
            }
        }

        /* Mobile */
        @media (max-width: 620px) {
            .comments-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .comment-card {
                padding-left: 52px;
            }

            .comment-card p {
                margin-left: 0;
            }
        }
    </style>
@endpush

@section('content')
    <section class="settings-page comments-page">

        <h1>Setting</h1>

        <div class="settings-layout">

            @include('admin.settings.partials.sidebar')

            <main class="comments-panel">

                <header class="comments-heading">
                    <h2>Comments Management</h2>

                    <div class="comments-bulk-actions">

                        <label class="comments-select-all">
                            <input
                                id="select-all-comments"
                                type="checkbox"
                            >

                            <span>Select</span>
                        </label>

                        <button
                            class="comments-delete"
                            id="delete-comments"
                            type="submit"
                            form="comments-form"
                            disabled
                        >
                            <i class="bi bi-trash3"></i>
                            Delete
                        </button>

                    </div>
                </header>

                <form id="comments-form" action="{{ route('settings.comments.bulk-destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                <div
                    class="comments-list"
                    id="comments-list"
                >
                    @forelse ($comments as $comment)

                        <article class="comment-card">
                            <input class="comment-checkbox" name="comments[]" value="{{ $comment->id }}" type="checkbox" aria-label="Select comment">

                            <div class="comment-author">
                                <img
                                    src="https://i.pravatar.cc/100?img=47"
                                    alt="{{ $comment->user?->name ?? 'User' }}"
                                >

                                <span>
                                    {{ $comment->user?->name ?? 'Deleted user' }}
                                </span>
                            </div>

                            <p>
                                {{ $comment->body }}
                            </p>

                            <button
                                class="comment-menu"
                                type="button"
                                aria-label="Comment actions"
                            >
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <form action="{{ route('settings.comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Delete this comment?')">
                                @csrf @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>

                        </article>

                    @empty
                        <p class="comments-empty" style="display:block">There are no comments to display.</p>
                    @endforelse
                </div>
                </form>

                <p
                    class="comments-empty"
                    id="comments-empty"
                >
                    There are no comments to display.
                </p>

            </main>
        </div>

    </section>

    <script>
        (() => {
            const selectAll = document.getElementById('select-all-comments');
            const deleteButton = document.getElementById('delete-comments');
            const list = document.getElementById('comments-list');
            const empty = document.getElementById('comments-empty');

            const checkboxes = () => [
                ...document.querySelectorAll('.comment-checkbox')
            ];

            const refresh = () => {
                const boxes = checkboxes();

                const selected = boxes.filter(
                    (box) => box.checked
                );

                deleteButton.disabled = selected.length === 0;

                selectAll.checked =
                    boxes.length > 0 &&
                    selected.length === boxes.length;

                selectAll.indeterminate =
                    selected.length > 0 &&
                    selected.length < boxes.length;
            };

            selectAll.addEventListener('change', () => {
                checkboxes().forEach((box) => {
                    box.checked = selectAll.checked;
                });

                refresh();
            });

            list.addEventListener('change', refresh);

        })();
    </script>
@endsection

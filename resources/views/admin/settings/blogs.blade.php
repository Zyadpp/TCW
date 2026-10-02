```php
@extends('layouts.admin')

@push('page-styles')
    <style>
        .settings-layout-page .blogs-card {
            min-height: 1075px;
            padding: 28px 24px;
            overflow: hidden;
            border-radius: 20px;
            background: #fff;
            box-shadow: 0 12px 34px rgba(37, 29, 14, .045);
        }

        .blogs-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        .blogs-card-header h2 {
            margin: 0;
            color: #292929;
            font-size: 17px;
            font-weight: 600;
        }

        .new-blog-button {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            min-height: 38px;
            padding: 0 16px;
            border: 1px solid #171717;
            border-radius: 21px;
            background: #fff;
            color: #181818;
            font-size: 11px;
            text-decoration: none;
        }

        .new-blog-button i {
            font-size: 16px;
            line-height: 1;
        }

        .blog-filters {
            display: flex;
            gap: 8px;
            margin: 20px 0 24px;
        }

        .blog-filter {
            padding: 7px 13px;
            border: 1px solid #d9d9d9;
            border-radius: 18px;
            background: #fff;
            color: #b3b3b3;
            font-size: 10px;
            line-height: 1;
        }

        .blog-filter.active {
            border-color: #f2e8d8;
            background: #f2e8d8;
            color: #bb8b45;
        }

        .blogs-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 17px 18px;
        }

        .blogs-empty {
            display: none;
            grid-column: 1 / -1;
            padding: 42px 18px;
            border-radius: 14px;
            background: #fafafa;
            color: #999;
            font-size: 12px;
            text-align: center;
        }

        .blog-item {
            min-width: 0;
            min-height: 176px;
            padding: 17px 16px 0;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 12px 28px rgba(37, 29, 14, .055);
        }

        .blog-item-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            height: 25px;
        }

        .blog-status {
            padding: 5px 11px;
            border-radius: 14px;
            background: #dcebe5;
            color: #43866e;
            font-size: 8px;
            line-height: 1;
        }

        .blog-status.paused {
            background: #f7dddd;
            color: #d96565;
        }

        .blog-actions {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #383838;
        }

        .blog-actions button {
            padding: 0;
            border: 0;
            background: transparent;
            color: inherit;
            font-size: 17px;
            line-height: 1;
        }

        .blog-actions .pin {
            color: #bd8d45;
            font-size: 15px;
        }

        .blog-item-main {
            display: grid;
            grid-template-columns: 99px minmax(0, 1fr);
            gap: 16px;
            margin-top: 10px;
        }

        .blog-item-main img {
            width: 99px;
            height: 101px;
            border-radius: 8px;
            object-fit: cover;
        }

        .blog-item h3 {
            margin: 3px 0 7px;
            color: #151515;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.35;
        }

        .blog-item p {
            display: -webkit-box;
            overflow: hidden;
            margin: 0;
            color: #7d899e;
            font-size: 11px;
            line-height: 1.28;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
        }

        .blog-author {
            margin: 8px 0 0 115px;
            color: #39725f;
            font-size: 8px;
        }

        @media (min-width: 801px) and (max-height: 1100px) {
            .settings-layout-page .blogs-card {
                min-height: 0;
                height: calc(100vh - 80px);
                padding: 18px 16px;
            }

            .blogs-card-header h2 {
                font-size: 14px;
            }

            .new-blog-button {
                min-height: 31px;
                padding: 0 12px;
                font-size: 10px;
            }

            .blog-filters {
                margin: 13px 0 16px;
            }

            .blog-filter {
                padding: 6px 11px;
                font-size: 9px;
            }

            .blogs-grid {
                gap: 13px 15px;
            }

            .blog-item {
                min-height: 144px;
                padding: 12px 13px 0;
                border-radius: 14px;
            }

            .blog-item-top {
                height: 20px;
            }

            .blog-status {
                padding: 4px 9px;
                font-size: 7px;
            }

            .blog-item-main {
                grid-template-columns: 79px minmax(0, 1fr);
                gap: 12px;
                margin-top: 7px;
            }

            .blog-item-main img {
                width: 79px;
                height: 82px;
            }

            .blog-item h3 {
                margin: 2px 0 5px;
                font-size: 11px;
            }

            .blog-item p {
                font-size: 9px;
            }

            .blog-author {
                margin: 5px 0 0 91px;
                font-size: 7px;
            }
        }

        @media (max-width: 800px) {
            .settings-layout-page .blogs-card {
                min-height: 0;
                padding: 20px 16px;
            }
        }

        @media (max-width: 570px) {
            .blogs-card-header {
                align-items: flex-start;
            }

            .blogs-grid {
                grid-template-columns: 1fr;
            }
        }


        /* =========================================================
           DRAWER
           ========================================================= */

        .blog-drawer-overlay {
            position: fixed;
            z-index: 9998;
            inset: 0;
            background: rgba(0, 0, 0, .22);
            opacity: 0;
            visibility: hidden;
            transition: opacity .25s, visibility .25s;
        }

        .blog-drawer-overlay.is-open {
            opacity: 1;
            visibility: visible;
        }

        .blog-drawer {
            position: fixed;
            z-index: 9999;
            top: 0;
            right: -480px;

            display: flex;
            flex-direction: column;

            width: 380px;
            max-width: 100%;
            height: 100vh;

            /* طھظ… طھظ‚ظ„ظٹظ„ ط§ظ„ظ…ط³ط§ظپط§طھ ط§ظ„ط®ط§ط±ط¬ظٹط© */
            padding: 20px 26px 20px;

            background: #fff;
            box-shadow: -8px 0 28px rgba(0, 0, 0, .08);

            transition: right .3s ease;
        }

        .blog-drawer.is-open {
            right: 0;
        }

        .blog-drawer h2 {
            margin: 0 0 18px;
            color: #252525;
            font-size: 22px;
            font-weight: 600;
        }

        /* طµظˆط±ط© ط§ظ„ظ€ Cover */
        .blog-cover-input {
            display: block;
            position: relative;

            height: 125px;

            margin-bottom: 12px;

            border: 1px solid #ededed;
            border-radius: 8px;

            cursor: pointer;
            overflow: hidden;
        }

        .blog-cover-input input {
            position: absolute;
            width: 1px;
            height: 1px;
            opacity: 0;
        }

        .blog-cover-placeholder {
            display: grid;
            height: 100%;
            place-content: center;
            gap: 8px;

            color: #7d899e;
            font-size: 11px;
            text-align: center;
        }

        .blog-cover-placeholder i {
            font-size: 19px;
            line-height: 1;
        }

        .blog-cover-input img {
            display: none;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .blog-cover-input.has-image .blog-cover-placeholder {
            display: none;
        }

        .blog-cover-input.has-image img {
            display: block;
        }

        /* ط­ظ‚ظˆظ„ ط§ظ„ظ€ Drawer */
        .blog-drawer-field {
            display: block;
            margin-bottom: 10px;
        }

        .blog-drawer-field > span {
            display: block;
            margin: 0 0 5px;

            color: #1e1e1e;
            font-size: 11px;
        }

        .blog-drawer-field input,
        .blog-drawer-field select,
        .blog-drawer-field textarea {
            width: 100%;

            border: 1px solid #ededed;
            border-radius: 8px;

            background: #fff;
            color: #475568;

            font: inherit;
            font-size: 11px;

            outline: none;
        }

        /* ط§ط±طھظپط§ط¹ ط­ظ‚ظˆظ„ Input ظˆ Select */
        .blog-drawer-field input,
        .blog-drawer-field select {
            height: 35px;
            padding: 0 10px;
        }

        /* ط§ط±طھظپط§ط¹ ط®ط§ظ†ط© ط§ظ„ظ€ Overview */
        .blog-drawer-field textarea {
            height: 75px;
            padding: 10px 12px;

            line-height: 1.5;
            resize: none;
        }

        .blog-drawer-field input:focus,
        .blog-drawer-field select:focus,
        .blog-drawer-field textarea:focus {
            border-color: #bd8d45;
            box-shadow: 0 0 0 3px rgba(189, 141, 69, .09);
        }

        .blog-date-field {
            position: relative;
        }

        .blog-date-field i {
            position: absolute;
            top: 34px;
            left: 14px;

            color: #7d899e;
            font-size: 13px;

            pointer-events: none;
        }

        .blog-date-field input {
            padding-left: 35px;
        }

        /* ط£ط²ط±ط§ط± ط§ظ„ظ€ Drawer */
        .blog-drawer-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;

            gap: 12px;

            margin-top: auto;
            padding-top: 8px;
        }

        .blog-drawer-actions button {
            height: 36px;

            border-radius: 21px;

            font-size: 11px;
            cursor: pointer;
        }

        .blog-cancel {
            border: 1px solid #a3a3a3;
            background: #fff;
            color: #969696;
        }

        .blog-save {
            border: 1px solid #000;
            background: #000;
            color: #fff;
        }

        @media (max-width: 520px) {
            .blog-drawer {
                padding: 20px 18px;
            }

            .blog-drawer h2 {
                margin-bottom: 16px;
            }

            .blog-cover-input {
                height: 115px;
            }
        }
    </style>
@endpush


@section('content')

    <section class="settings-page blogs-page">

        <h1>Setting</h1>

        <div class="settings-layout">

            @include('admin.settings.partials.sidebar')

            <main class="blogs-card">

                <header class="blogs-card-header">
                    <h2>Blogs</h2>

                    <button
                        class="new-blog-button"
                        id="open-blog-drawer"
                        type="button"
                    >
                        <i class="bi bi-plus"></i>
                        New Blog
                    </button>
                </header>


                <div class="blog-filters" aria-label="Blog status filters">

                    <button class="blog-filter active" type="button" data-filter="all">
                        All
                    </button>

                    <button class="blog-filter" type="button" data-filter="published">
                        Published
                    </button>

                    <button class="blog-filter" type="button" data-filter="paused">
                        Paused
                    </button>

                </div>


                @php

                    $blogCards = [

                        [
                            'status' => 'Published',
                            'image' => 'photo-1544717305-2782549b5136',
                            'title' => 'Launch of Our First Training Programmes!',
                            'description' => 'We are proud to introduce the first set of interactive training Programmes on TCW..',
                            'pinned' => true
                        ],

                        [
                            'status' => 'Published',
                            'image' => 'photo-1544717305-2782549b5136',
                            'title' => 'Launch of Our First Training Programmes!',
                            'description' => 'We are proud to introduce the first set of interactive training Programmes on TCW..',
                            'pinned' => true
                        ],

                        [
                            'status' => 'Published',
                            'image' => 'photo-1544717305-2782549b5136',
                            'title' => 'Launch of Our First Training Programmes!',
                            'description' => 'We are proud to introduce the first set of interactive training Programmes on TCW..',
                            'pinned' => true
                        ],

                        [
                            'status' => 'Published',
                            'image' => 'photo-1544717305-2782549b5136',
                            'title' => 'Launch of Our First Training Programmes!',
                            'description' => 'We are proud to introduce the first set of interactive training Programmes on TCW..',
                            'pinned' => true
                        ],

                        [
                            'status' => 'Paused',
                            'image' => 'photo-1499750310107-5fef28a66643',
                            'title' => 'Personalized Programmes for Your Level!',
                            'description' => 'With TCWâ€™s smart learning system, you can now choose Programmes based on ..',
                            'pinned' => false
                        ],

                        [
                            'status' => 'Paused',
                            'image' => 'photo-1499750310107-5fef28a66643',
                            'title' => 'Personalized Programmes for Your Level!',
                            'description' => 'With TCWâ€™s smart learning system, you can now choose Programmes based on ..',
                            'pinned' => false
                        ],

                    ];

                @endphp


                <div class="blogs-grid">

                    @foreach (($blogs->isNotEmpty() ? $blogs->map(fn ($item) => ['status' => $item->status, 'image' => $item->cover_image ?: 'photo-1544717305-2782549b5136', 'title' => $item->title, 'description' => $item->overview, 'pinned' => $item->is_pinned])->all() : $blogCards) as $blog)

                        <article class="blog-item" data-status="{{ strtolower($blog['status']) }}">

                            <div class="blog-item-top">

                                <span
                                    class="blog-status {{ strtolower($blog['status']) === 'paused' ? 'paused' : '' }}"
                                >
                                    {{ $blog['status'] }}
                                </span>

                                <div class="blog-actions">

                                    @if ($blog['pinned'])

                                        <button
                                            class="pin"
                                            type="button"
                                            aria-label="Pinned blog"
                                        >
                                            <i class="bi bi-pin-angle"></i>
                                        </button>

                                    @endif

                                    <button
                                        type="button"
                                        aria-label="Blog actions"
                                    >
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>

                                </div>

                            </div>


                            <div class="blog-item-main">

                                <img
                                    src="{{ str_starts_with($blog['image'], 'blogs/') ? asset('storage/' . $blog['image']) : 'https://images.unsplash.com/' . $blog['image'] . '?auto=format&fit=crop&w=250&q=85' }}"
                                    alt=""
                                >

                                <div>

                                    <h3>
                                        {{ $blog['title'] }}
                                    </h3>

                                    <p>
                                        {{ $blog['description'] }}
                                    </p>

                                </div>

                            </div>


                            <div class="blog-author">
                                By : Ahmed Mohamed
                            </div>

                        </article>

                    @endforeach

                    <p class="blogs-empty" id="blogs-empty">No blogs found for this status.</p>

                </div>

            </main>


            <!-- Drawer Overlay -->
            <div
                class="blog-drawer-overlay"
                id="blog-drawer-overlay"
            ></div>


            <!-- Drawer -->
            <aside
                class="blog-drawer"
                id="blog-drawer"
                aria-hidden="true"
                aria-labelledby="new-blog-heading"
            >

                <h2 id="new-blog-heading">
                    New Blog
                </h2>


                <form
                    id="new-blog-form"
                    class="d-flex flex-column h-100"
                    action="{{ route('settings.blogs.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf

                    <!-- Blog Cover -->
                    <label
                        class="blog-cover-input"
                        id="blog-cover-input"
                    >

                        <input
                            id="blog-cover-file"
                            name="cover"
                            type="file"
                            accept="image/*"
                        >

                        <span class="blog-cover-placeholder">
                            <i class="bi bi-upload"></i>
                            Upload Blog Cover
                        </span>

                        <img
                            id="blog-cover-preview"
                            alt="Blog cover preview"
                        >

                    </label>


                    <!-- Creation Date -->
                    <label class="blog-drawer-field blog-date-field">

                        <span>
                            Creation date
                        </span>

                        <i class="bi bi-calendar3"></i>

                        <input
                            type="date"
                            name="published_at"
                            aria-label="Creation date"
                        >

                    </label>


                    <!-- Blog Title -->
                    <label class="blog-drawer-field">

                        <span>
                            Blog title
                        </span>

                        <input
                            type="text"
                            name="title"
                            placeholder="JSX and Rendering"
                        >

                    </label>


                    <!-- Blog Status -->
                    <label class="blog-drawer-field">

                        <span>
                            Blog status
                        </span>

                        <select name="status">

                            <option>
                                Published
                            </option>

                            <option>
                                Paused
                            </option>

                        </select>

                    </label>


                    <!-- Blog Overview -->
                    <label class="blog-drawer-field">

                        <span>
                            Blog overview
                        </span>

                        <textarea name="overview"
                            placeholder="Lorem ipsum dolor sit amet consectetur. A in at tellus integer arcu facilisi mauris."
                        ></textarea>

                    </label>


                    <!-- Drawer Actions -->
                    <div class="blog-drawer-actions">

                        <button
                            class="blog-cancel"
                            type="button"
                            data-close-blog-drawer
                        >
                            Cancel
                        </button>

                        <button
                            class="blog-save"
                            type="submit"
                        >
                            Save
                        </button>

                    </div>

                </form>

            </aside>

        </div>

    </section>


    <script>
        (() => {

            const drawer =
                document.getElementById('blog-drawer');

            const filters = document.querySelectorAll('.blog-filter');
            const blogCards = document.querySelectorAll('.blog-item');
            const emptyBlogs = document.getElementById('blogs-empty');

            filters.forEach((filter) => {
                filter.addEventListener('click', () => {
                    filters.forEach((item) => item.classList.remove('active'));
                    filter.classList.add('active');
                    let visibleCount = 0;

                    blogCards.forEach((card) => {
                        const visible = filter.dataset.filter === 'all' || card.dataset.status === filter.dataset.filter;
                        card.hidden = !visible;
                        if (visible) visibleCount++;
                    });

                    emptyBlogs.style.display = visibleCount ? 'none' : 'block';
                });
            });

            const overlay =
                document.getElementById('blog-drawer-overlay');

            const openButton =
                document.getElementById('open-blog-drawer');

            const fileInput =
                document.getElementById('blog-cover-file');

            const preview =
                document.getElementById('blog-cover-preview');

            const cover =
                document.getElementById('blog-cover-input');


            const close = () => {

                drawer.classList.remove('is-open');

                overlay.classList.remove('is-open');

                drawer.setAttribute(
                    'aria-hidden',
                    'true'
                );

            };


            openButton.addEventListener('click', () => {

                drawer.classList.add('is-open');

                overlay.classList.add('is-open');

                drawer.setAttribute(
                    'aria-hidden',
                    'false'
                );

            });


            overlay.addEventListener(
                'click',
                close
            );


            document
                .querySelector('[data-close-blog-drawer]')
                .addEventListener(
                    'click',
                    close
                );


            document.addEventListener(
                'keydown',
                (event) => {

                    if (event.key === 'Escape') {
                        close();
                    }

                }
            );


            fileInput.addEventListener(
                'change',
                () => {

                    const file =
                        fileInput.files[0];

                    if (!file) {
                        return;
                    }

                    preview.src =
                        URL.createObjectURL(file);

                    cover.classList.add(
                        'has-image'
                    );

                }
            );


        })();
    </script>

@endsection
```

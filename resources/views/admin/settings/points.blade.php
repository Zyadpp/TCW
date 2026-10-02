```blade
@extends('layouts.admin')

@push('page-styles')
    <style>
        /* =========================
           Main Points Card
        ========================== */

        .points-card {
            height: 100%;
            overflow: hidden;
            border-radius: 20px;
            background: #fff;
            box-shadow: 0 12px 34px rgba(37, 29, 14, .045);
            padding: 28px 24px;
        }

        .points-header,
        .points-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .points-header {
            margin-bottom: 30px;
        }

        .points-header h2,
        .points-section-header h2,
        .points-history h2 {
            margin: 0;
            color: #2d2d2d;
            font-size: 17px;
            font-weight: 600;
        }

        .points-new-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 37px;
            padding: 0 15px;
            border: 1px solid #171717;
            border-radius: 20px;
            background: #fff;
            color: #1e1e1e;
            font-size: 11px;
        }


        /* =========================
           Section Header
        ========================== */

        .points-section-header {
            margin-bottom: 16px;
        }

        .points-section-header h2 span {
            color: #43866e;
        }


        /* =========================
           Carousel Controls
        ========================== */

        .points-carousel-controls {
            display: flex;
            gap: 10px;
        }

        .points-carousel-controls button {
            width: 24px;
            height: 24px;
            border: 1px solid #bcbcbc;
            border-radius: 50%;
            background: #fff;
            color: #999;
            font-size: 12px;
        }

        .points-carousel-controls button:last-child {
            border-color: #111;
            background: #111;
            color: #fff;
        }


        /* =========================
           Points / Rewards Grid
        ========================== */

        .points-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .points-grid + .points-section-header {
            margin-top: 38px;
        }


        /* =========================
           Points / Rewards Cards
        ========================== */

        .points-action-card {
            position: relative;
            display: flex;
            align-items: flex-start;
            gap: 14px;
            min-height: 118px;
            padding: 23px;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 11px 25px rgba(37, 29, 14, .055);
        }

        .points-action-card > i {
            width: 40px;
            height: 40px;
            display: grid;
            flex: 0 0 auto;
            place-items: center;
            border-radius: 50%;
            background: #f3eadc;
            color: #bd9147;
            font-size: 18px;
        }

        .points-action-card h3 {
            max-width: 235px;
            margin: 1px 0 8px;
            color: #1f1f1f;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.55;
        }

        .points-action-card p {
            margin: 0;
            color: #bd8d45;
            font-size: 12px;
            font-weight: 500;
        }

        .points-action-card > button {
            position: absolute;
            top: 17px;
            right: 18px;
            border: 0;
            background: transparent;
            color: #333;
            font-size: 18px;
        }


        /* =========================
           Transaction History
        ========================== */

        .points-history {
            margin-top: 35px;
        }

        .points-history h2 {
            margin-bottom: 25px;
        }

        .points-table {
            width: 100%;
            border-collapse: collapse;
        }

        .points-table th {
            padding: 0 0 18px;
            color: #353535;
            font-size: 7px;
            font-weight: 500;
            text-align: left;
        }

        .points-table td {
            padding: 9px 0;
            color: #333;
            font-size: 10px;
            vertical-align: middle;
        }


        /* =========================
           User Information
        ========================== */

        .points-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .points-user img {
            width: 27px;
            height: 27px;
            border-radius: 50%;
            object-fit: cover;
        }

        .points-user strong,
        .points-user small {
            display: block;
        }

        .points-user strong {
            font-size: 12px;
        }

        .points-user small {
            margin-top: 2px;
            color: #777;
            font-size: 9px;
        }

        .points-value.negative {
            color: #dd6464;
        }

        .points-value.positive {
            color: #bd8d45;
        }

        .points-more {
            border: 0;
            background: transparent;
            color: #333;
            font-size: 17px;
        }


        /* =========================
           New Action Drawer
        ========================== */

        .action-drawer-overlay {
            position: fixed;
            z-index: 1000;
            inset: 0;
            visibility: hidden;
            background: rgba(0, 0, 0, .22);
            opacity: 0;
            transition: opacity .2s, visibility .2s;
        }

        .action-drawer {
            position: fixed;
            z-index: 1001;
            top: 0;
            right: 0;

            /* =========================
               ط§ظ„طھط­ظƒظ… ظپظٹ ط¹ط±ط¶ New Action
               ط؛ظٹظ‘ط± 460px ظ„ظ„ط¹ط±ط¶ ط§ظ„ط°ظٹ طھط±ظٹط¯ظ‡
            ========================== */

            width: min(460px, 100%);

            height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 34px 32px 40px;
            transform: translateX(100%);
            background: #fff;
            transition: transform .25s ease;
        }

        .action-drawer.is-open {
            transform: translateX(0);
        }

        .action-drawer-overlay.is-open {
            visibility: visible;
            opacity: 1;
        }

        .action-drawer h2 {
            margin: 0 0 32px;
            color: #262626;
            font-size: 25px;
            font-weight: 600;
        }


        /* =========================
           New Action Form
        ========================== */

        .action-drawer-form {
            display: flex;
            flex: 1;
            min-height: 0;
            flex-direction: column;
        }

        .action-drawer-field {
            display: grid;
            gap: 10px;
            margin-bottom: 18px;
            color: #1f1f1f;
            font-size: 13px;
        }

        .action-drawer-field input,
        .action-drawer-field select,
        .action-drawer-field textarea {
            width: 100%;
            border: 1px solid #eeeeee;
            border-radius: 9px;
            outline: 0;
            color: #444;
            font-size: 12px;
        }

        .action-drawer-field input,
        .action-drawer-field select {
            height: 46px;
            padding: 0 12px;
        }

        .action-drawer-field textarea {
            height: 120px;
            padding: 13px 12px;
            resize: none;
        }


        /* =========================
           Active Switch
        ========================== */

        .action-drawer-switch {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-top: 1px;
            color: #171717;
            font-size: 13px;
            line-height: 1.45;
        }

        .action-drawer-switch input {
            position: relative;
            width: 49px;
            height: 25px;
            flex: 0 0 auto;
            margin: 0;
            appearance: none;
            border-radius: 20px;
            background: #eadfc9;
        }

        .action-drawer-switch input::after {
            position: absolute;
            top: 1px;
            left: 1px;
            width: 23px;
            height: 23px;
            border-radius: 50%;
            background: #fff;
            content: '';
            transition: .2s;
        }

        .action-drawer-switch input:checked::after {
            left: 25px;
            background: #bd9147;
        }


        /* =========================
           Drawer Buttons
        ========================== */

        .action-drawer-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-top: auto;
        }

        .action-drawer-actions button {
            height: 38px;
            border-radius: 21px;
            font-size: 12px;
        }

        .action-drawer-cancel {
            border: 1px solid #a8a8a8;
            background: #fff;
            color: #999;
        }

        .action-drawer-save {
            border: 0;
            background: #bd9147;
            color: #fff;
        }


        /* =========================
           Responsive - Small Height
        ========================== */

        @media (min-width: 801px) and (max-height: 1100px) {

            .points-card {
                padding: 14px 18px;
            }

            .points-header {
                margin-bottom: 12px;
            }

            .points-header h2,
            .points-section-header h2,
            .points-history h2 {
                font-size: 13px;
            }

            .points-new-action {
                min-height: 28px;
                padding: 0 11px;
                font-size: 9px;
            }

            .points-section-header {
                margin-bottom: 8px;
            }

            .points-carousel-controls {
                gap: 6px;
            }

            .points-carousel-controls button {
                width: 19px;
                height: 19px;
                font-size: 9px;
            }

            .points-grid {
                gap: 10px;
            }

            .points-grid + .points-section-header {
                margin-top: 14px;
            }

            .points-action-card {
                min-height: 70px;
                gap: 9px;
                padding: 13px;
                border-radius: 12px;
            }

            .points-action-card > i {
                width: 29px;
                height: 29px;
                font-size: 13px;
            }

            .points-action-card h3 {
                margin: 0 0 4px;
                font-size: 10px;
            }

            .points-action-card p {
                font-size: 9px;
            }

            .points-action-card > button {
                top: 7px;
                right: 9px;
                font-size: 14px;
            }

            .points-history {
                margin-top: 17px;
            }

            .points-history h2 {
                margin-bottom: 12px;
            }

            .points-table th {
                padding-bottom: 8px;
                font-size: 6px;
            }

            .points-table td {
                padding: 4px 0;
                font-size: 8px;
            }

            .points-user {
                gap: 6px;
            }

            .points-user img {
                width: 20px;
                height: 20px;
            }

            .points-user strong {
                font-size: 9px;
            }

            .points-user small {
                font-size: 7px;
            }

            .points-more {
                font-size: 13px;
            }

            .action-drawer {
                padding: 24px 25px 26px;
            }

            .action-drawer h2 {
                margin-bottom: 20px;
                font-size: 20px;
            }

            .action-drawer-field {
                gap: 6px;
                margin-bottom: 10px;
                font-size: 10px;
            }

            .action-drawer-field input,
            .action-drawer-field select {
                height: 32px;
                font-size: 10px;
            }

            .action-drawer-field textarea {
                height: 68px;
                padding: 9px;
                font-size: 10px;
            }

            .action-drawer-switch {
                font-size: 10px;
            }

            .action-drawer-actions button {
                height: 30px;
                font-size: 10px;
            }
        }
    </style>
@endpush


@section('content')

    @php

        /* =========================
           Points
        ========================== */

        $points = $pointActions->isNotEmpty() ? $pointActions->map(fn ($action) => [
                'bi-broadcast', $action->title, '+' . $action->points . ' Points Per Session'
            ])->all() : [
            [
                'bi-broadcast',
                'Live session attendance',
                '+10 Points Per Session'
            ],
            [
                'bi-qr-code',
                'Social interaction (like, comment, share)',
                '+2 Points Per Interaction'
            ],
        ];


        /* =========================
           Rewards
        ========================== */

        $rewards = $rewardActions->isNotEmpty() ? $rewardActions->map(fn ($action) => [
                'bi-patch-check', $action->title, $action->points . ' POINTS'
            ])->all() : [
            [
                'bi-patch-check',
                '10% Discount on Programme Subscription',
                '100 POINTS'
            ],
            [
                'bi-unlock',
                'Unlock a Free Course',
                '500 POINTS'
            ],
        ];


        /* =========================
           Transactions
        ========================== */

        $transactions = [
            ['1/2/2025', '-50', 'Discount 5%'],
            ['1/2/2025', '+10', 'Add Comment'],
            ['1/8/2024', '+10', 'Create Reel'],
            ['1/2/2025', '+10', 'Create Reel'],
            ['1/2/2025', '+10', 'Create Reel'],
        ];

    @endphp


    <!-- =========================
         Settings Page
    ========================== -->

    <section class="settings-page points-page">

        <h1>Setting</h1>

        <div class="settings-layout">

            <!-- Settings Sidebar -->
            @include('admin.settings.partials.sidebar')


            <!-- =========================
                 Points & Rewards
            ========================== -->

            <section class="points-card">

                <!-- Header -->

                <header class="points-header">

                    <h2>
                        Points &amp; Rewards
                    </h2>

                    <button
                        class="points-new-action"
                        id="openActionDrawer"
                        type="button"
                    >
                        <i class="bi bi-plus-lg"></i>
                        New Action
                    </button>

                </header>


                <!-- =========================
                     Points & Rewards Sections
                ========================== -->

                @foreach (['Points' => $points, 'Rewards' => $rewards] as $title => $items)

                    <section>

                        <!-- Section Header -->

                        <div class="points-section-header">

                            <h2>
                                {{ $title }}

                                <span>
                                    ({{ count($items) }})
                                </span>
                            </h2>


                            <!-- Carousel Controls -->

                            <div class="points-carousel-controls">

                                <button type="button">
                                    <i class="bi bi-chevron-left"></i>
                                </button>

                                <button type="button">
                                    <i class="bi bi-chevron-right"></i>
                                </button>

                            </div>

                        </div>


                        <!-- Cards Grid -->

                        <div class="points-grid">

                            @foreach ($items as [$icon, $heading, $value])

                                <article class="points-action-card">

                                    <i class="bi {{ $icon }}"></i>

                                    <div>

                                        <h3>
                                            {{ $heading }}
                                        </h3>

                                        <p>
                                            {{ $value }}
                                        </p>

                                    </div>


                                    <!-- More Button -->

                                    <button
                                        type="button"
                                        aria-label="More actions"
                                    >
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>

                                </article>

                            @endforeach

                        </div>

                    </section>

                @endforeach


                <!-- =========================
                     Transaction History
                ========================== -->

                <section class="points-history">

                    <h2>
                        Transaction History
                    </h2>


                    <table class="points-table">

                        <thead>

                            <tr>
                                <th>DATE</th>
                                <th>USER NAME</th>
                                <th>POINTS ADDED/DEDUCTED</th>
                                <th>TRANSACTION REASON</th>
                                <th>ACTIONS</th>
                            </tr>

                        </thead>


                        <tbody>

                            @foreach ($transactions as [$date, $value, $reason])

                                <tr>

                                    <!-- Date -->

                                    <td>
                                        {{ $date }}
                                    </td>


                                    <!-- User -->

                                    <td>

                                        <div class="points-user">

                                            <img
                                                src="https://i.pravatar.cc/40?img=12"
                                                alt=""
                                            >

                                            <span>

                                                <strong>
                                                    Ahmed Ali
                                                </strong>

                                                <small>
                                                    Ahmed@gmail.com
                                                </small>

                                            </span>

                                        </div>

                                    </td>


                                    <!-- Points -->

                                    <td>

                                        <span
                                            class="points-value {{ str_starts_with($value, '-') ? 'negative' : 'positive' }}"
                                        >
                                            {{ $value }}
                                        </span>

                                    </td>


                                    <!-- Reason -->

                                    <td>
                                        {{ $reason }}
                                    </td>


                                    <!-- Actions -->

                                    <td>

                                        <button
                                            class="points-more"
                                            type="button"
                                        >
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </section>

            </section>

        </div>

    </section>


    <!-- =========================
         New Action Overlay
    ========================== -->

    <div
        class="action-drawer-overlay"
        id="actionDrawerOverlay"
    ></div>


    <!-- =========================
         New Action Drawer
    ========================== -->

    <aside
        class="action-drawer"
        id="actionDrawer"
        aria-hidden="true"
        aria-labelledby="actionDrawerTitle"
    >

        <h2 id="actionDrawerTitle">
            New Action
        </h2>


        <form
            class="action-drawer-form"
            id="newActionForm"
            action="{{ route('settings.actions.store') }}"
            method="POST"
        >
            @csrf

            <!-- Action Type -->

            <label class="action-drawer-field">

                Action type

                <select id="actionType" name="type">
                    <option value="reward" selected>Reward</option>
                    <option value="points">Points</option>

                </select>

            </label>


            <!-- Action Title -->

            <label class="action-drawer-field">

                Action title

                <input
                    type="text"
                    id="actionTitle" name="title"
                    placeholder="20% Discount on a Design Programme"
                >

            </label>


            <!-- Description -->

            <label class="action-drawer-field">

                Description

                <textarea
                    name="description" placeholder="Lorem ipsum dolor sit amet consectetur. A in at tellus integer arcu facilisi mauris."
                ></textarea>

            </label>


            <!-- Points -->

            <label class="action-drawer-field">

                <span id="actionPointsLabel">How many points does the user need to redeem this reward?</span>

                <input
                    type="number"
                    min="0"
                    id="actionPoints" name="points"
                    placeholder="100 Points"
                >

            </label>


            <!-- Multiple Times -->

            <label class="action-drawer-field">

                <span id="actionLimitationsLabel">limitations</span>

                <select id="actionLimitations" name="limitations">
                    <option>First 50 people only</option>
                    <option>Once per user</option>
                    <option>No limitations</option>

                </select>

            </label>


            <!-- Active Switch -->

            <label class="action-drawer-switch">

                <span>
                    Should this action be active immediately after saving?
                </span>

                <input
                    type="checkbox" name="is_active" value="1"
                    checked
                >

            </label>


            <!-- Buttons -->

            <div class="action-drawer-actions">

                <button
                    class="action-drawer-cancel"
                    id="cancelActionDrawer"
                    type="button"
                >
                    Cancel
                </button>

                <button
                    class="action-drawer-save"
                    type="submit"
                >
                    Save
                </button>

            </div>

        </form>

    </aside>


    <!-- =========================
         JavaScript
    ========================== -->

    <script>

        const actionDrawer =
            document.getElementById('actionDrawer');

        const actionDrawerOverlay =
            document.getElementById('actionDrawerOverlay');


        /* =========================
           Open / Close Drawer
        ========================== */

        const toggleActionDrawer = (isOpen) => {

            actionDrawer.classList.toggle(
                'is-open',
                isOpen
            );

            actionDrawerOverlay.classList.toggle(
                'is-open',
                isOpen
            );

            actionDrawer.setAttribute(
                'aria-hidden',
                String(!isOpen)
            );

        };


        /* =========================
           Open Drawer
        ========================== */

        document
            .getElementById('openActionDrawer')
            .addEventListener('click', () => {

                toggleActionDrawer(true);

            });


        /* =========================
           Cancel
        ========================== */

        document
            .getElementById('cancelActionDrawer')
            .addEventListener('click', () => {

                toggleActionDrawer(false);

            });


        /* =========================
           Click Overlay
        ========================== */

        actionDrawerOverlay.addEventListener(
            'click',
            () => {

                toggleActionDrawer(false);

            }
        );

        /* Switch the last two fields between a points action and a reward. */
        const actionType = document.getElementById('actionType');
        const actionPointsLabel = document.getElementById('actionPointsLabel');
        const actionLimitationsLabel = document.getElementById('actionLimitationsLabel');
        const actionLimitations = document.getElementById('actionLimitations');
        const actionTitle = document.getElementById('actionTitle');

        const updateActionType = () => {
            const isReward = actionType.value === 'reward';

            actionPointsLabel.textContent = isReward
                ? 'How many points does the user need to redeem this reward?'
                : 'How many points does the user earn from this action?';
            actionLimitationsLabel.textContent = isReward
                ? 'limitations'
                : 'Can the user do this action multiple times to earn points again?';
            actionTitle.placeholder = isReward
                ? '20% Discount on a Design Programme'
                : 'Daily Login';
            actionLimitations.innerHTML = isReward
                ? '<option>First 50 people only</option><option>Once per user</option><option>No limitations</option>'
                : '<option>Yes</option><option>No</option>';
        };

        actionType.addEventListener('change', updateActionType);
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') toggleActionDrawer(false);
        });


        /* =========================
           Form Submit
        ========================== */

        document
            .getElementById('newActionForm')
            .addEventListener('submit', (event) => {

                // Allow Laravel to validate and save the action.

            });

    </script>

@endsection
```

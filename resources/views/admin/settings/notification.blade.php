@extends('layouts.admin')

@push('page-styles')
<style>
    .notification-card {
        min-height: 1075px;
        overflow: hidden;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 12px 34px rgba(37, 29, 14, .045);
    }

    .notification-card>h2 {
        margin: 0;
        padding: 29px 24px 23px;
        color: #292929;
        font-size: 17px;
        font-weight: 600;
    }

    .notification-group {
        border-top: 1px solid #eeeeee;
    }

    .notification-group h3 {
        margin: 0;
        padding: 15px 25px;
        color: #161616;
        font-size: 15px;
        font-weight: 500;
    }

    .notification-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-height: 63px;
        padding: 0 23px 0 26px;
        border-top: 1px solid #eeeeee;
        color: #454545;
        font-size: 12px;
        cursor: pointer;
    }

    .notification-item input {
        position: relative;
        width: 48px;
        height: 24px;
        margin: 0;
        appearance: none;
        border-radius: 20px;
        background: #eee5d5;
        cursor: pointer;
        transition: .2s;
    }

    .notification-item input::after {
        position: absolute;
        top: 1px;
        left: 1px;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #fff;
        content: '';
        transition: .2s;
    }

    .notification-item input:checked {
        background: #e7d9bd;
    }

    .notification-item input:checked::after {
        left: 25px;
        background: #bd9147;
    }

    @media (min-width: 801px) and (max-height: 1100px) {
        .settings-layout-page .notification-card {
            min-height: 0;
            height: calc(100vh - 80px);
        }

        .notification-card>h2 {
            padding: 14px 18px 11px;
            font-size: 13px;
        }

        .notification-group h3 {
            padding: 8px 18px;
            font-size: 12px;
        }

        .notification-item {
            min-height: 39px;
            padding: 0 17px 0 19px;
            font-size: 10px;
        }

        .notification-item input {
            width: 38px;
            height: 19px;
        }

        .notification-item input::after {
            width: 17px;
            height: 17px;
        }

        .notification-item input:checked::after {
            left: 20px;
        }

    }
</style>
@endpush

@section('content')
<section class="settings-page notification-page">
    <h1>Setting</h1>

    <div class="settings-layout">
        @include('admin.settings.partials.sidebar')

        <section class="notification-card" aria-labelledby="notification-title">
            <h2 id="notification-title">Notification</h2>

            <form action="{{ route('settings.notification.update') }}" method="POST">@csrf @method('PUT')
                @foreach ([
                'Account Notifications' => ['Account Activation', 'Password Reset', 'Login from a New Device'],
                'Programme Notifications' => ['New Programme Added', 'Programme Enrollment Confirmation', 'Programme Completion'],
                'Payment Notifications' => ['Successful Payment', 'Subscription Expiration Reminder'],
                ] as $group => $notifications)
                <section class="notification-group">
                    <h3>{{ $group }}</h3>
                    @foreach ($notifications as $notification)
                    <label class="notification-item">
                        <span>{{ $notification }}</span>
                        @php($key = \Illuminate\Support\Str::slug($notification, '_'))
                        <input type="hidden" name="notifications[{{ $key }}]" value="0"><input type="checkbox" name="notifications[{{ $key }}]" value="1" role="switch" @checked(data_get($settings->notification_preferences, $key, true)) aria-label="{{ $notification }}">
                    </label>
                    @endforeach
                </section>
                @endforeach
            </form>
        </section>
    </div>
</section>
@endsection
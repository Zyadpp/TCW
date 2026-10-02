@extends('layouts.admin')

@push('page-styles')
    <style>
        /* Keep the full settings screen visible on common laptop-height displays. */
        @media (min-width: 801px) and (max-height: 1100px) {
            .settings-layout-page {
                overflow: hidden;
            }

            .settings-layout-page .wrapper {
                min-height: 100vh;
                height: 100vh;
                padding-top: 16px;
                padding-bottom: 16px;
            }

            .settings-layout-page .sidebar,
            .settings-layout-page .settings-profile-card,
            .settings-layout-page .settings-form {
                min-height: 0;
                height: calc(100vh - 80px);
            }

            .settings-layout-page .sidebar {
                padding-top: 20px;
                height: calc(100vh - 32px);
            }

            .settings-layout-page .logo {
                margin-bottom: 20px;
            }

            .settings-layout-page .settings-page > h1 {
                margin: 0 0 17px;
                font-size: 25px;
                line-height: 30px;
            }

            .settings-layout-page .settings-profile-card {
                padding: 18px 20px;
            }

            .settings-layout-page .settings-logo-wrap {
                width: 64px;
                height: 64px;
                margin: 12px auto 7px;
                border-width: 4px;
            }

            .settings-layout-page .settings-logo-wrap img {
                width: 47px;
                height: 34px;
            }

            .settings-layout-page .settings-nav {
                gap: 6px;
                margin-top: 35px;
            }

            .settings-layout-page .settings-nav a {
                height: 30px;
                padding: 5px 10px;
                font-size: 9px;
            }

            .settings-layout-page .settings-form {
                padding: 14px;
                overflow: hidden;
            }

            .settings-layout-page .settings-section-title {
                margin-bottom: 8px;
                font-size: 13px;
            }

            .settings-layout-page .settings-about-panel .settings-panel-body,
            .settings-layout-page .settings-social-panel .settings-panel-body {
                padding: 6px 12px 8px;
            }

            .settings-layout-page .settings-panel-body > h3 {
                margin-bottom: 8px;
                font-size: 12px;
            }

            .settings-layout-page .settings-fields,
            .settings-layout-page .settings-social-fields {
                gap: 15px;
            }

            .settings-layout-page .settings-field input,
            .settings-layout-page .settings-social-field {
                height: 30px;
                font-size: 10px;
            }

            .settings-layout-page .settings-field textarea {
                height: 34px;
                padding: 6px 10px;
                font-size: 10px;
                resize: none;
            }

            .settings-layout-page .settings-social-field input {
                font-size: 10px;
            }

            .settings-layout-page .settings-save-button {
                width: 125px;
                height: 26px;
                margin-top: 7px;
                font-size: 9px;
            }

            .settings-layout-page .settings-social-panel {
                margin-top: 8px;
            }

            .settings-layout-page .settings-social-panel > h2 {
                padding: 7px 12px;
                font-size: 12px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="settings-page">
        <h1>Setting</h1>

        @if (session('success'))
            <div class="settings-alert" role="status">{{ session('success') }}</div>
        @endif

        <div class="settings-layout">
            @include('admin.settings.partials.sidebar')

            <form class="settings-form" action="{{ route('settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <h2 class="settings-section-title">Tcw Data</h2>
                <section id="platform-data" class="settings-panel settings-about-panel">
                    <div class="settings-panel-body">
                        <h3>About Platform</h3>
                        <div class="settings-fields">
                            <label class="settings-field settings-field-full">
                                <span>Platform name</span>
                                <input name="platform_name" value="{{ old('platform_name', $settings->platform_name === 'Tcw Platform' ? '' : $settings->platform_name) }}" placeholder="Platform name" required>
                            </label>
                            <label class="settings-field">
                                <span>Primary phone</span>
                                <input name="primary_phone" value="{{ old('primary_phone', $settings->primary_phone) }}" placeholder="+980 385 6532">
                            </label>
                            <label class="settings-field">
                                <span>Secondary phone</span>
                                <input name="secondary_phone" value="{{ old('secondary_phone', $settings->secondary_phone) }}" placeholder="+758 6987 265">
                            </label>
                            <label class="settings-field settings-field-full">
                                <span>Email address</span>
                                <input type="email" name="email" value="{{ old('email', $settings->email) }}" placeholder="info@tcw.com">
                            </label>
                            <label class="settings-field settings-field-full">
                                <span>Platform description</span>
                                <textarea name="description" placeholder="Join now to get personalized Programme recommendations from TCWâ€™s exclusive learning catalog!">{{ old('description', $settings->description) }}</textarea>
                            </label>
                        </div>
                        <button class="settings-save-button" type="submit">Save</button>
                    </div>
                </section>

                <section id="social-media" class="settings-panel settings-social-panel">
                    <h2>Social Media Accounts</h2>
                    <div class="settings-panel-body">
                        <div class="settings-social-fields">
                            @foreach ([
                                ['facebook_url', 'bi-facebook', 'Facebook account'],
                                ['instagram_url', 'bi-instagram', 'Instagram account'],
                                ['snapchat_url', 'bi-snapchat', 'Snapchat account'],
                                ['tiktok_url', 'bi-tiktok', 'TikTok account'],
                            ] as [$field, $icon, $label])
                                <label class="settings-social-field">
                                    <i class="bi {{ $icon }}" aria-hidden="true"></i>
                                    <span class="visually-hidden">{{ $label }}</span>
                                    <input type="url" name="{{ $field }}" value="{{ old($field, $settings->$field) }}" placeholder="{{ $label }}">
                                </label>
                            @endforeach
                        </div>
                        <button class="settings-save-button" type="submit">Save</button>
                    </div>
                </section>
            </form>
        </div>
    </section>
@endsection

@extends('layouts.app')

@section('title', 'Settings - CollegeOS')

@section('content')
<div class="container-fluid">
    <div class="topbar">
        <div>
            <h1>Settings</h1>
            <div class="topbar-sub">Manage college information for reports</div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert-success">
            <i class="ti ti-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="form-card">
        <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="field">
                    <label>College Name</label>
                    <input type="text" name="college_name" value="{{ $settings->college_name ?? 'CollegeOS' }}">
                </div>

                <div class="field">
                    <label>College Logo</label>
                    <input type="file" name="college_logo" accept="image/*">
                    @if(isset($settings->college_logo) && $settings->college_logo)
                        <div style="margin-top: 5px;">
                            <img src="{{ asset('storage/' . $settings->college_logo) }}" alt="Logo" style="max-height: 50px;">
                            <br>
                            <small style="color: #555570;">Current logo (upload new to replace)</small>
                        </div>
                    @endif
                </div>

                <div class="field full-width">
                    <label>College Address</label>
                    <textarea name="college_address" rows="2">{{ $settings->college_address ?? '' }}</textarea>
                </div>

                <div class="field">
                    <label>Phone Number</label>
                    <input type="text" name="college_phone" value="{{ $settings->college_phone ?? '' }}">
                </div>

                <div class="field">
                    <label>Email</label>
                    <input type="email" name="college_email" value="{{ $settings->college_email ?? '' }}">
                </div>

                <div class="field full-width">
                    <label>Report Header Message</label>
                    <textarea name="report_header" rows="2" placeholder="Additional header text for reports...">{{ $settings->report_header ?? '' }}</textarea>
                </div>

                <div class="field full-width">
                    <label>Report Footer Message</label>
                    <textarea name="report_footer" rows="2" placeholder="Additional footer text for reports...">{{ $settings->report_footer ?? '' }}</textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-amber">
                    <i class="ti ti-check"></i> Save Settings
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* Alert Success */
    .alert-success {
        background: var(--green-bg, #eaf5ef);
        color: var(--green, #1a7a4a);
        border: 1px solid #b8d9c9;
        border-radius: var(--radius, 10px);
        padding: 14px 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 500;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-card {
        background: #fff;
        border: 1px solid var(--border, #ddd8d0);
        border-radius: var(--radius-lg, 16px);
        padding: 32px 36px;
        margin-top: 20px;
        max-width: 800px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px 30px;
    }

    .field {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .field.full-width {
        grid-column: span 2;
    }

    .field label {
        font-size: 13px;
        font-weight: 600;
        color: var(--ink2, #2d2d4e);
        letter-spacing: .3px;
    }

    .field input,
    .field textarea {
        padding: 10px 14px;
        border: 1px solid var(--border2, #ccc5b8);
        border-radius: 8px;
        font-size: 14px;
        background: var(--surface, #f7f5f2);
        color: var(--ink, #1a1a2e);
        outline: none;
        transition: all .2s;
        font-family: inherit;
        width: 100%;
    }

    .field input:focus,
    .field textarea:focus {
        border-color: var(--amber, #c8850a);
        box-shadow: 0 0 0 3px rgba(200,133,10,.12);
        background: #fff;
    }

    .field textarea {
        resize: vertical;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 28px;
        padding-top: 24px;
        border-top: 1px solid var(--border, #ddd8d0);
    }

    .btn-amber {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 24px;
        background: var(--amber, #c8850a);
        color: var(--ink, #1a1a2e);
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all .15s;
        text-decoration: none;
    }

    .btn-amber:hover {
        background: #d99410;
        transform: translateY(-1px);
        color: var(--ink, #1a1a2e);
    }

    .topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .topbar h1 {
        font-size: 22px;
        font-weight: 700;
        color: var(--ink, #1a1a2e);
        margin: 0;
    }

    .topbar-sub {
        font-size: 13px;
        color: var(--ink3, #555570);
        margin-top: 2px;
    }

    @media (max-width: 768px) {
        .form-card {
            padding: 20px;
            max-width: 100%;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .field.full-width {
            grid-column: span 1;
        }

        .form-actions {
            flex-direction: column;
        }

        .form-actions .btn-amber {
            justify-content: center;
            width: 100%;
        }
    }
</style>
@endsection
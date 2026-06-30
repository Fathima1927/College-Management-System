@extends('layouts.app')

@section('title', 'Edit Subject - CollegeOS')

@section('content')
<div class="container-fluid">
    <!-- Top Bar -->
    <div class="topbar">
        <div>
            <h1>Edit Subject</h1>
            <div class="topbar-sub">Update subject information</div>
        </div>
        <a href="{{ route('subjects.index') }}" class="btn-ghost">
            <i class="ti ti-arrow-left"></i> Back to Subjects
        </a>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form method="POST" action="{{ route('subjects.update', $subject->id) }}">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <!-- Subject Code -->
                <div class="field">
                    <label for="subject_code">Subject Code <span class="required">*</span></label>
                    <input type="text" 
                           id="subject_code" 
                           name="subject_code" 
                           placeholder="e.g. CS101" 
                           value="{{ old('subject_code', $subject->subject_code) }}"
                           required>
                    @error('subject_code')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Subject Name -->
                <div class="field">
                    <label for="subject_name">Subject Name <span class="required">*</span></label>
                    <input type="text" 
                           id="subject_name" 
                           name="subject_name" 
                           placeholder="e.g. Data Structures" 
                           value="{{ old('subject_name', $subject->subject_name) }}"
                           required>
                    @error('subject_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Department -->
                <div class="field">
                    <label for="department_id">Department <span class="required">*</span></label>
                    <select id="department_id" name="department_id" required>
                        <option value="">Select Department</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ old('department_id', $subject->department_id) == $department->id ? 'selected' : '' }}>
                                {{ $department->department_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Course -->
                <div class="field">
                    <label for="course_id">Course <span class="required">*</span></label>
                    <select id="course_id" name="course_id" required>
                        <option value="">Select Course</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id', $subject->course_id) == $course->id ? 'selected' : '' }}>
                                {{ $course->course_name }} ({{ $course->course_code }})
                            </option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-amber">
                    <i class="ti ti-check"></i> Update Subject
                </button>
                <a href="{{ route('subjects.index') }}" class="btn-ghost">
                    <i class="ti ti-x"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Styles -->
<style>
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

    .field label {
        font-size: 13px;
        font-weight: 600;
        color: var(--ink2, #2d2d4e);
        letter-spacing: .3px;
    }

    .field label .required {
        color: var(--red, #c0392b);
        font-weight: 700;
    }

    .field input,
    .field select {
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
        appearance: auto;
    }

    .field input:focus,
    .field select:focus {
        border-color: var(--amber, #c8850a);
        box-shadow: 0 0 0 3px rgba(200,133,10,.12);
        background: #fff;
    }

    .field input.error,
    .field select.error {
        border-color: var(--red, #c0392b);
    }

    .field .error {
        font-size: 12px;
        color: var(--red, #c0392b);
        margin-top: 4px;
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

    .btn-ghost {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 20px;
        background: transparent;
        border: 1px solid var(--border2, #ccc5b8);
        border-radius: 8px;
        color: var(--ink2, #2d2d4e);
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all .15s;
        text-decoration: none;
    }

    .btn-ghost:hover {
        background: var(--surface2, #efecea);
        color: var(--ink, #1a1a2e);
        text-decoration: none;
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
            gap: 16px;
        }

        .form-actions {
            flex-direction: column;
        }

        .form-actions .btn-amber,
        .form-actions .btn-ghost {
            justify-content: center;
            width: 100%;
        }
    }
</style>
@endsection
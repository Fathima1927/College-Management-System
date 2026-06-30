@extends('layouts.app')

@section('title', 'Add Employee - CollegeOS')

@section('content')
<div class="container-fluid">
    <!-- Top Bar -->
    <div class="topbar">
        <div>
            <h1>Add New Employee</h1>
            <div class="topbar-sub">Create a new employee record</div>
        </div>
        <a href="{{ route('employees.index') }}" class="btn-ghost">
            <i class="ti ti-arrow-left"></i> Back to Employees
        </a>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-grid">
                <!-- Employee Name -->
                <div class="field">
                    <label for="employee_name">Employee Name <span class="required">*</span></label>
                    <input type="text" 
                           id="employee_name" 
                           name="employee_name" 
                           placeholder="e.g. John Doe" 
                           value="{{ old('employee_name') }}"
                           required>
                    @error('employee_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Designation -->
                <div class="field">
                    <label for="designation">Designation <span class="required">*</span></label>
                    <input type="text" 
                           id="designation" 
                           name="designation" 
                           placeholder="e.g. Professor" 
                           value="{{ old('designation') }}"
                           required>
                    @error('designation')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Category -->
                <div class="field">
                    <label for="category">Category <span class="required">*</span></label>
                    <select id="category" name="category" required>
                        <option value="">Select Category</option>
                        <option value="Faculty" {{ old('category') == 'Faculty' ? 'selected' : '' }}>Faculty</option>
                        <option value="Staff" {{ old('category') == 'Staff' ? 'selected' : '' }}>Staff</option>
                        <option value="Non-Teaching Staff" {{ old('category') == 'Non-Teaching Staff' ? 'selected' : '' }}>Non-Teaching Staff</option>
                    </select>
                    @error('category')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Photo -->
                <div class="field">
                    <label for="photo">Photo</label>
                    <input type="file" 
                           id="photo" 
                           name="photo" 
                           accept="image/*">
                    <small style="color: var(--ink3, #555570); font-size: 12px;">Accepted formats: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
                    @error('photo')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Address -->
                <div class="field full-width">
                    <label for="address">Address</label>
                    <textarea id="address" 
                              name="address" 
                              rows="3" 
                              placeholder="Enter employee address...">{{ old('address') }}</textarea>
                    @error('address')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- PF Number -->
                <div class="field">
                    <label for="pf_no">PF Number</label>
                    <input type="text" 
                           id="pf_no" 
                           name="pf_no" 
                           placeholder="e.g. PF123456" 
                           value="{{ old('pf_no') }}">
                    @error('pf_no')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- ESI Number -->
                <div class="field">
                    <label for="esi_no">ESI Number</label>
                    <input type="text" 
                           id="esi_no" 
                           name="esi_no" 
                           placeholder="e.g. ESI789012" 
                           value="{{ old('esi_no') }}">
                    @error('esi_no')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-amber">
                    <i class="ti ti-check"></i> Save Employee
                </button>
                <a href="{{ route('employees.index') }}" class="btn-ghost">
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

    .field.full-width {
        grid-column: span 2;
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
    .field select,
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
    .field select:focus,
    .field textarea:focus {
        border-color: var(--amber, #c8850a);
        box-shadow: 0 0 0 3px rgba(200,133,10,.12);
        background: #fff;
    }

    .field input.error,
    .field select.error,
    .field textarea.error {
        border-color: var(--red, #c0392b);
    }

    .field .error {
        font-size: 12px;
        color: var(--red, #c0392b);
        margin-top: 4px;
    }

    .field textarea {
        resize: vertical;
    }

    .field small {
        font-size: 12px;
        color: var(--ink3, #555570);
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

        .field.full-width {
            grid-column: span 1;
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
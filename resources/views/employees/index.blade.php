@extends('layouts.app')

@section('title', 'Employee Master - CollegeOS')

@section('content')
<div class="container-fluid">
    <!-- Top Bar -->
    <div class="topbar">
        <div>
            <h1>Employee Master</h1>
            <div class="topbar-sub">Manage all employees</div>
        </div>
        <a href="{{ route('employees.create') }}" class="btn-amber">
            <i class="ti ti-plus"></i> Add Employee
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert-success">
            <i class="ti ti-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Stats Row -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">👥 Total Employees</div>
            <div class="stat-value">{{ $totalEmployees }}</div>
            <div class="stat-pill pill-amber"><i class="ti ti-users"></i> All Employees</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">👨‍🏫 Faculty</div>
            <div class="stat-value">{{ $totalFaculty }}</div>
            <div class="stat-pill pill-green"><i class="ti ti-user-check"></i> Teaching Staff</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">👔 Staff</div>
            <div class="stat-value">{{ $totalStaff }}</div>
            <div class="stat-pill pill-blue"><i class="ti ti-user"></i> Support Staff</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">📋 Non-Teaching Staff</div>
            <div class="stat-value">{{ $totalNonTeaching }}</div>
            <div class="stat-pill pill-purple"><i class="ti ti-user-minus"></i> Non-Teaching</div>
        </div>
    </div>

    <!-- Employee Table -->
    <div class="table-container">
        <div class="table-header">
            <div class="table-title">
                <i class="ti ti-list"></i> Employee List
            </div>
            <div class="table-actions">
                <div class="search-wrap">
                    <i class="ti ti-search search-icon"></i>
                    <input type="text" id="searchInput" placeholder="Search employees..." onkeyup="searchTable()">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 5%; text-align: center;">SI NO</th>
                        <th style="width: 8%; text-align: center;">Photo</th>
                        <th style="width: 14%;">Employee Code</th>
                        <th style="width: 16%;">Employee Name</th>
                        <th style="width: 12%;">Designation</th>
                        <th style="width: 12%;">Category</th>
                        <th style="width: 10%;">PF No</th>
                        <th style="width: 10%;">ESI No</th>
                        <th style="width: 13%; text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $index => $employee)
                        <tr>
                            <td style="text-align: center;">{{ $employees->firstItem() + $index }}</td>
                            <td style="text-align: center;">
                                <img src="{{ $employee->photo_url }}" alt="{{ $employee->employee_name }}" class="employee-photo">
                            </td>
                            <td>
                                <span class="employee-code">{{ $employee->employee_code }}</span>
                            </td>
                            <td>
                                <span class="employee-name">{{ $employee->employee_name }}</span>
                            </td>
                            <td>{{ $employee->designation }}</td>
                            <td>
                                <span class="category-badge {{ strtolower(str_replace(' ', '-', $employee->category)) }}">
                                    {{ $employee->category }}
                                </span>
                            </td>
                            <td>{{ $employee->pf_no ?? '-' }}</td>
                            <td>{{ $employee->esi_no ?? '-' }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('employees.print', $employee->id) }}" target="_blank" class="btn-print" title="Print Employee Details">
                                        <i class="ti ti-printer"></i>
                                    </a>
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn-edit" title="Edit Employee">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form action="{{ route('employees.destroy', $employee->id) }}"
                                          method="POST"
                                          style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn-delete"
                                                onclick="return confirm('Are you sure you want to delete this employee?')"
                                                title="Delete Employee">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <div class="empty-state">
                                    <i class="ti ti-users"></i>
                                    <div class="empty-title">No Employees Found</div>
                                    <div class="empty-sub">Click "Add Employee" to create your first employee record</div>
                                    <a href="{{ route('employees.create') }}" class="btn-amber" style="margin-top: 15px; display: inline-flex;">
                                        <i class="ti ti-plus"></i> Add Your First Employee
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($employees->hasPages())
            <div class="pagination-wrapper">
                {{ $employees->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Styles -->
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

    /* Stats Row */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: #fff;
        border: 1px solid var(--border, #ddd8d0);
        border-radius: var(--radius-lg, 16px);
        padding: 20px 22px;
        position: relative;
        overflow: hidden;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        right: -14px;
        top: -14px;
        width: 70px;
        height: 70px;
        border-radius: 50%;
        opacity: .08;
    }

    .stat-card:nth-child(1)::after { background: var(--amber, #c8850a); }
    .stat-card:nth-child(2)::after { background: var(--green, #1a7a4a); }
    .stat-card:nth-child(3)::after { background: var(--blue, #2563eb); }
    .stat-card:nth-child(4)::after { background: var(--purple, #7c3aed); }

    .stat-label {
        font-size: 11px;
        font-weight: 600;
        color: var(--ink3, #555570);
        text-transform: uppercase;
        letter-spacing: .8px;
        margin-bottom: 8px;
    }

    .stat-value {
        font-size: 34px;
        font-weight: 700;
        color: var(--ink, #1a1a2e);
        line-height: 1;
    }

    .stat-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 11.5px;
        margin-top: 8px;
        padding: 3px 9px;
        border-radius: 20px;
    }

    .pill-amber {
        background: var(--amber-light, #fdf3df);
        color: #7a5200;
    }
    .pill-green {
        background: var(--green-bg, #eaf5ef);
        color: var(--green, #1a7a4a);
    }
    .pill-blue {
        background: var(--blue-bg, #eff6ff);
        color: var(--blue, #2563eb);
    }
    .pill-purple {
        background: var(--purple-bg, #f3e8ff);
        color: var(--purple, #7c3aed);
    }

    /* Table Container */
    .table-container {
        background: #fff;
        border: 1px solid var(--border, #ddd8d0);
        border-radius: var(--radius-lg, 16px);
        overflow: hidden;
        margin-top: 20px;
    }

    .table-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 20px;
        border-bottom: 1px solid var(--border, #ddd8d0);
        background: var(--surface, #f7f5f2);
        flex-wrap: wrap;
        gap: 10px;
    }

    .table-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--ink, #1a1a2e);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .table-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .search-wrap {
        position: relative;
        min-width: 180px;
    }

    .search-wrap input {
        width: 100%;
        padding: 7px 12px 7px 34px;
        border: 1px solid var(--border2, #ccc5b8);
        border-radius: var(--radius, 10px);
        font-size: 13px;
        background: #fff;
        color: var(--ink, #1a1a2e);
        outline: none;
        transition: border-color .2s;
    }

    .search-wrap input:focus {
        border-color: var(--amber, #c8850a);
        box-shadow: 0 0 0 3px rgba(200,133,10,.12);
    }

    .search-icon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--ink3, #555570);
        font-size: 14px;
        pointer-events: none;
    }

    /* Table */
    .table-responsive {
        overflow-x: auto;
        padding: 0;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
        table-layout: fixed;
    }

    .data-table thead {
        background: var(--ink, #1a1a2e);
    }

    .data-table th {
        color: #fff;
        padding: 12px 14px;
        text-align: left;
        font-weight: 600;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .5px;
        white-space: nowrap;
    }

    .data-table td {
        padding: 12px 14px;
        border-bottom: 1px solid var(--border, #ddd8d0);
        color: var(--ink2, #2d2d4e);
        vertical-align: middle;
        word-wrap: break-word;
    }

    .data-table tbody tr:hover {
        background: var(--surface, #f7f5f2);
    }

    .data-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Employee Photo */
    .employee-photo {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--border, #ddd8d0);
    }

    /* Employee Code */
    .employee-code {
        font-weight: 700;
        color: var(--ink, #1a1a2e);
        background: var(--amber-light, #fdf3df);
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 11px;
        display: inline-block;
        white-space: nowrap;
    }

    .employee-name {
        font-weight: 500;
        color: var(--ink, #1a1a2e);
        font-size: 13px;
    }

    /* Category Badge */
    .category-badge {
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
        white-space: nowrap;
    }

    .category-badge.faculty {
        background: var(--green-bg, #eaf5ef);
        color: var(--green, #1a7a4a);
    }

    .category-badge.staff {
        background: var(--blue-bg, #eff6ff);
        color: var(--blue, #2563eb);
    }

    .category-badge.non-teaching-staff {
        background: var(--purple-bg, #f3e8ff);
        color: var(--purple, #7c3aed);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 5px;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: center;
    }

    .btn-print {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 3px;
        padding: 5px 10px;
        background: var(--amber-light, #fdf3df);
        color: #7a5200;
        border: 1px solid #f5d990;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 500;
        cursor: pointer;
        transition: all .15s;
        text-decoration: none;
        white-space: nowrap;
        width: 30px;
        height: 30px;
    }

    .btn-print:hover {
        background: #fae9a0;
        color: #7a5200;
        text-decoration: none;
    }

    .btn-edit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 3px;
        padding: 5px 10px;
        background: var(--blue-bg, #eff6ff);
        color: var(--blue, #2563eb);
        border: 1px solid #b3d4fc;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 500;
        cursor: pointer;
        transition: all .15s;
        text-decoration: none;
        white-space: nowrap;
        width: 30px;
        height: 30px;
    }

    .btn-edit:hover {
        background: #d4e4ff;
        color: #1a4f8f;
        text-decoration: none;
    }

    .btn-delete {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 3px;
        padding: 5px 10px;
        background: var(--red-bg, #fdecea);
        color: var(--red, #c0392b);
        border: 1px solid #f5c6c2;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 500;
        cursor: pointer;
        transition: all .15s;
        white-space: nowrap;
        width: 30px;
        height: 30px;
    }

    .btn-delete:hover {
        background: #fbd8d5;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 56px 20px;
        color: var(--ink3, #555570);
    }

    .empty-state i {
        font-size: 48px;
        color: var(--border2, #ccc5b8);
        margin-bottom: 16px;
        display: block;
    }

    .empty-state .empty-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--ink2, #2d2d4e);
        margin-bottom: 8px;
    }

    .empty-state .empty-sub {
        font-size: 14px;
        color: var(--ink3, #555570);
    }

    /* Pagination */
    .pagination-wrapper {
        padding: 14px 20px;
        border-top: 1px solid var(--border, #ddd8d0);
        background: var(--surface, #f7f5f2);
    }

    .pagination-wrapper .pagination {
        margin: 0;
        justify-content: center;
    }

    /* Top Bar */
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

    .btn-amber {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 20px;
        background: var(--amber, #c8850a);
        color: var(--ink, #1a1a2e);
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all .15s;
        text-decoration: none;
    }

    .btn-amber:hover {
        background: #d99410;
        transform: translateY(-1px);
        color: var(--ink, #1a1a2e);
        text-decoration: none;
    }

    /* Responsive */
    @media (max-width: 1100px) {
        .stats-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .stats-row {
            grid-template-columns: 1fr;
        }

        .table-header {
            flex-direction: column;
            align-items: stretch;
        }

        .table-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .search-wrap {
            min-width: unset;
        }

        .action-buttons {
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn-print,
        .btn-edit,
        .btn-delete {
            width: 28px;
            height: 28px;
            padding: 4px 6px;
            font-size: 10px;
        }

        .data-table th,
        .data-table td {
            padding: 8px 10px;
            font-size: 12px;
        }

        .employee-photo {
            width: 32px;
            height: 32px;
        }

        .employee-code {
            font-size: 10px;
            padding: 2px 6px;
        }

        .category-badge {
            font-size: 10px;
            padding: 2px 8px;
        }
    }

    @media (max-width: 640px) {
        .topbar {
            flex-direction: column;
            align-items: flex-start;
        }

        .data-table {
            font-size: 11px;
        }

        .data-table th,
        .data-table td {
            padding: 6px 8px;
        }
    }
</style>

<!-- Search Script -->
<script>
    function searchTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.querySelector('.data-table');
        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    }
</script>

@endsection
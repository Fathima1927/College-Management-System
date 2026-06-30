<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details - {{ $settings->college_name ?? 'CollegeOS' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #fff;
            padding: 30px;
            color: #1a1a2e;
        }

        .report-container {
            max-width: 900px;
            margin: 0 auto;
        }

        /* Header */
        .report-header {
            text-align: center;
            border-bottom: 3px solid #c8850a;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .report-header .logo {
            max-height: 120px;    /* Increased from 80px */
            max-width: 300px;
            object-fit: contain;
            display: inline-block;
            margin-bottom: 5px;
        }

        .report-header .college-name {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a2e;
            letter-spacing: 0.5px;
        }

        .report-header .college-details {
            font-size: 12px;
            color: #555570;
            margin-top: 2px;
        }

        .report-header .report-title {
            font-size: 16px;
            font-weight: 600;
            color: #c8850a;
            margin-top: 8px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .report-header .report-date {
            font-size: 12px;
            color: #555570;
            margin-top: 2px;
        }

        /* Employee Info Bar */
        .employee-info-bar {
            display: flex;
            align-items: center;
            gap: 30px;
            padding: 20px 25px;
            background: #f7f5f2;
            border: 1px solid #ddd8d0;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .employee-photo {
            flex-shrink: 0;
        }

        .employee-photo img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #c8850a;
        }

        .employee-info {
            flex: 1;
        }

        .employee-info .employee-name {
            font-size: 24px;
            font-weight: 700;
            color: #1a1a2e;
        }

        .employee-info .employee-code {
            font-size: 14px;
            color: #555570;
            margin-top: 2px;
        }

        .employee-info .employee-code strong {
            color: #1a1a2e;
        }

        .employee-info .employee-meta {
            display: flex;
            gap: 20px;
            margin-top: 5px;
            flex-wrap: wrap;
        }

        .employee-info .employee-meta span {
            font-size: 13px;
            color: #555570;
        }

        .employee-info .employee-meta strong {
            color: #1a1a2e;
            font-weight: 600;
        }

        .employee-info .category-badge {
            display: inline-block;
            padding: 2px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .category-badge.faculty {
            background: #eaf5ef;
            color: #1a7a4a;
        }

        .category-badge.staff {
            background: #eff6ff;
            color: #2563eb;
        }

        .category-badge.non-teaching-staff {
            background: #f3e8ff;
            color: #7c3aed;
        }

        /* Details Table */
        .details-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd8d0;
            border-radius: 10px;
            overflow: hidden;
        }

        .details-table tr {
            border-bottom: 1px solid #ede8df;
        }

        .details-table tr:last-child {
            border-bottom: none;
        }

        .details-table td {
            padding: 10px 16px;
            font-size: 13px;
        }

        .details-table .label-cell {
            width: 35%;
            font-weight: 600;
            color: #555570;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.3px;
            background: #faf8f6;
            padding: 10px 16px;
        }

        .details-table .value-cell {
            width: 65%;
            font-weight: 500;
            color: #1a1a2e;
            font-size: 14px;
            padding: 10px 16px;
        }

        .details-table .value-cell .highlight {
            color: #c8850a;
            font-weight: 600;
        }

        /* Footer */
        .report-footer {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #ddd8d0;
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: #555570;
        }

        .report-footer .signature {
            margin-top: 25px;
            text-align: right;
        }

        .report-footer .signature-line {
            display: inline-block;
            width: 160px;
            border-top: 1.5px solid #1a1a2e;
            margin-top: 20px;
        }

        .report-footer .signature-label {
            font-size: 10px;
            color: #555570;
            margin-top: 3px;
        }

        /* Buttons */
        .no-print {
            display: block !important;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .print-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 20px;
            background: #c8850a;
            color: #1a1a2e;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all .15s;
            text-decoration: none;
        }

        .print-btn:hover {
            background: #d99410;
            transform: translateY(-1px);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 20px;
            background: transparent;
            color: #2d2d4e;
            border: 1px solid #ccc5b8;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all .15s;
            text-decoration: none;
        }

        .back-btn:hover {
            background: #efecea;
            transform: translateY(-1px);
            text-decoration: none;
        }

        /* Print styles */
        @media print {
            body {
                padding: 15px;
                background: #ffffff;
            }

            .report-container {
                max-width: 100%;
            }

            .no-print {
                display: none !important;
            }

            .report-header {
                padding-bottom: 12px;
                margin-bottom: 15px;
            }

            .report-header .logo {
                max-height: 55px;
            }

            .report-header .college-name {
                font-size: 18px;
            }

            .employee-info-bar {
                padding: 15px 20px;
                background: #f7f5f2 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .employee-photo img {
                width: 100px;
                height: 100px;
                border: 4px solid #c8850a !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .employee-info .employee-name {
                font-size: 20px;
            }

            .details-table td {
                padding: 7px 12px;
                font-size: 12px;
            }

            .details-table .label-cell {
                font-size: 10px;
                padding: 7px 12px;
                background: #faf8f6 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .details-table .value-cell {
                font-size: 13px;
                padding: 7px 12px;
            }

            .report-footer {
                margin-top: 18px;
                padding-top: 12px;
            }

            .report-footer .signature-line {
                width: 140px;
                margin-top: 15px;
            }

            .details-table {
                border: 1px solid #ddd8d0;
            }

            .details-table tr {
                border-bottom: 1px solid #ede8df;
            }

            .category-badge.faculty {
                background: #eaf5ef !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .category-badge.staff {
                background: #eff6ff !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .category-badge.non-teaching-staff {
                background: #f3e8ff !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .employee-info-bar {
                flex-direction: column;
                text-align: center;
                padding: 15px;
            }

            .employee-info .employee-meta {
                justify-content: center;
            }

            .employee-photo img {
                width: 100px;
                height: 100px;
            }

            .report-footer {
                flex-direction: column;
                gap: 10px;
            }

            .report-footer .signature {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="report-container">
        <!-- Button Group (hidden when printing) -->
        <div class="btn-group no-print">
            <a href="{{ route('employees.index') }}" class="back-btn">
                <i class="ti ti-arrow-left"></i> Back to Employees
            </a>
            <button class="print-btn" onclick="window.print()">
                <i class="ti ti-printer"></i> Print Details
            </button>
        </div>

        <!-- Report Header -->
        <div class="report-header">
            @php
                $logoUrl = null;
                if (isset($settings->college_logo) && $settings->college_logo) {
                    $storagePath = storage_path('app/public/' . $settings->college_logo);
                    if (file_exists($storagePath)) {
                        $logoUrl = asset('storage/' . $settings->college_logo);
                    }
                }
            @endphp

            @if($logoUrl)
                <img src="{{ $logoUrl }}" alt="College Logo" class="logo">
            @endif
            <div class="college-name">{{ $settings->college_name ?? 'CollegeOS' }}</div>
            <div class="college-details">
                {{ $settings->college_address ?? '' }}
                @if(isset($settings->college_phone) && $settings->college_phone)
                    | Phone: {{ $settings->college_phone }}
                @endif
                @if(isset($settings->college_email) && $settings->college_email)
                    | Email: {{ $settings->college_email }}
                @endif
            </div>
            <div class="report-title">Employee Details Report</div>
            <div class="report-date">Generated on: {{ now()->format('F d, Y h:i A') }}</div>
        </div>

        <!-- Employee Info Bar -->
        <div class="employee-info-bar">
            <div class="employee-photo">
                <img src="{{ $employee->photo_url }}" alt="{{ $employee->employee_name }}">
            </div>
            <div class="employee-info">
                <div class="employee-name">{{ $employee->employee_name }}</div>
                <div class="employee-code"><strong>Employee Code:</strong> {{ $employee->employee_code }}</div>
                <div class="employee-meta">
                    <span><strong>Designation:</strong> {{ $employee->designation }}</span>
                    <span>
                        <strong>Category:</strong> 
                        <span class="category-badge {{ strtolower(str_replace(' ', '-', $employee->category)) }}">
                            {{ $employee->category }}
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <!-- Details Table -->
        <table class="details-table">
            <tr>
                <td class="label-cell">Employee Code</td>
                <td class="value-cell">{{ $employee->employee_code }}</td>
            </tr>
            <tr>
                <td class="label-cell">Employee Name</td>
                <td class="value-cell">{{ $employee->employee_name }}</td>
            </tr>
            <tr>
                <td class="label-cell">Designation</td>
                <td class="value-cell">{{ $employee->designation }}</td>
            </tr>
            <tr>
                <td class="label-cell">Category</td>
                <td class="value-cell">{{ $employee->category }}</td>
            </tr>
            <tr>
                <td class="label-cell">PF Number</td>
                <td class="value-cell">{{ $employee->pf_no ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">ESI Number</td>
                <td class="value-cell">{{ $employee->esi_no ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Address</td>
                <td class="value-cell">{{ $employee->address ?? '-' }}</td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="report-footer">
            <div>
                <div>Generated by CollegeOS Management System</div>
                <div style="margin-top: 3px; font-size: 10px; color: #888;">
                    This is a system-generated report
                </div>
                @if(isset($settings->report_footer) && $settings->report_footer)
                    <div style="margin-top: 6px; font-size: 11px; color: #555570;">
                        {{ $settings->report_footer }}
                    </div>
                @endif
            </div>
            <div class="signature">
                <div>Authorized Signature</div>
                <div class="signature-line"></div>
                <div class="signature-label">{{ now()->format('F d, Y') }}</div>
            </div>
        </div>
    </div>

    <script>
        // Uncomment to auto-print when page loads
        // window.onload = function() { 
        //     setTimeout(function() { window.print(); }, 500);
        // }
    </script>
</body>
</html>
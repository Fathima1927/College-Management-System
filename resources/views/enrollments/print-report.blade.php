<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Report - {{ $settings->college_name ?? 'CollegeOS' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #fff;
            padding: 40px;
            color: #1a1a2e;
        }

        .report-container {
            max-width: 1100px;
            margin: 0 auto;
        }

        /* Header */
        .report-header {
            text-align: center;
            border-bottom: 3px solid #c8850a;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .report-header .logo {
             max-height: 120px;    /* Increased from 80px */
             max-width: 300px;     /* Increased from 200px */
             object-fit: contain;
             display: inline-block;
        }

        .report-header .college-name {
            font-size: 24px;
            font-weight: 700;
            color: #1a1a2e;
            letter-spacing: 1px;
        }

        .report-header .college-details {
            font-size: 13px;
            color: #555570;
            margin-top: 5px;
        }

        .report-header .report-title {
            font-size: 18px;
            font-weight: 600;
            color: #c8850a;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .report-header .report-date {
            font-size: 13px;
            color: #555570;
            margin-top: 5px;
        }

        /* Report Header Message */
        .report-header-message {
            background: #fdf3df;
            border-left: 4px solid #c8850a;
            padding: 12px 16px;
            margin: 15px 0 0 0;
            border-radius: 4px;
            font-size: 14px;
            color: #7a5200;
            text-align: left;
        }

        /* Table */
        .report-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-top: 20px;
        }

        .report-table thead {
            background: #1a1a2e;
        }

        .report-table th {
            color: #fff;
            padding: 12px 14px;
            text-align: left;
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .report-table td {
            padding: 10px 14px;
            border-bottom: 1px solid #ddd8d0;
            color: #2d2d4e;
        }

        .report-table tbody tr:hover {
            background: #f7f5f2;
        }

        .report-table tbody tr:last-child td {
            border-bottom: none;
        }

        .report-table .text-center {
            text-align: center;
        }

        /* Footer */
        .report-footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd8d0;
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #555570;
        }

        .report-footer .signature {
            margin-top: 30px;
            text-align: right;
        }

        .report-footer .signature-line {
            display: inline-block;
            width: 200px;
            border-top: 1px solid #1a1a2e;
            margin-top: 30px;
        }

        .report-footer .signature-label {
            font-size: 11px;
            color: #555570;
            margin-top: 5px;
        }

        /* Report Footer Message */
        .report-footer-message {
            background: #f7f5f2;
            border-left: 4px solid #555570;
            padding: 12px 16px;
            margin-top: 20px;
            border-radius: 4px;
            font-size: 13px;
            color: #2d2d4e;
        }

        /* Print-specific styles */
        @media print {
            body {
                padding: 20px;
            }
            
            .no-print {
                display: none !important;
            }
            
            .report-header {
                border-bottom-width: 2px;
            }
            
            .report-table th {
                background: #1a1a2e !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            
            .report-table tbody tr:hover {
                background: transparent !important;
            }

            .report-header-message {
                background: #fdf3df !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .report-footer-message {
                background: #f7f5f2 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }

        /* Button styles */
        .btn-group {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .print-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 24px;
            background: #c8850a;
            color: #1a1a2e;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all .15s;
            text-decoration: none;
        }

        .print-btn:hover {
            background: #d99410;
            transform: translateY(-1px);
        }

        .print-btn i {
            font-size: 16px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 24px;
            background: transparent;
            color: #2d2d4e;
            border: 1px solid #ccc5b8;
            border-radius: 8px;
            font-size: 14px;
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

        .back-btn i {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="report-container">
        <!-- Button Group (hidden when printing) -->
        <div class="btn-group no-print">
            <a href="{{ route('enrollments.index') }}" class="back-btn">
                <i class="ti ti-arrow-left"></i> Back to Enrollments
            </a>
            <button class="print-btn" onclick="window.print()">
                <i class="ti ti-printer"></i> Print Report
            </button>
        </div>

        <!-- Report Header -->
        <div class="report-header">
            @if(isset($settings->college_logo) && $settings->college_logo)
                <img src="{{ asset('storage/' . $settings->college_logo) }}" alt="College Logo" class="logo">
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
            <div class="report-title">Student Enrollment Report</div>
            <div class="report-date">Generated on: {{ now()->format('F d, Y h:i A') }}</div>

            <!-- Report Header Message (from settings) -->
            @if(isset($settings->report_header) && $settings->report_header)
                <div class="report-header-message">
                    <i class="ti ti-info-circle"></i> {{ $settings->report_header }}
                </div>
            @endif
        </div>

        <!-- Report Summary -->
        <div style="margin-bottom: 20px;">
            <div style="display: flex; justify-content: space-between; font-size: 13px; color: #555570; background: #f7f5f2; padding: 12px 16px; border-radius: 8px;">
                <span><strong>Total Enrollments:</strong> {{ $enrollments->count() }}</span>
                <span><strong>Total Courses:</strong> {{ $enrollments->pluck('course_id')->unique()->count() }}</span>
                <span><strong>Report Period:</strong> {{ now()->format('F Y') }}</span>
            </div>
        </div>

        <!-- Enrollment Table -->
        <table class="report-table">
            <thead>
                <tr>
                    <th>SI NO</th>
                    <th>Student Name</th>
                    <th class="text-center">Age</th>
                    <th class="text-center">Gender</th>
                    <th>DOB</th>
                    <th>Course</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enrollments as $index => $enroll)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $enroll->student->student_name ?? '-' }}</td>
                        <td class="text-center">{{ $enroll->student->age ?? '-' }}</td>
                        <td class="text-center">{{ $enroll->student->gender ?? '-' }}</td>
                        <td>
                            @if(isset($enroll->student->date_of_birth) && $enroll->student->date_of_birth)
                                {{ \Carbon\Carbon::parse($enroll->student->date_of_birth)->format('d/m/Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $enroll->course->course_name ?? '-' }}</td>
                        <td>{{ $enroll->course->department->department_name ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px; color: #555570;">
                            No enrollments found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Footer -->
        <div class="report-footer">
            <div>
                <div>Generated by CollegeOS Management System</div>
                <div style="margin-top: 5px; font-size: 11px; color: #888;">
                    This is a system-generated report
                </div>
                
            </div>
            <div class="signature">
                <div>Authorized Signature</div>
                <div class="signature-line"></div>
                <div class="signature-label">{{ now()->format('F d, Y') }}</div>
            </div>
        </div>

        <!-- Report Footer Message (from settings) -->
        @if(isset($settings->report_footer) && $settings->report_footer)
            <div class="report-footer-message">
                <i class="ti ti-info-circle"></i> {{ $settings->report_footer }}
            </div>
        @endif
    </div>

    <script>
        // Uncomment to auto-print when page loads
        // window.onload = function() { 
        //     setTimeout(function() { window.print(); }, 500);
        // }
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details - {{ $settings->college_name ?? 'CollegeOS' }}</title>
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

        /* Student Info Bar */
        .student-info-bar {
            display: flex;
            align-items: center;
            gap: 25px;
            padding: 15px 20px;
            background: #f7f5f2;
            border: 1px solid #ddd8d0;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .student-photo {
            flex-shrink: 0;
        }

        .student-photo img {
            width: 80px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
            border: 3px solid #c8850a;
        }

        .student-info {
            flex: 1;
        }

        .student-info .student-name {
            font-size: 22px;
            font-weight: 700;
            color: #1a1a2e;
        }

        .student-info .student-id {
            font-size: 14px;
            color: #555570;
            margin-top: 2px;
        }

        .student-info .student-id strong {
            color: #1a1a2e;
        }

        .student-info .student-meta {
            display: flex;
            gap: 20px;
            margin-top: 5px;
            flex-wrap: wrap;
        }

        .student-info .student-meta span {
            font-size: 13px;
            color: #555570;
        }

        .student-info .student-meta strong {
            color: #1a1a2e;
            font-weight: 600;
        }

        .student-info .gender-badge {
            display: inline-block;
            padding: 2px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            background: #f9f4e7;
            color: #ab7b1f;
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

            .student-info-bar {
                padding: 12px 16px;
                background: #f7f5f2 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .student-photo img {
                width: 65px;
                height: 85px;
                border: 3px solid #c8850a !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .student-info .student-name {
                font-size: 19px;
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
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .student-info-bar {
                flex-direction: column;
                text-align: center;
                padding: 15px;
            }

            .student-info .student-meta {
                justify-content: center;
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
            <a href="{{ route('students.index') }}" class="back-btn">
                <i class="ti ti-arrow-left"></i> Back to Students
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
            <div class="report-title">Student Details Report</div>
            <div class="report-date">Generated on: {{ now()->format('F d, Y h:i A') }}</div>
        </div>

        <!-- Student Info Bar -->
        <div class="student-info-bar">
            <div class="student-photo">
                <img src="{{ $student->photo ? asset('uploads/students/' . $student->photo) : 'https://via.placeholder.com/80x100?text=No+Photo' }}" alt="{{ $student->student_name }}">
            </div>
            <div class="student-info">
                <div class="student-name">{{ $student->student_name }}</div>
                <div class="student-id"><strong>Student ID:</strong> {{ $student->student_id }}</div>
                <div class="student-meta">
                    <span><strong>Father:</strong> {{ $student->father_name }}</span>
                    <span><strong>Age:</strong> {{ $student->age }} years</span>
                    <span><strong>Gender:</strong> <span class="gender-badge">{{ $student->gender }}</span></span>
                </div>
            </div>
        </div>

        <!-- Details Table -->
        <table class="details-table">
            <tr>
                <td class="label-cell">Student ID</td>
                <td class="value-cell">{{ $student->student_id }}</td>
            </tr>
            <tr>
                <td class="label-cell">Student Name</td>
                <td class="value-cell">{{ $student->student_name }}</td>
            </tr>
            <tr>
                <td class="label-cell">Father's Name</td>
                <td class="value-cell">{{ $student->father_name }}</td>
            </tr>
            <tr>
                <td class="label-cell">Gender</td>
                <td class="value-cell">{{ $student->gender }}</td>
            </tr>
            <tr>
                <td class="label-cell">Age</td>
                <td class="value-cell">{{ $student->age }} years</td>
            </tr>
            <tr>
                <td class="label-cell">Date of Birth</td>
                <td class="value-cell">{{ $student->date_of_birth->format('F d, Y') }}</td>
            </tr>
            <tr>
                <td class="label-cell">Contact Number</td>
                <td class="value-cell">{{ $student->contact_number }}</td>
            </tr>
            <tr>
                <td class="label-cell">Alternate Contact</td>
                <td class="value-cell">{{ $student->alternate_contact_number ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Aadhaar Number</td>
                <td class="value-cell">{{ $student->aadhaar_number }}</td>
            </tr>
            <tr>
                <td class="label-cell">Last Class Studied</td>
                <td class="value-cell">{{ $student->last_class_studied }}</td>
            </tr>
            <tr>
                <td class="label-cell">Previous Year Grade</td>
                <td class="value-cell">{{ $student->previous_year_grade }}</td>
            </tr>
            <tr>
                <td class="label-cell">Last School Studied</td>
                <td class="value-cell">{{ $student->last_school_studied }}</td>
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
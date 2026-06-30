<<<<<<< HEAD
<!DOCTYPE html>
=======
<!doctype html>
>>>>>>> origin/integration-student-course
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
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
=======
    <title>Print Student - {{ $student->student_name }}</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; color: #1d1d2e; background: #fff; margin: 0; padding: 32px; }
        .report { max-width: 820px; margin: 0 auto; border: 1px solid #e6e2db; padding: 32px; }
        .brand { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; }
        .brand-title { font-size: 22px; font-weight: 700; letter-spacing: 0.6px; color: #1a1a2e; }
        .brand-sub { color: #7f7f92; font-size: 13px; margin-top: 4px; }
        .badge { border-radius: 10px; padding: 8px 14px; background: #f9f4e7; color: #ab7b1f; font-size: 12px; font-weight: 700; }
        .section-title { font-size: 14px; font-weight: 700; color: #1a1a2e; margin-bottom: 16px; }
        .row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 18px; }
        .field { padding: 14px 16px; background: #f8f5f2; border-radius: 14px; border: 1px solid #ede8df; }
        .field-label { font-size: 12px; color: #6b6b84; text-transform: uppercase; letter-spacing: .35px; margin-bottom: 8px; }
        .field-value { font-size: 15px; font-weight: 600; color: #24243a; }
        .photo-card { display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 16px; border: 1px solid #ede8df; border-radius: 16px; }
        .photo-card img { width: 160px; height: 200px; object-fit: cover; border-radius: 14px; border: 1px solid #d4cfc4; }
        .photo-card small { display: block; margin-top: 12px; color: #7c7c90; font-size: 12px; }
        .footer { display: flex; justify-content: space-between; margin-top: 40px; gap: 24px; }
        .signature { text-align: center; width: 100%; }
        .signature-line { border-top: 1px solid #cfc9c1; margin-top: 46px; padding-top: 8px; color: #656575; font-size: 12px; }
        .print-note { margin-top: 30px; color: #6b6b84; font-size: 12px; }
        @media print {
            body { padding: 0; }
            .report { border: none; padding: 0; }
            .brand { page-break-inside: avoid; }
            .footer { page-break-inside: avoid; }
>>>>>>> origin/integration-student-course
        }
    </style>
</head>
<body>
<<<<<<< HEAD
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
=======
    <div class="report">
        <div class="brand">
            <div>
                <div class="brand-title">CollegeOS Student Printout</div>
                <div class="brand-sub">Student record generated on {{ now()->format('F j, Y') }}</div>
            </div>
            <div class="badge">Student ID: {{ $student->student_id }}</div>
        </div>

        <div class="row">
            <div class="field">
                <div class="field-label">Student Name</div>
                <div class="field-value">{{ $student->student_name }}</div>
            </div>
            <div class="field">
                <div class="field-label">Father's Name</div>
                <div class="field-value">{{ $student->father_name }}</div>
            </div>
        </div>

        <div class="row">
            <div class="field">
                <div class="field-label">Age</div>
                <div class="field-value">{{ $student->age }}</div>
            </div>
            <div class="field">
                <div class="field-label">Gender</div>
                <div class="field-value">{{ $student->gender }}</div>
            </div>
        </div>

        <div class="row">
            <div class="field">
                <div class="field-label">Date of Birth</div>
                <div class="field-value">{{ $student->date_of_birth->format('F d, Y') }}</div>
            </div>
            <div class="field">
                <div class="field-label">Contact Number</div>
                <div class="field-value">{{ $student->contact_number }}</div>
            </div>
        </div>

        <div class="row">
            <div class="field">
                <div class="field-label">Alternate Contact</div>
                <div class="field-value">{{ $student->alternate_contact_number ?? 'N/A' }}</div>
            </div>
            <div class="field">
                <div class="field-label">Aadhaar Number</div>
                <div class="field-value">{{ $student->aadhaar_number }}</div>
            </div>
        </div>

        <div class="row">
            <div class="field">
                <div class="field-label">Last Class Studied</div>
                <div class="field-value">{{ $student->last_class_studied }}</div>
            </div>
            <div class="field">
                <div class="field-label">Previous Year Grade</div>
                <div class="field-value">{{ $student->previous_year_grade }}</div>
            </div>
        </div>

        <div class="row">
            <div class="field">
                <div class="field-label">Last School Studied</div>
                <div class="field-value">{{ $student->last_school_studied }}</div>
            </div>
            <div class="photo-card">
                <img src="{{ $student->photo ? asset('uploads/students/' . $student->photo) : 'https://via.placeholder.com/160x200?text=Photo' }}" alt="Student Photo">
                <small>Passport photo</small>
            </div>
        </div>

        <div class="footer">
            <div class="signature">
                <div class="signature-line">Registrar Signature</div>
            </div>
            <div class="signature">
                <div class="signature-line">Principal Signature</div>
            </div>
        </div>

        <div class="print-note">
            This student report is generated for administrative use and should be handled with confidentiality.
        </div>
    </div>
</body>
</html>
>>>>>>> origin/integration-student-course

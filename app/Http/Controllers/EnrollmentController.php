<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use App\Models\Setting;


class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'course.department'])->get();
        return view('enrollments.index', compact('enrollments'));
    }

   public function create()
{
    $students = Student::all();
    $courses = Course::with('department')->get();

    return view('enrollments.create', compact('students', 'courses'));
}
    public function store(Request $request)
{
    $request->validate([
        'student_id' => 'required',
        'course_id' => 'required',
    ]);

    Enrollment::create([
        'student_id' => $request->student_id,
        'course_id' => $request->course_id,
    ]);

    return redirect()->route('enrollments.index')
        ->with('success', 'Student Enrolled Successfully');
}
public function destroy($id)
{
    $enrollment = Enrollment::findOrFail($id);
    $enrollment->delete();

    return redirect()->route('enrollments.index')
        ->with('success', 'Enrollment deleted successfully');
}
public function printReport()
    {
        $enrollments = Enrollment::with(['student', 'course.department'])->get();
        $settings = Setting::first() ?? (object) [
            'college_name' => 'CollegeOS',
            'college_logo' => null,
            'college_address' => 'Your College Address',
            'college_phone' => '123-456-7890',
            'college_email' => 'info@college.edu',
        ];
        
        return view('enrollments.print-report', compact('enrollments', 'settings'));
    }}
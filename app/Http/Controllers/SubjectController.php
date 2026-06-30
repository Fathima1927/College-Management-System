<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Department;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Subject::with(['department', 'course']);

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $subjects = $query->latest()->paginate(10);
        
        // Statistics
        $totalSubjects = Subject::count();
        $totalDepartments = Department::count();
        $totalCourses = Course::count();

        return view('subjects.index', compact('subjects', 'totalSubjects', 'totalDepartments', 'totalCourses'));
    }

    public function create()
    {
        $departments = Department::orderBy('department_name')->get();
        $courses = Course::orderBy('course_name')->get();
        
        return view('subjects.create', compact('departments', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_code' => 'required|string|max:50|unique:subjects,subject_code',
            'subject_name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        Subject::create($request->all());

        return redirect()->route('subjects.index')
            ->with('success', 'Subject created successfully!');
    }

    public function show(Subject $subject)
    {
        $subject->load(['department', 'course']);
        return view('subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        $departments = Department::orderBy('department_name')->get();
        $courses = Course::orderBy('course_name')->get();
        
        return view('subjects.edit', compact('subject', 'departments', 'courses'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'subject_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('subjects', 'subject_code')->ignore($subject->id),
            ],
            'subject_name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $subject->update($request->all());

        return redirect()->route('subjects.index')
            ->with('success', 'Subject updated successfully!');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subjects.index')
            ->with('success', 'Subject deleted successfully!');
    }
}
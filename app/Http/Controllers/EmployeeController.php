<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $employees = $query->latest()->paginate(10);
        
        $totalEmployees = Employee::count();
        $totalFaculty = Employee::where('category', 'Faculty')->count();
        $totalStaff = Employee::where('category', 'Staff')->count();
        $totalNonTeaching = Employee::where('category', 'Non-Teaching Staff')->count();

        return view('employees.index', compact(
            'employees', 
            'totalEmployees', 
            'totalFaculty', 
            'totalStaff', 
            'totalNonTeaching'
        ));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable|string',
            'designation' => 'required|string|max:255',
            'category' => 'required|in:Faculty,Staff,Non-Teaching Staff',
            'pf_no' => 'nullable|string|max:50',
            'esi_no' => 'nullable|string|max:50',
        ]);

        $data = $request->all();
        $data['employee_code'] = $this->generateEmployeeCode();

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '_' . Str::slug($request->employee_name) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/employees'), $filename);
            $data['photo'] = $filename;
        }

        Employee::create($data);

        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully!');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'employee_name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable|string',
            'designation' => 'required|string|max:255',
            'category' => 'required|in:Faculty,Staff,Non-Teaching Staff',
            'pf_no' => 'nullable|string|max:50',
            'esi_no' => 'nullable|string|max:50',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($employee->photo && file_exists(public_path('uploads/employees/' . $employee->photo))) {
                unlink(public_path('uploads/employees/' . $employee->photo));
            }

            $photo = $request->file('photo');
            $filename = time() . '_' . Str::slug($request->employee_name) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/employees'), $filename);
            $data['photo'] = $filename;
        }

        $employee->update($data);

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully!');
    }

    public function destroy(Employee $employee)
    {
        if ($employee->photo && file_exists(public_path('uploads/employees/' . $employee->photo))) {
            unlink(public_path('uploads/employees/' . $employee->photo));
        }

        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully!');
    }

    private function generateEmployeeCode()
    {
        $prefix = 'EMP';
        $date = now()->format('Ymd');
        $lastEmployee = Employee::whereDate('created_at', now()->toDateString())
            ->orderBy('id', 'desc')
            ->first();

        if ($lastEmployee) {
            $lastNumber = (int) substr($lastEmployee->employee_code, -4);
            $number = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $number = '0001';
        }

        return $prefix . '-' . $date . '-' . $number;
    }

    public function printEmployee(Employee $employee)
    {
        try {
            $settings = Setting::first();
            if (!$settings) {
                $settings = (object) [
                    'college_name' => 'CollegeOS',
                    'college_logo' => null,
                    'college_address' => 'Your College Address',
                    'college_phone' => '123-456-7890',
                    'college_email' => 'info@college.edu',
                ];
            }
        } catch (\Exception $e) {
            $settings = (object) [
                'college_name' => 'CollegeOS',
                'college_logo' => null,
                'college_address' => 'Your College Address',
                'college_phone' => '123-456-7890',
                'college_email' => 'info@college.edu',
            ];
        }
        
        return view('employees.print', compact('employee', 'settings'));
    }
}
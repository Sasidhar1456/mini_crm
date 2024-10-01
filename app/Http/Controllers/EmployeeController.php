<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Display a paginated list of employees
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('employees.index', compact('employees'));
    }

    // Show the form to create a new employee
    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }

    // Store a newly created employee
    public function store(Request $request)
    {
        $this->validateRequest($request); // Validate the request

        $employee = new Employee();
        $this->saveEmployeeData($employee, $request);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    // Show the form to edit an existing employee
    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    // Update the specified employee
    public function update(Request $request, Employee $employee)
    {
        $this->validateRequest($request); // Validate the request

        $this->saveEmployeeData($employee, $request);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    // Delete the specified employee
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    // Validate the request
    private function validateRequest(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required|exists:companies,id',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    // Save employee data
    private function saveEmployeeData(Employee $employee, Request $request)
    {
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->company_id = $request->company_id;
        $employee->email = $request->email;
        $employee->phone = $request->phone;

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if it exists
            if ($employee->profile_picture) {
                \Storage::disk('private')->delete($employee->profile_picture);
            }
            $employee->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'private');
        }

        $employee->save();
    }
}

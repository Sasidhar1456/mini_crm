@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Employees List</h1>
    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Add New Employee</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Profile Picture</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->first_name }}</td>
                <td>{{ $employee->last_name }}</td>
                <td>{{ $employee->company ? $employee->company->name : 'No Company Assigned' }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                <td>
                @if ($employee->profile_picture)
    <img src="{{ route('profile.picture', basename($employee->profile_picture)) }}" alt="Profile Picture" width="50" height="50">
@else
    No Picture
@endif

                </td>
                <td>
                    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

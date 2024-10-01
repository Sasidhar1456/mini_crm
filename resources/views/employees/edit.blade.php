@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Employee</h1>

    <form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" id="first_name" value="{{ $employee->first_name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" id="last_name" value="{{ $employee->last_name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="company_id" class="form-label">Company</label>
            <select name="company_id" id="company_id" class="form-select">
                <option value="">Select Company</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ $employee->company_id == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" value="{{ $employee->email }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" value="{{ $employee->phone }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="profile_picture" class="form-label">Profile Picture</label>
            <input type="file" name="profile_picture" id="profile_picture" class="form-control">
            @if ($employee->profile_picture)
                <img src="{{ route('profile.picture', basename($employee->profile_picture)) }}" alt="Profile Picture" width="100" height="100" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Employee</button>
    </form>
</div>
@endsection

{{-- resources/views/companies/index.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Companies</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('companies.create') }}" class="btn btn-primary">Add Company</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Website</th>
                <th>Logo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $company)
            <tr>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td>{{ $company->website }}</td>
                <td>
                    @if ($company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" width="50" height="50">
                    @endif
                </td>
                <td>
                    <a href="{{ route('companies.edit', $company) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('companies.destroy', $company) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $companies->links() }}
</div>
@endsection

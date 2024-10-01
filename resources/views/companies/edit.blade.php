@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Company</h1>

    <form action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Company Name</label>
            <input type="text" name="name" id="name" value="{{ $company->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" value="{{ $company->email }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="text" name="website" id="website" value="{{ $company->website }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>
            <input type="file" name="logo" id="logo" class="form-control">
            @if ($company->logo)
                <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" width="100" height="100" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Company</button>
    </form>
</div>
@endsection

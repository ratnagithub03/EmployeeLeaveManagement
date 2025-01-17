@extends('employeelayout.default')

@section('content')
<div class="container">
    <h2>Employee (Edit Profile)</h2>

    <!-- Display success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Profile Form -->
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered">
            <tr>
                <th>Photo</th>
                <td>
                    <!-- Display current photo if available -->
                    @if($employee->photo)
                        <img src="{{ asset('Public/' . $employee->photo) }}" alt="Profile Photo" width="100">
                    @endif
                    <input type="file" name="photo" class="form-control mt-2">
                </td>
            </tr>
            <tr>
                <th>UID</th>
                <td><input type="text" name="uid" class="form-control" value="{{ $employee->uid }}" readonly></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><input type="text" name="name" class="form-control" value="{{ old('name', $employee->name) }}" required></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><input type="email" name="email" class="form-control" value="{{ old('email', $employee->email) }}" required></td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td><input type="text" name="phone" class="form-control" value="{{ old('phone', $employee->phone) }}"></td>
            </tr>
            <tr>
                <th>Role</th>
                <td><input type="text" name="role" class="form-control" value="{{ $employee->role }}" readonly></td>
            </tr>
        </table>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection

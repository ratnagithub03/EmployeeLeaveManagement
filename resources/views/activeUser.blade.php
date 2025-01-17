@extends('adminlayout.default')
@section('content')
<style>
    .table-excel {
        border-collapse: collapse;
        width: 100%;
        margin: 20px 0;
    }

    .table-excel th, .table-excel td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    /* Add background color and styling for the table header */
    .table-excel th {
        background-color: #4CAF50; /* Green */
        color: #ffffff; /* White text */
        font-weight: bold;
    }

    /* Change header text color */
    .table-excel th {
        background-color: #007bff; /* Blue background for headers */
        color: #fff; /* White text */
    }

    /* Hover effect for table rows */
    .table-excel tr:hover {
        background-color: #f1f1f1; /* Light gray */
    }

    .table-excel td {
        background-color: #fff; /* White background */
    }

    .table-excel td:first-child {
        font-weight: bold;
        background-color: #f9f9f9; /* Light gray for first column */
    }

    /* Button styles */
    .btn-active {
        background-color: #28a745; /* Green background */
        color: white; /* White text */
        padding: 8px 12px; /* Padding for the button */
        border: none; /* No border */
        border-radius: 4px; /* Rounded corners */
        cursor: pointer; /* Pointer cursor on hover */
        font-weight: bold; /* Bold text */
        text-align: center; /* Center the text */
        display: inline-block; /* Inline block to fit content */
    }

    .btn-active:hover {
        background-color: #218838; /* Darker green on hover */
    }
</style>

<table class="table-excel">
    <tr>
        <th>Sl. No.</th>
        <th>Name</th>
        <th>Email</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Phone</th>
        <th>Role</th>
        <th>Status</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->age}}</td>
        <td>{{$user->gender}}</td>
        <td>{{$user->phone}}</td>
        <td class="{{ $user->role == 'admin' ? 'role-admin' : 'role-user' }}">{{$user->role}}</td>
        <td>
            @if($user->status == 'active')
                <button class="btn-active">Active</button> <!-- Green button for active status -->
            @else
                <span class="status-inactive">{{$user->status}}</span> <!-- Display inactive status -->
            @endif
        </td>
    </tr>
    @endforeach
</table>
@endsection

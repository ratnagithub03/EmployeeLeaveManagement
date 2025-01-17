@extends('hrlayout.default')
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
        background-color: #007bff; /* Blue background for headers */
        font-weight: bold;
    }

    /* Hover effect for table rows */
    /* .table-excel tr:hover {
        background-color: #f1f1f1; /* Light gray */
    }

    .table-excel td {
        background-color: black;
    } */

    .table-excel td:first-child {
        font-weight: bold;
        background-color: #f9f9f9; /* Light gray for first column */
    }

    /* Button styles for inactive users */
    .btn-inactive {
        background-color: #dc3545; /* Red background */
        color: white; /* White text */
        padding: 8px 12px; /* Padding for the button */
        border: none; /* No border */
        border-radius: 4px; /* Rounded corners */
        cursor: pointer; /* Pointer cursor on hover */
        font-weight: bold; /* Bold text */
        text-align: center; /* Center the text */
        display: inline-block; /* Inline block to fit content */
    }

    .btn-inactive:hover {
        background-color: #c82333; /* Darker red on hover */
    }

    /* Role highlighting */
    .role-hr {
        /* background-color: #cce5ff; */
        color: #004085; /* Dark blue */
        font-weight: bold; /* Bold text */
    }

    .role-user {
        background-color: #fff3cd;
        color: #856404; /* Dark yellow */
        font-weight: bold; /* Bold text */
    }

    .status-active {
        color: #28a745; /* Green for active status */
        font-weight: bold; /* Bold text */
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
        <td class="{{ $user->role == 'hr' ? 'role-hr' : 'role-user' }}">{{$user->role}}</td>
        <td>
            @if($user->status == 'inactive')
                <button class="btn-inactive">Inactive</button> <!-- Red button for inactive status -->
            @else
                <span class="status-active">{{$user->status}}</span> <!-- Display active status -->
            @endif
        </td>
    </tr>
    @endforeach
</table>
@endsection

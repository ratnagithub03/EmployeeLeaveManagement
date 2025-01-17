@extends('hrlayout.default')
@section('content')
    <style>
        /* General table styling */
        .excel-table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .excel-table th, .excel-table td {
            border: 1px solid #bbb;
            padding: 10px;
            text-align: left;
            color: #333; /* Darker text for better visibility */
        }

        .excel-table th {
            background-color: #f4f6f9; /* Light grey for header background */
            font-weight: bold;
        }

        /* Even rows styling */
        .excel-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Odd rows styling */
        .excel-table tr:nth-child(odd) {
            background-color: #ffffff;
        }

        /* Table header row styling */
        .excel-table tr th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        /* Sl. No column styling */
        .excel-table td:first-child {
            text-align: center;
        }

        /* Role and Status alignment center */
        .excel-table td:nth-child(7), .excel-table td:nth-child(8) {
            text-align: center;
        }

        /* Status button styling */
        .status-active {
            background-color: #28a745;
            color: white;
            padding: 5px 12px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
            text-align: center;
            border: none;
            cursor: pointer;
            font-size: 13px;
        }

        /* Adjust table for responsiveness */
        @media screen and (max-width: 768px) {
            .excel-table th, .excel-table td {
                font-size: 12px;
                padding: 8px;
            }
        }

    </style>

    <table class="excel-table">
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
            <td>{{$user->role}}</td>
            <td>
                @if($user->status == 'Active')
                    <span class="status-active">
                        Active
                    </span>
                @else
                    {{$user->status}}
                @endif
            </td>
        </tr>
        @endforeach
    </table>
@stop

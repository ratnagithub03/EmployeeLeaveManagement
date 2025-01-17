@extends('employeelayout.app')

@section('content')
<div class="leave-status">
    <h3>Leave Status</h3>
    
    <div class="filter-section">
        <label for="application-status">Application Status:</label>
        <select id="application-status">
            <option value="all">All</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
            <option value="pending">Pending</option>
        </select>
        <button id="filter-by-date">Filter by Date</button>
    </div>
    
    <table class="leave-table">
        <thead>
            <tr>
                <th>Start Date</th>
                <th>End Date</th>
                <th>No. of Days</th>
                <th>Leave Type</th>
                <th>Leave Status</th>
                <th>Reason</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="leave-data">
            <!-- Data populated via AJAX -->
        </tbody>
    </table>
</div>

<style>
.leave-status {
    width: 80%;
    margin: auto;
}

.filter-section {
    margin-bottom: 20px;
}

.filter-section label {
    margin-right: 10px;
}

.leave-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.leave-table th, .leave-table td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
}

.leave-table th {
    background-color: #f4f4f4;
}

.leave-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.leave-table tr:hover {
    background-color: #f1f1f1;
}

button {
    padding: 5px 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}
</style>

<script>

$(document).ready(function() {
    // Load initial data
    loadLeaveData('all');

    // Filter based on application status
    $('#application-status').on('change', function() {
        const status = $(this).val();
        loadLeaveData(status);
    });

    // Filter by date (you can add your date picker logic here)
    $('#filter-by-date').on('click', function() {
        // Add date filter functionality here
        alert('Filter by date functionality to be implemented.');
    });
});

function loadLeaveData(status) {
    $.ajax({
        url: '/api/leaveStatus', // Laravel route
        method: 'GET',
        data: {status: status},
        success: function(data) {
            $('#leave-data').html(''); // Clear previous data
            data.forEach(function(item) {
                $('#leave-data').append(`
                    <tr>
                        <td>${item.start_date}</td>
                        <td>${item.end_date}</td>
                        <td>${item.no_of_days}</td>
                        <td>${item.leave_type}</td>
                        <td>${item.leave_status}</td>
                        <td>${item.reason}</td>
                        <td><a href="/leave/${item.id}">View</a></td>
                    </tr>
                `);
            });
        }
    });
}

    </script>
@endsection

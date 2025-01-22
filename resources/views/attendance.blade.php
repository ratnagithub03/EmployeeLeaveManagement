@extends('employeelayout.default') 
@section('content')

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header text-center bg-primary text-white">
            <h3>Employee Attendance</h3>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center mb-4">
                <button id="check-in" class="btn btn-success btn-lg mx-2">Check In</button>
                <button id="check-out" class="btn btn-danger btn-lg mx-2">Check Out</button>
            </div>
            <div class="text-center mb-4">
                <p id="status" class="text-muted">Click a button or use voice commands to check in or check out.</p>
                <button id="voice-command" class="btn btn-info">Activate Voice Command</button>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>SL</th>
                            <th>Date</th>
                            <th>Check-In Time</th>
                            <th>Check-Out Time</th>
                            <th>Working Hours</th>
                        </tr>
                    </thead>
                    <tbody id="attendance-table">
                        <!-- Data will be dynamically loaded here -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-center text-secondary">
            Press the "Activate Voice Command" button or press the 'V' key to use voice commands.
        </div>
    </div>
</div>

<script>
    // Load attendance records when the page loads
    function loadAttendance() {
        fetch("{{ route('attendance.list') }}", {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to load attendance data.');
            }
            return response.json();
        })
        .then(data => {
            const table = document.getElementById('attendance-table');
            table.innerHTML = ''; // Clear the table before adding new rows
            data.forEach((record, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${record.date}</td>
                    <td>${record.check_in || 'Not Checked In'}</td>
                    <td>${record.check_out || 'Not Checked Out'}</td>
                    <td>${record.working_hours || 'N/A'}</td>
                `;
                table.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('status').innerText = 'Failed to load attendance data.';
        });
    }

    // Check-in functionality
    function checkIn() {
        fetch("{{ route('attendance.checkin') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Check-In Failed!');
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('status').innerText = data.message || 'Check-In Successful!';
            loadAttendance(); // Reload attendance data after check-in
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('status').innerText = 'Check-In Failed!';
        });
    }

    // Check-out functionality
    function checkOut() {
        fetch("{{ route('attendance.checkout') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Check-Out Failed!');
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('status').innerText = data.message || 'Check-Out Successful!';
            loadAttendance(); // Reload attendance data after check-out
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('status').innerText = 'Check-Out Failed!';
        });
    }

    // Voice Command Support
    const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
    recognition.lang = 'en-US';

    recognition.onresult = (event) => {
        const transcript = event.results[0][0].transcript.trim().toLowerCase();
        console.log('Voice Command:', transcript);

        if (transcript.includes('check in') || transcript.includes('checkin')) {
            checkIn();
        } else if (transcript.includes('check out') || transcript.includes('checkout')) {
            checkOut();
        } else {
            document.getElementById('status').innerText = "Command not recognized. Please say 'Check In' or 'Check Out'.";
        }
    };

    recognition.onerror = (event) => {
        console.error('Speech Recognition Error:', event.error);
        document.getElementById('status').innerText = 'Voice recognition error. Please try again.';
    };

    recognition.onnomatch = () => {
        document.getElementById('status').innerText = 'No speech recognized. Please say "Check In" or "Check Out".';
    };

    function activateVoiceCommand() {
        document.getElementById('status').innerText = 'Listening for voice command...';
        recognition.start();
    }

    document.addEventListener('keypress', (e) => {
        if (e.key.toLowerCase() === 'v') {
            activateVoiceCommand();
        }
    });

    document.getElementById('voice-command').addEventListener('click', activateVoiceCommand);

    // Attach click handlers and load attendance data on page load
    document.getElementById('check-in').addEventListener('click', checkIn);
    document.getElementById('check-out').addEventListener('click', checkOut);
    document.addEventListener('DOMContentLoaded', loadAttendance);
</script>

@endsection

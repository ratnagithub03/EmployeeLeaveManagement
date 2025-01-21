@extends('employeelayout.default') 
@section('content')

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<div class="container">
    <h1>Attendance</h1>
    <button id="check-in">Check In</button>
    <button id="check-out">Check Out</button>
    <p id="status"></p>
</div>

<script>
    // Handle Check-In
    document.getElementById('check-in').addEventListener('click', function () {
        fetch("{{ route('attendance.checkin') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
        })
            .then(response => response.json())
            .then(data => document.getElementById('status').innerText = data.message)
            .catch(error => console.error('Error:', error));
    });

    // Handle Check-Out
    document.getElementById('check-out').addEventListener('click', function () {
        fetch("{{ route('attendance.checkout') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
        })
            .then(response => response.json())
            .then(data => document.getElementById('status').innerText = data.message)
            .catch(error => console.error('Error:', error));
    });

    // Voice Command Support
    const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
    recognition.lang = 'en-US';

    recognition.onresult = (event) => {
        const transcript = event.results[0][0].transcript.toLowerCase();
        console.log('Voice Command:', transcript);

        if (transcript.includes('check in')) {
            document.getElementById('check-in').click();
        } else if (transcript.includes('check out')) {
            document.getElementById('check-out').click();
        } else {
            document.getElementById('status').innerText = "Command not recognized. Please say 'Check In' or 'Check Out'.";
        }
    };

    // Activate voice recognition when 'V' key is pressed
    document.addEventListener('keypress', (e) => {
        if (e.key === 'v') {
            document.getElementById('status').innerText = 'Listening for voice command...';
            recognition.start();
        }
    });
</script>
@endsection

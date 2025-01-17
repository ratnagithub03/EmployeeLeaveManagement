@extends('employeelayout.default')
@section('content')

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<style type="text/css">
    body {
        font-family: Arial, sans-serif;
    }
    .form-container {
        width: 500px;
        margin: 0 auto;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        background-color: #f9f9f9;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .form-container h2 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
    }
    label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
        color: #333;
    }
    select, input[type="date"], textarea, input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        color: #333;
    }
    input[type="text"] {
        width: calc(100% - 10px);
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    #btn {
        width: 100%;
        padding: 12px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }
    #btn:hover {
        background-color: #45a049;
    }
    #message {
        display: none;
        text-align: center;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        font-size: 16px;
    }
    #message.success {
        background-color: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }
    #message.error {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeeba;
    }
</style>

<!-- Div to show success or error message -->
<div id="message"></div>

<div class="form-container">
    <h2>Leave Application</h2>
    <form enctype="multipart/form-data" id="form" method="post">
        <input type="hidden" name="user_id" id="user_id" value="{{Session::get('userid')}}">

        <label for="leave_type">Leave Type</label>
        <select name="leave_type" id="leave_type">
            <option hidden>Select Leave Type</option>
            <option value="cl">Casual Leave</option>
            <option value="ml">Medical Leave</option>
        </select>

        <label for="from_date">From</label>
        <input type="date" name="from_date" id="from_date">

        <label for="to_date">To</label>
        <input type="date" name="to_date" id="to_date">

        <label for="leave_message">Reason for Leave</label>
        <textarea name="leave_message" id="leave_message" rows="3"></textarea>

        <div id="doc-row" class="h">
            <label for="document">Upload Medical Certificate</label>
            <input type="file" name="document" id="document" class="h">
        </div>

        <input type="text" name="days" id="days" readonly placeholder="Total Days">

        <button type="button" id="voice-command-btn">🎤 Start Voice Command</button>

        <input type="submit" name="btn" value="Apply" id="btn">
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        // Show/Hide document row based on leave type
        $('#leave_type').on('change', function(){
            let leave_type = $('#leave_type').val();
            if (leave_type == 'ml') {
                $('#doc-row').removeClass('h');
                $('#document').removeClass('h');
            } else {
                $('#doc-row').addClass('h');
                $('#document').addClass('h');
            }
        });

        // Submit form using AJAX
        $('#form').submit(function(event){
            event.preventDefault(); // Prevent default form submission
            $.ajax({
                url: '/api/applyLeave',
                type: 'post',
                dataType: 'json',
                data: {
                    'user_id': $('#user_id').val(),
                    'leave_type': $('#leave_type').val(),
                    'leave_message': $('#leave_message').val(),
                    'from_date': $('#from_date').val(),
                    'to_date': $('#to_date').val(),
                    'days': $('#days').val()
                },
                success: function(res) {
                    // Display success or error message
                    let messageDiv = $('#message');
                    if (res.success) {
                        messageDiv.removeClass('error').addClass('success');
                    } else {
                        messageDiv.removeClass('success').addClass('error');
                    }
                    messageDiv.text(res.message);
                    messageDiv.show(); // Show the message div
                },
                error: function(err) {
                    let messageDiv = $('#message');
                    messageDiv.removeClass('success').addClass('error');
                    messageDiv.text('An error occurred while applying for leave.');
                    messageDiv.show(); // Show the message div
                }
            });
        });

        // Calculate the number of days between from_date and to_date
        $('#to_date').change(function(){
            let fromdate = $('#from_date').val();
            let todate = $('#to_date').val();
            if (fromdate == '' || todate == '') {
                alert('Fill the date field');
                $('#to_date').val(null);
            } else {
                const start = new Date(fromdate);
                const end = new Date(todate);
                var diff = (end - start) / (1000 * 60 * 60 * 24);
                let days = Math.round(diff);
                $('#days').val(days);
            }
        });

        // Voice Command Button Click
        $('#voice-command-btn').click(function(){
            if (!('webkitSpeechRecognition' in window)) {
                alert('Your browser does not support speech recognition. Please use a compatible browser.');
                return;
            }

            const recognition = new webkitSpeechRecognition();
            recognition.lang = 'en-US';
            recognition.continuous = false;
            recognition.interimResults = false;

            recognition.start();

            recognition.onresult = function(event) {
                const transcript = event.results[0][0].transcript;
                parseVoiceCommand(transcript);
            };

            recognition.onerror = function(event) {
                alert('Voice recognition error: ' + event.error);
            };

            recognition.onend = function() {
                console.log('Voice recognition ended.');
            };
        });

        // Parse Voice Command
        function parseVoiceCommand(command) {
            command = command.toLowerCase();

            if (command.includes('casual leave')) {
                $('#leave_type').val('cl');
            } else if (command.includes('medical leave')) {
                $('#leave_type').val('ml');
            }

            const fromDateMatch = command.match(/from\s(\d{4}-\d{2}-\d{2})/);
            if (fromDateMatch) {
                $('#from_date').val(fromDateMatch[1]);
            }

            const toDateMatch = command.match(/to\s(\d{4}-\d{2}-\d{2})/);
            if (toDateMatch) {
                $('#to_date').val(toDateMatch[1]);
                $('#to_date').trigger('change');
            }

            const reasonMatch = command.match(/reason\s(.+)/);
            if (reasonMatch) {
                $('#leave_message').val(reasonMatch[1]);
            }
        }
    });
</script>

@stop

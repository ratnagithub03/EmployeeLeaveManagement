@extends('employeelayout.default')

@section('content')

<script src="https://code.jquery.com/jquery-3.7.1.js" 
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" 
        crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

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
        text-align: center; /* Center all child elements */
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
        text-align: left; /* Keep labels aligned to the left */
    }
    select, input[type="text"], textarea, input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        color: #333;
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

    /* Circular Voice Command Button Styling */
    #voice-command {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4285F4, #34A853, #FBBC05, #EA4335);
        color: white;
        border: none;
        font-size: 24px;
        cursor: pointer;
        margin: 20px auto; /* Add margin for spacing */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    #voice-command:hover {
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
    }

    /* Active Glow Effect */
    #voice-command.active {
        animation: glow 1.5s infinite alternate;
    }
    @keyframes glow {
        0% {
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5),
                        0 0 20px rgba(255, 255, 255, 0.4),
                        0 0 30px rgba(255, 255, 255, 0.3);
        }
        100% {
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.7),
                        0 0 30px rgba(255, 255, 255, 0.6),
                        0 0 40px rgba(255, 255, 255, 0.5);
        }
    }
</style>

<div id="message"></div>
<div class="form-container">
    <h2>Leave Application</h2>
    <button id="voice-command">
        <i class="fas fa-microphone"></i>
    </button>
    <form enctype="multipart/form-data" id="form" method="post">
        @csrf
        <input type="hidden" name="user_id" id="user_id" value="{{ Session::get('userid') }}">

        <label for="leave_type">Leave Type</label>
        <select name="leave_type" id="leave_type">
            <option hidden>Select Leave Type</option>
            <option value="cl">Casual Leave</option>
            <option value="ml">Medical Leave</option>
        </select>

        <label for="from_date">From (mm/dd/yyyy)</label>
        <input type="text" name="from_date" id="from_date" placeholder="mm/dd/yyyy">

        <label for="to_date">To (mm/dd/yyyy)</label>
        <input type="text" name="to_date" id="to_date" placeholder="mm/dd/yyyy">

        <label for="leave_message">Reason for Leave</label>
        <textarea name="leave_message" id="leave_message" rows="3"></textarea>

        <div id="doc-row" class="h">
            <label for="document">Upload Medical Certificate</label>
            <input type="file" name="document" id="document" class="h">
        </div>

        <input type="text" name="days" id="days" readonly placeholder="Total Days">

        <input type="submit" name="btn" value="Apply" id="btn">
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#leave_type').on('change', function () {
            let leaveType = $('#leave_type').val();
            if (leaveType === 'ml') {
                $('#doc-row').removeClass('h');
                $('#document').removeClass('h');
            } else {
                $('#doc-row').addClass('h');
                $('#document').addClass('h');
            }
        });

        $('#form').submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: '/api/applyLeave',
                type: 'post',
                dataType: 'json',
                data: {
                    user_id: $('#user_id').val(),
                    leave_type: $('#leave_type').val(),
                    leave_message: $('#leave_message').val(),
                    from_date: $('#from_date').val(),
                    to_date: $('#to_date').val(),
                    days: $('#days').val()
                },
                success: function (res) {
                    let messageDiv = $('#message');
                    if (res.success) {
                        messageDiv.removeClass('error').addClass('success');
                    } else {
                        messageDiv.removeClass('success').addClass('error');
                    }
                    messageDiv.text(res.message);
                    messageDiv.show();
                },
                error: function () {
                    let messageDiv = $('#message');
                    messageDiv.removeClass('success').addClass('error');
                    messageDiv.text('An error occurred while applying for leave.');
                    messageDiv.show();
                }
            });
        });

        $('#to_date').change(function () {
            let fromDate = $('#from_date').val();
            let toDate = $('#to_date').val();
            if (fromDate === '' || toDate === '') {
                alert('Fill both date fields');
                $('#to_date').val('');
            } else {
                const start = new Date(fromDate);
                const end = new Date(toDate);
                const diff = (end - start) / (1000 * 60 * 60 * 24);
                $('#days').val(Math.round(diff + 1));
            }
        });

        $('#voice-command').click(function () {
            const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
            recognition.lang = 'en-US';

            recognition.onstart = function () {
                $('#voice-command').addClass('active');
            };

            recognition.onresult = function (event) {
                $('#voice-command').removeClass('active');
                const transcript = event.results[0][0].transcript.toLowerCase();

                if (transcript.includes('casual leave')) {
                    $('#leave_type').val('cl').change();
                } else if (transcript.includes('medical leave')) {
                    $('#leave_type').val('ml').change();
                }

                const dateRegex = /from (\d{1,2}\/\d{1,2}\/\d{4}) to (\d{1,2}\/\d{1,2}\/\d{4})/i;
                const match = transcript.match(dateRegex);
                if (match) {
                    $('#from_date').val(match[1]);
                    $('#to_date').val(match[2]);

                    const start = new Date(match[1]);
                    const end = new Date(match[2]);
                    const diff = (end - start) / (1000 * 60 * 60 * 24);
                    $('#days').val(Math.round(diff + 1));
                }
            };

            recognition.onerror = function () {
                $('#voice-command').removeClass('active');
                alert('Voice recognition error.');
            };

            recognition.start();
        });
    });
</script>

@stop

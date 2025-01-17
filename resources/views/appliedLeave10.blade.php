@extends('adminlayout.default')

@section('content')
<div id="data"></div>

<!-- Modal for Voice Assistant -->
<div id="voiceModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title">Voice Assistant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Voice Assistant Logo -->
                <div id="voiceLogo" class="mb-3">
                    <img src="voice_assistant_logo.png" alt="Voice Assistant" style="width: 100px;">
                </div>

                <!-- Wave Animation -->
                <div id="waveAnimation" style="display: none;">
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                </div>
                <p id="voiceInstruction" class="mt-3">Listening... Please speak your command.</p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let employees = []; // Store employee data for voice command mapping

    $(document).ready(function() {
        // Fetch and display leave data
        $.ajax({
            url: '{{ url("api/appliedLeave") }}',
            type: 'get',
            dataType: 'json',
            success: function(res) {
                employees = res; // Store the response for voice command usage
                let html = `<table border="1" width="100%" class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                <th>Sl.No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Role</th>
                <th>Action</th>
                </tr>
                </thead>`;

                $(res).each(function(key, value) {
                    html += `<tr>
                    <td>${key + 1}</td>
                    <td>${value.name}</td>
                    <td>${value.email}</td>
                    <td>${value.phone}</td>
                    <td>${value.gender}</td>
                    <td>${value.role}</td>
                    <td>
                        <button class="btn btn-success" onclick="approveLeave(${value.id})">Approve</button>
                        <button class="btn btn-danger" onclick="rejectLeave(${value.id})">Reject</button>
                        <button class="btn btn-primary" onclick="startVoiceAssistant(${value.id})">Voice Command</button>
                    </td>
                    </tr>`;
                });

                html += `</table>`;
                $('#data').html(html);
            },
            error: function(err) {
                console.error('Error fetching leave data:', err);
                alert('Failed to load data. Please try again later.');
            }
        });
    });

    function approveLeave(id) {
        $.ajax({
            url: `{{ url('api/approveLeave') }}/${id}`,
            type: 'patch',
            data: { _token: '{{ csrf_token() }}' },
            success: function(response) {
                alert('Leave approved.');
                location.reload();
            },
            error: function(err) {
                console.error(err);
                alert('Error while approving leave.');
            }
        });
    }

    function rejectLeave(id) {
        $.ajax({
            url: `{{ url('api/rejectLeave') }}/${id}`,
            type: 'patch',
            data: { _token: '{{ csrf_token() }}', reason: 'Voice Command Rejection' },
            success: function(response) {
                alert('Leave rejected.');
                location.reload();
            },
            error: function(err) {
                console.error(err);
                alert('Error while rejecting leave.');
            }
        });
    }

    function startVoiceAssistant(id) {
        $('#voiceModal').modal('show'); // Show the modal
        $('#voiceLogo').show();
        $('#waveAnimation').hide();

        setTimeout(() => {
            $('#voiceLogo').hide();
            $('#waveAnimation').show();

            // Start speech recognition
            if ('SpeechRecognition' in window || 'webkitSpeechRecognition' in window) {
                const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                const recognition = new SpeechRecognition();

                recognition.lang = 'en-US';
                recognition.continuous = false;

                recognition.onstart = function() {
                    console.log('Voice recognition started. Please speak.');
                };

                recognition.onresult = function(event) {
                    const command = event.results[0][0].transcript.trim().toLowerCase();
                    console.log(`Command received: ${command}`);

                    if (command.includes('approve')) {
                        approveLeave(id);
                    } else if (command.includes('reject')) {
                        rejectLeave(id);
                    } else {
                        alert('Command not recognized. Please say "Approve" or "Reject".');
                    }
                    $('#voiceModal').modal('hide'); // Close the modal
                };

                recognition.onerror = function(event) {
                    console.error('Speech recognition error:', event.error);
                    alert('Speech recognition error. Please try again.');
                    $('#voiceModal').modal('hide');
                };

                recognition.onend = function() {
                    console.log('Voice recognition ended.');
                    $('#voiceModal').modal('hide');
                };

                recognition.start(); // Start listening
            } else {
                alert('Speech recognition is not supported in this browser. Please use a compatible browser.');
                $('#voiceModal').modal('hide');
            }
        }, 2000);
    }
</script>

<!-- Wave Animation Styles -->
<style>
    .wave {
        width: 8px;
        height: 50px;
        margin: 0 5px;
        display: inline-block;
        background: #007bff;
        animation: wave 1.2s infinite;
    }
    .wave:nth-child(2) {
        animation-delay: 0.2s;
    }
    .wave:nth-child(3) {
        animation-delay: 0.4s;
    }
    @keyframes wave {
        0%, 100% {
            transform: scaleY(1);
        }
        50% {
            transform: scaleY(2);
        }
    }
</style>
@stop

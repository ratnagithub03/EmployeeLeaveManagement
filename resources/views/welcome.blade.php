@extends('layout.default')

@section('content')
<body style="background: linear-gradient(to bottom right, rgba(102,34,136,0.8), rgba(200,50,50,0.8)), 
             url('{{ asset('images/background.jpg') }}') no-repeat center center fixed; 
             background-size: cover;
             background-blend-mode: overlay;
             height: 100vh;
             display: flex;
             flex-direction: column;
             justify-content: flex-start;
             color: white;
             font-family: 'Poppins', sans-serif;">

    <!-- Navbar -->
    <nav style="width: 100%; padding: 20px 50px; display: flex; justify-content: space-between; align-items: center; position: absolute; top: 0; background: rgba(0, 0, 0, 0.5);">
        <div style="display: flex; align-items: center;">
            <img src="{{ asset('images/ELMS.png') }}" alt="Logo" style="height: 40px; width: 40px; margin-right: 10px;"> <!-- Adjust logo path -->
            <a href="/" style="font-size: 24px; font-family: 'Montserrat', sans-serif; color: #D7BDE2; text-decoration: none;">
                ELMS
            </a> <!-- Replace "Logo" with your site name or logo -->
        </div>
        <div>
            <a href="/" style="color: white; text-decoration: none; padding: 10px 20px; margin-right: 15px; border: 2px solid white; border-radius: 25px; transition: all 0.3s;">
                Home
            </a>
            <a href= "/register" style="color: white; text-decoration: none; padding: 10px 20px; margin-right: 15px; border: 2px solid white; border-radius: 25px; transition: all 0.3s;">
                Register
            </a>
            <a href="/login" style="color: white; text-decoration: none; padding: 10px 20px; border: 2px solid white; border-radius: 25px; transition: all 0.3s;">
                Login
            </a>
        </div>
    </nav>

    <!-- Main content with Typed.js element -->
    <div id="element" style="font-size: 50px; text-align: center; padding: 50px 0;
                 margin-top: 150px; /* Adjust for space below the navbar */
                 font-family: 'Montserrat', sans-serif;
                 color: #D7BDE2;
                 text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.5);">
        <!-- Typed.js will update this element -->
    </div>

    <!-- Import Google Fonts for the new font styling -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">

    <!-- Import Typed.js library -->
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

    <!-- Initialize Typed.js -->
    <script>
        var typed = new Typed("#element", {
            strings: ["Employee Leave Management System"],
            typeSpeed: 50,
            loop: true,
            showCursor: false
        });
    </script>

    <!-- Navbar hover effects -->
    <style>
        a:hover {
            background-color: rgba(255, 255, 255, 0.1); /* Adds a slight white overlay on hover */
        }
    </style>
</body>
@stop
